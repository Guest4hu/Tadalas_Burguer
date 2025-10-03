<?php


namespace App\Tadala\Controllers;

use App\Tadala\Models\StatusPagamento;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;

class StatusPagamentoController {
    private $statusPagamento;

    public function __construct($db){
        $this->statusPagamento = new StatusPagamento($db);
    }

    public function listar(){
        echo json_encode($this->statusPagamento->buscarTodos());
    }

    public function mostrar($id){
        echo json_encode($this->statusPagamento->buscarPorId($id));
    }

    public function criar($descricao){
        $resultado = $this->statusPagamento->inserir($descricao);
        echo json_encode(["success" => $resultado]);
    }

    public function atualizar($id, $descricao){
        $resultado = $this->statusPagamento->atualizar($id, $descricao);
        echo json_encode(["success" => $resultado]);
    }
}
?>
