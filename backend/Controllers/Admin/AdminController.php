<?php
namespace App\Tadala\Controllers\Admin;

use App\Tadala\Core\Flash;
use App\Tadala\Core\Redirect;

abstract class AdminController extends AuthenticatedController{
    public function __construct() {
        parent::__construct();
        if ($this->session->get('tipo_usuario_id') !== 2) {
            Redirect::redirecionarComMensagem(
                'admin/dashboard',
                'error',
                 'Você não tem permissão para acessar esta área.'
                ); 
        }
    }
}