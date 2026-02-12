<?php
namespace App\Tadala\Controllers\Admin;

use App\Tadala\Core\View;

class DashboardController extends AuthenticatedController
{
    public function index(): void
    {
        View::render('admin/dashboard/index', [
            'nomeUsuario' => $this->session->get('usuario_nome'),
            'tipo' => $this->session->get('usuario_tipo_nome')
        ]);
    }
}