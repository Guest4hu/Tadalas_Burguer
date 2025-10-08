<?php
namespace App\Tadala\Controllers;
use App\tadala\Models\Pedido;

class PedidoController {
    private $pedido;

    public function __construct($db){
        $this->pedido = new Pedido($db);
    }

    public function viewListarPedido(){
        return $this->pedido->buscarTodos();
    }

    public function BuscarPedidoPorId($id){
        return $this->pedido->buscarPorId($id);
    }

    public function InserirPedido($usuario_id, $status_pedido_id){
        return $this->pedido->inserir($usuario_id, $status_pedido_id);
    }

    public function AtualizarPedido($id, $status_pedido_id){
        return $this->pedido->atualizar($id, $status_pedido_id);
    }
    public function DeletarPedido($id){
        return $this->pedido->deletarPedido($id);
    }
    function ReativaPedido($id){
        return $this->pedido->reativarPedido($id);
    }
}
