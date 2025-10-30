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
    public static function redirecionarPara(string $url)
    {
        header('Location: /backend/' . $url);
        exit;
    }

    public static function redirecionarComMensagem(string $url, string $type, string $message, int $status = 302): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        Flash::set($type, $message);
        self::redirecionarPara($url);
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
