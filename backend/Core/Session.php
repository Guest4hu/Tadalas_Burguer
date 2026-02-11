<?php
namespace App\Tadala\Core;

class Session {
    public function __construct(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set(string $key, $value): void{
        $_SESSION[$key] = $value;
    }

    public function get(string $key){
        return $_SESSION[$key] ?? null;
    }

    public function has(string $key): bool {
        return isset($_SESSION[$key]);
    }

    public function destroy(): void {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, // Setar a data de expiração de um coockie pra antes da data atual faz ele desaparecer
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
    }
}