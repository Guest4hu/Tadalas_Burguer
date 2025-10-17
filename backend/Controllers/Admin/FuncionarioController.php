<?php
namespace App\Tadala\Controllers\Admin;

use App\Tadala\Core\Flash;
use App\Tadala\Core\Redirect;

abstract class FuncionarioController extends AuthenticatedController{
    public function __construct() {
        parent::__construct();
        if ($this->session->get('usuario_tipo') !== 'Funcionario') {
            Redirect::redirecionarComMensagem(
                'admin/dashboard',
                'error',
                 'Você não tem permissão para acessar esta área.'
                ); 
        }
    }
}