<?php
namespace App\Tadala\Controllers;
use app\tadala\Models\ItemPedido;
class ItemPedidoController {
    private $ItemPedido;

    public function __construct($db){
     $this->ItemPedido = new ItemPedido($db);   
    }
    public function BuscarItemPedido($id){
        return $this->ItemPedido->buscarTodos($id);
    }
    public function BuscarItemPedidoId($id){
        return $this->ItemPedido->buscarPorId($id);
        
    }
    public function CriarItemPedido($id_pedido, $id_produto, $quantidade, $preco_unitario){
        $resultado = $this->ItemPedido->inserir($id_pedido, $id_produto, $quantidade, $preco_unitario);
        return ["success" => $resultado];
    }
    public function AtualizarItemPedidos($id, $quantidade, $valor_unitario){
        return $this->ItemPedido->atualizar($id, $quantidade, $valor_unitario);
    }
}
