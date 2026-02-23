<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Core\StatusLoja;
use App\Tadala\Controllers\AdminController;

class StatusStoreController extends AdminController
{
    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
        View::render("status/index");
    }

    public function toggle()
    {
        header('Content-Type: application/json');
        $newStatus = StatusLoja::toggle();
        echo json_encode([
            'status' => $newStatus,
            'message' => $newStatus === 'aberto' ? 'Loja aberta com sucesso!' : 'Loja fechada com sucesso!'
        ]);
    }
}
