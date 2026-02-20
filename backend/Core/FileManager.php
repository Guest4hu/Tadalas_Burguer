<?php

namespace App\Tadala\Core;

/**
 * Utilidades de arquivo para uploads.
 */
class FileManager
{
	/**
	 * Comprime/redimensiona uma imagem para WebP.
	 * @param array $file Entrada de $_FILES['...']
	 * @param string $uploadDir Diretório absoluto para salvar
	 * @param int $maxW Largura máxima
	 * @param int $maxH Altura máxima
	 * @param int $quality Qualidade WebP (0-100)
	 * @return string|null Nome do arquivo salvo ou null em erro
	 */
	public static function saveImageCompressed(array $file, string $uploadDir, int $maxW = 1280, int $maxH = 1280, int $quality = 78): ?string
	{
		if (empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
			return null;
		}

		if (!extension_loaded('gd')) {
			error_log('GD extension not loaded; skipping compression');
			return null;
		}

		[$w, $h, $type] = @getimagesize($file['tmp_name']);
		if (!$w || !$h) {
			error_log('Invalid image dimensions; skipping compression');
			return null;
		}

		$create = match ($type) {
			IMAGETYPE_JPEG => 'imagecreatefromjpeg',
			IMAGETYPE_PNG  => 'imagecreatefrompng',
			IMAGETYPE_WEBP => 'imagecreatefromwebp',
			default        => null,
		};

		if (!$create || !function_exists($create)) {
			error_log('Unsupported image type for compression');
			return null;
		}

		$ratio = min($maxW / $w, $maxH / $h, 1);
		$newW = (int)($w * $ratio);
		$newH = (int)($h * $ratio);

		$src = @$create($file['tmp_name']);
		if (!$src) {
			error_log('Failed to create image resource for compression');
			return null;
		}

		$dst = imagecreatetruecolor($newW, $newH);

		imagealphablending($dst, false);
		imagesavealpha($dst, true);

		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $w, $h);

		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0777, true);
		}

		$nomeArquivo = uniqid('produto_', true) . '.webp';
		$destino = rtrim($uploadDir, '/\\') . DIRECTORY_SEPARATOR . $nomeArquivo;

		$ok = imagewebp($dst, $destino, $quality);

		imagedestroy($src);
		imagedestroy($dst);

		return $ok ? $nomeArquivo : null;
	}

	/**
	 * Reprocessa um arquivo de imagem existente (mantém o nome) para reduzir peso.
	 * @param string $filePath Caminho completo do arquivo existente
	 * @param int $maxW Largura máxima
	 * @param int $maxH Altura máxima
	 * @param int $quality Qualidade (JPEG/WebP)
	 * @return bool
	 */
	public static function recompressExisting(string $filePath, int $maxW = 1280, int $maxH = 1280, int $quality = 78): bool
	{
		if (!is_file($filePath) || !is_readable($filePath)) {
			return false;
		}

		if (!extension_loaded('gd')) {
			return false;
		}

		[$w, $h, $type] = @getimagesize($filePath);
		if (!$w || !$h) {
			return false;
		}

		$create = match ($type) {
			IMAGETYPE_JPEG => 'imagecreatefromjpeg',
			IMAGETYPE_PNG  => 'imagecreatefrompng',
			IMAGETYPE_WEBP => 'imagecreatefromwebp',
			default        => null,
		};
		$save = match ($type) {
			IMAGETYPE_JPEG => fn($img, $dest) => imagejpeg($img, $dest, max(0, min(100, $quality))),
			IMAGETYPE_PNG  => fn($img, $dest) => imagepng($img, $dest, 7),
			IMAGETYPE_WEBP => fn($img, $dest) => imagewebp($img, $dest, max(0, min(100, $quality))),
			default        => null,
		};

		if (!$create || !$save || !function_exists($create)) {
			return false;
		}

		$ratio = min($maxW / $w, $maxH / $h, 1);
		$newW = (int)($w * $ratio);
		$newH = (int)($h * $ratio);

		$src = @$create($filePath);
		if (!$src) {
			return false;
		}

		$dst = imagecreatetruecolor($newW, $newH);
		imagealphablending($dst, false);
		imagesavealpha($dst, true);

		imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $w, $h);

		$temp = $filePath . '.tmp';
		$ok = $save($dst, $temp);

		imagedestroy($src);
		imagedestroy($dst);

		if ($ok) {
			@rename($temp, $filePath);
			return true;
		}

		@unlink($temp);
		error_log('Recompress failed for ' . $filePath);
		return false;
	}

	/**
	 * Reprocessa todas as imagens de um diretório (não altera nomes/DB).
	 * @return array Estatísticas simples
	 */
	public static function recompressDirectory(string $dir, int $maxW = 1280, int $maxH = 1280, int $quality = 78): array
	{
		$result = ['dir' => $dir, 'processed' => 0, 'success' => 0, 'errors' => 0, 'skipped' => 0, 'files' => []];
		if (!is_dir($dir)) {
			return $result;
		}

		$allowed = ['jpg', 'jpeg', 'png', 'webp'];
		$items = scandir($dir) ?: [];
		foreach ($items as $item) {
			if ($item === '.' || $item === '..') {
				continue;
			}
			$path = rtrim($dir, '/\\') . DIRECTORY_SEPARATOR . $item;
			if (!is_file($path)) {
				continue;
			}
			$ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
			if (!in_array($ext, $allowed, true)) {
				$result['skipped']++;
				continue;
			}
			$result['processed']++;
			$ok = self::recompressExisting($path, $maxW, $maxH, $quality);
			$result['files'][$item] = $ok ? 'ok' : 'fail';
			$ok ? $result['success']++ : $result['errors']++;
		}

		return $result;
	}
}
