<?php
namespace App\Tadala\Core;

class Flash
{
    public static function set(string $type, string $message): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['flash'][$type] = $message;
    }

    public static function getAll(): array
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $flashes = $_SESSION['flash'] ?? [];
        unset($_SESSION['flash']);
        return $flashes;
    }
}
