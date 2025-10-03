<?php
namespace Controllers;
use Models\StatusPedido;

class StatusPedidoController {
    private $statusPedido;

    public function __construct($db){
        $this->statusPedido = new StatusPedido($db);
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
