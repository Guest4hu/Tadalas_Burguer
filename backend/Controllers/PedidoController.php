<?php


namespace Controllers;
use App\Tadala\Models\Pedido;

>>>>>>> origin/victor_v3

class PedidoController {
    private $pedido;

    public function __construct($db){
        $this->pedido = new Pedido($db);
    }

    public function viewListarPedido(){
        return $this->pedido->buscarTodosPedido();
    }

    public function BuscarPedidoPorId($id){
        return $this->pedido->buscarPorIdPedido($id);
    }

    public function viewCriarPedido($usuario_id, $status_pedido_id){
        return $this->pedido->inserirPedido($usuario_id, $status_pedido_id);
    }

    public function AtualizarPedido($id, $status_pedido_id){
        return $this->pedido->atualizarPedido($id, $status_pedido_id);
    }
    public function DeletarPedido($id){
        return $this->pedido->deletarPedido($id);
    }
    function ReativaPedido($id){
        return $this->pedido->reativarPedido($id);
    }
}
