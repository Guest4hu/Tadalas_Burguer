<?php
namespace App\Tadala\Controllers;
use App\tadala\Models\Pagamento;
class PagamentoController{
    private $pagamento;
    public function __construct($db){
        $this->pagamento = new Pagamento($db);
    }
    public function viewListarTodosPagamentos(){
        $resultado = $this->pagamento->buscarTodos();
        var_dump($resultado);
    }
    public function viewListarPagamentoPorId($id){
        $resultado = $this->pagamento->buscarPorId($id);
        var_dump($resultado);
    }
    public function viewInserirPagamento($pedido_id, $metodo, $status_pagamento_id, $valor_total){
        $resultado = $this->pagamento->inserir($pedido_id, $metodo, $status_pagamento_id, $valor_total);
        var_dump($resultado);
        
    } 
    public function viewAtualizarPagamento($id, $metodo, $status_pagamento_id, $valor_total){
        $resultado = $this->pagamento->atualizar($id, $metodo, $status_pagamento_id, $valor_total);
        var_dump($resultado);
    }
}