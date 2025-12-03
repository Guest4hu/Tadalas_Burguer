<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\ItensPedido;
use App\Tadala\Models\Produto;
use App\Tadala\Models\Pedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;
use App\Tadala\Models\StatusPedido;


class PedidosController
{
    public $produtos;
    public $pedidos;
    public $db;
    public $ItensPedidos;
    public $statusPedido;
    

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->pedidos = new Pedido($this->db);
        $this->ItensPedidos = new ItensPedido($this->db);
        $this->statusPedido = new StatusPedido($this->db);
        $this->produtos = new Produto($this->db);
    }
    public function viewListarPedidos($pagina = 1, $por_pagina = 5)
    {
        header("Application/json");
        View::render(
            "pedidos/index",
    );
    }


    public function AtualizarPedido()
    {
        $dados = json_decode(file_get_contents("php://input"), true);
        $status = $dados['status'];
        $idPedido = $dados['idPedido'];
        if ($this->pedidos->atualizarPedido($idPedido, $status)) {
            Redirect::redirecionarComMensagem("pedidos", "success", "Pedido atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("pedidos", "error", "Erro ao atualizar pedido.");
        }
    }
    public function adicionarPedidos() {
        $dados = json_decode(file_get_contents("php://input"), true);
        $quantidade = intval($dados['quantidade']);
        $idProduto = $dados['produtoId'];
        $idPedido = $dados['idPedido'];
        $preco =  str_replace(',', '.', round($dados['preco'],2));
        if ($this->ItensPedidos->inserirItemPedido($idPedido,$idProduto,$quantidade,$preco)) {
            Redirect::redirecionarComMensagem("pedidos", "success", "Item adicionado ao pedido com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("pedidos", "error", "Erro ao adicionar item ao pedido.");
        }
    }
    public function deletarPedidos()
    {
        $dados = json_decode(file_get_contents("php://input"), true);
        $idPedido = $dados['idPedido'];
        if ($this->pedidos->deletarPedido($idPedido)) {
        } else {
        }
    }

    public function deletarItemPedidos(){
        $dados = json_decode(file_get_contents("php://input"), true);
        $idItem = $dados['id'];
        if ($this->ItensPedidos->excluirItemPedido($idItem)) {
        } else {
        }
    }

    public function Items($id)
    {
        header("Application/json");
        $dados = $this->ItensPedidos->buscarPorIdItemPedido($id);
        $dadosItems = $this->pedidos->buscarTodosPedido();
        echo json_encode([
            "sucesso" => true,
            "dados2" =>  $dados,
            "dadosItems" => $dadosItems
        ], JSON_PRETTY_PRINT);
    }

 

    public function contarPedidosPorTipo($tipo){
        header("Content-Type: application/json; charset=utf-8");
        $contagem = $this->pedidos->contarPedidosPorTipo($tipo);
        echo json_encode([
            "sucesso" => true,
            "contagem" => $contagem
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function ContarNotificacoes(){
         header("Content-Type: application/json; charset=utf-8");
        $contagem = $this->pedidos->contarPedidosPorTipo(1);
        echo json_encode([
            "sucesso" => true,
            "contagem" => $contagem
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}