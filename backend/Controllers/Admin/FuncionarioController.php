<?php
namespace App\Tadala\Controllers\Admin;

use App\Tadala\Core\Flash;
use App\Tadala\Core\Redirect;

abstract class FuncionarioController extends AuthenticatedController{
    public function __construct() {
        parent::__construct();
        if ($this->session->get('usuario_tipo') !== 1) {
            Redirect::redirecionarComMensagem(
                'admin/dashboard', // pensando que no nosso projeto cliente que pedirem delivery também vão fazer login, aqui já poderia jogar direto pra página do cliente
                'error',
                'Você não tem permissão para acessar esta área.'
                ); 
        }
    }
}