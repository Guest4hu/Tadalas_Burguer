<?php
namespace App\Tadala\Controllers\Admin;

use App\Tadala\Core\Session;
use App\Tadala\Core\Flash;
use App\Tadala\Core\Redirect;

abstract class AuthenticatedController{
    protected Session $session;
    public function __construct() {
        $this->session = new Session();

        // Verifica se está logado
        if (!$this->session->has('usuario_id')) {
            Redirect::redirecionarComMensagem(
                '/login',
                'error',
                'Você precisa estar logado para acessar esta página.'
                );
        }
    }
}