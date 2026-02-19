<?php

namespace App\Tadala\Controllers\Api;

use App\Tadala\Http\Response;
use App\Tadala\Core\Session;

class AuthApiController {
    private $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function me() {
        $usuarioId = $this->session->get('usuario_id');

        if (!$usuarioId) {
            Response::json(['logged_in' => false]);
            return;
        }

        Response::json([
            'logged_in' => true,
            'usuario_id' => $usuarioId,
            'nome' => $this->session->get('usuario_nome'),
            'email' => $this->session->get('usuario_email')
        ]);
    }
}