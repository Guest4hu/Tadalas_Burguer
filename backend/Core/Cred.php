<?php
namespace App\Tadala\Core;

class Cred {
    public Session $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function checarCredenciais(): array {
        return [
            'nome' => $this->session->get('nome'),
            'tipo_usuario_id' => $this->session->get('tipo_usuario_id')
        ];
    }
}