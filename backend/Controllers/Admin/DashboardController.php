<?php
namespace App\Tadala\Controllers\Admin;

use App\Tadala\Core\View;

class DashboardController extends AuthenticatedController
{
    public function index(): void
    {
        View::render('admin/dashboard/index', [
            'nomeUsuario' => $this->session->get('nome'),
            'tipo' => $this->session->get('tipo_usuario_id')
        ]);
    }
}