<?php
namespace App\Tadala\Controllers;

use App\Tadala\Core\Session;
use App\Tadala\Core\Redirect;
use App\Tadala\Controllers\AuthenticatedController;

abstract class AdminController extends AuthenticatedController{
    protected Session $session;
    public function __construct() {
        parent::__construct();

        $this->session = new Session();

        if ($this->session->get('tipo_usuario_id') !== 1) {
            Redirect::redirecionarComMensagem(
                'home',
                'error',
                'Você não tem permissão para acessar esta página.'
                );
        }
    }
}