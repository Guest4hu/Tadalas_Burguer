<?php
namespace App\Tadala\Core;

use App\Tadala\Core\Flash;

class Redirect
{
    private const BASE_PATH = '/backend/';

    /**
     * Redireciona para uma URL segura.
     * Se $url for relativa (ex: 'dashboard') => /backend/dashboard
     * Se $url for um path absoluto ('/admin') => /admin
     * Se $url for uma URL externa, só permite se o host for o mesmo do servidor (evita open redirects).
     */
    public static function redirecionarPara(string $url, int $status = 302): void
    {
        // remove CRLF para evitar header injection
        $url = str_replace(["\r", "\n"], '', $url);

        // se vazio, vai para a base
        if ($url === '') {
            $url = self::BASE_PATH;
        }

        // se for URL absoluta (http/https)
        if (preg_match('#^https?://#i', $url)) {
            $host = parse_url($url, PHP_URL_HOST);
            $currentHost = $_SERVER['HTTP_HOST'] ?? $host;
            // permitir apenas se o host for igual (evita open redirect)
            if ($host !== $currentHost) {
                $url = self::BASE_PATH; // fallback seguro
            }
        } else {
            // caminho relativo sem leading slash => adiciona BASE_PATH
            if (strpos($url, '/') !== 0) {
                $url = rtrim(self::BASE_PATH, '/') . '/' . ltrim($url, '/');
            }
            // se começar com '/', mantemos como path absoluto do servidor
        }

        header('Location: /backend/ ' . $url, true, $status);
        exit;
    }

    public static function redirecionarComMensagem(string $url, string $type, string $message, int $status = 302): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        Flash::set($type, $message);
        self::redirecionarPara($url, $status);
    }

    public static function voltarPaginaAnterior(?string $type = null, ?string $message = null): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? null;

        if (!$referer) {
            // fallback para base
            self::redirecionarPara(self::BASE_PATH);
        }

        // se veio mensagem, setamos e voltamos
        if ($type !== null && $message !== null) {
            // Se referer for externa, a função redirecionarComMensagem validará/normalizará
            self::redirecionarComMensagem($referer, $type, $message);
        } else {
            self::redirecionarPara($referer);
        }
    }
}
