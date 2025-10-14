<?php
namespace App\Tadala\Controllers;
use app\tadala\Models\ItemPedido;
use App\Tadala\Core\View;
class ItemPedidoController {
    private $ItemPedido;

    public function __construct($db){
     $this->ItemPedido = new ItemPedido($db);   
    }
    public function     BuscarItemPedido(){
        $this->ItemPedido->buscarTodosItemPedido();
        
    }
    public function listarItemPedidoId($id){
        $this->ItemPedido->buscarPorIdItemPedido($id);
        View::render("itempedido/index");
        
    }
    public function viewCriarItemPedido($pedido_id, $produto_id, $quantidade, $valor_unitario){
        $this->ItemPedido->inserirItemPedido($pedido_id, $produto_id, $quantidade, $valor_unitario);
        View::render("itempedido/create")
        ;
    }
    public function atualizarItemPedidos($id, $quantidade, $valor_unitario){
        $this->ItemPedido->atualizarItemPedido($id, $quantidade, $valor_unitario);

    }
    public function ViewEditarItemPedido($id){
        $this->ItemPedido->buscarPorIdItemPedido($id);
        View::render("itempedido/edit");
        
     
    }
    public function deletarItempedido($id){
        $this->ItemPedido->excluirItemPedido($id);
        View::render("itempedido/delete");

    }
}

