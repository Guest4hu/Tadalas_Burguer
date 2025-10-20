<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\StatusPedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;

class StatusPedidoController {
    public $statusPedido;
    public $db;

    public function __construct(){
        $this->db = Database::getInstance();
        $this->statusPedido = new StatusPedido($this->db);
    }

    public function listar(){
        echo json_encode($this->statusPedido->buscarTodos());
    }

    public function mostrar($id){
        echo json_encode($this->statusPedido->buscarPorId($id));
    }

    public function criar($descricao){
        $resultado = $this->statusPedido->inserir($descricao);
        echo json_encode(["success" => $resultado]);
    }

    public function atualizar($id, $descricao){
        $resultado = $this->statusPedido->atualizar($id, $descricao);
        echo json_encode(["success" => $resultado]);
    }
}
?>
