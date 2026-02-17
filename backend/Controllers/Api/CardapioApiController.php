<?php

namespace App\Tadala\Controllers\Api;

use App\Tadala\Http\Response;
use App\Tadala\Database\Database;
use App\Tadala\Models\Categoria;

class CardapioApiController {
    private $categoriaModel;

    public function __construct() {
        $db = Database::getInstance();
        $this->categoriaModel = new Categoria($db);
    }

    public function getCategorias() {
        $dados = $this->categoriaModel->buscarCategoria();
        Response::json([
            'status'    => 'success',
            'data'      => $dados
        ]);
    }
}