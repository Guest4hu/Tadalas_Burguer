<?php
require __DIR__ . '/../../vendor/autoload.php';

use App\Tadala\Core\FileManager;

$uploadDir = realpath(__DIR__ . '/../upload');
if (!$uploadDir) {
    fwrite(STDERR, "Diretório de upload não encontrado\n");
    exit(1);
}

$result = FileManager::recompressDirectory($uploadDir, 1280, 1280, 78);

echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
