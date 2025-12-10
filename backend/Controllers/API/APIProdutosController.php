<?php

namespace App\Tadala\Controllers\API;

use App\Tadala\Models\Produto;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;
use App\Tadala\Core\Redirect;

class APIPedidoController
{
    public $produtos;
    public $db;
    private $chaveAPI;

    public function __construct()
    {
        $this->chaveAPI = new ChaveApi();
        $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->produtos = new Produto($this->db);
    }
    
    public function viewbuscarTipoPedidos($tipo){
    header("Content-Type: application/json; charset=utf-8");

    $statusPed = $this->statusPedido->buscarTodosStatusPedido();
    $dados = $this->pedidos->paginacao( $tipo);    
    $statusPed = $this->statusPedido->buscarTodosStatusPedido();
    echo json_encode([
        "sucesso" => true,
        "pedidos" => $dados['data'] ?? [],
        "statusPedido" => $statusPed ?? []
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}


public function atualizarItensPedidoQTD()
    {
        header("Content-Type: application/json; charset=utf-8");
        $dados = json_decode(file_get_contents("php://input"), true);
        $tamanho = count($dados['itens']);
        for ($i=0; $i <= $tamanho; $i++) {
            $id    = $dados['itens'][$i]['id'];
            $qtd   = intval($dados['itens'][$i]['quantidade']);
            if ($qtd > 0) {
                $this->ItensPedidos->atualizarItemPedido($id, $qtd);
            } else {
                Redirect::redirecionarComMensagem("pedidos", "error", "Por favor, Verifique se os campos estão preenchidos corretamente!");
            }
        }
        Redirect::redirecionarComMensagem("pedidos", "success", "Items do Pedido atualizado com sucesso!");
    }



    public function buscaEndereco($usuarioId){
        header("Content-Type: application/json; charset=utf-8");
        $endereco = $this->endereco->buscarPorIdEndereco($usuarioId);
        echo json_encode([
            "sucesso" => true,
            "endereco" => $endereco
        ], JSON_PRETTY_PRINT);
    }

     public function Items($id)
    {
        $valorTotal = 0;
        header("Content-Type: application/json; charset=utf-8");
        $dados = $this->ItensPedidos->buscarPorIdItemPedido($id);
        for ($i = 0; $i < count($dados); $i++) {
            $valorTotal += $dados[$i]['valor_unitario'] * $dados[$i]['quantidade'];
            
        }
        $tipoPedido = $this->pedidos->buscarPorIdPedido($id);
        $buscarMetodoPagamento = $this->pagamento->buscarPorIdPagamento($id);
        $metodoPagamento = $this->metodo_pagamento->buscarTodosMetodosPagamento();
        $statusPagamento = $this->status_pagamento->buscarTodosStatusPagamento();
        $produtos = $this->produtos->buscarProdutosAtivos();

        echo json_encode([
            "sucesso" => true,
            "tipoPedido" => $tipoPedido,
            "dados2" =>  $dados,
            "metodoPagamento" => $metodoPagamento,
            "statusPagamento" => $statusPagamento,
            "produtos" => $produtos,
            "buscarMetodoPagamento" => $buscarMetodoPagamento,
            'valorTotal' => number_format($valorTotal, 2, ',', '.')
        ], JSON_PRETTY_PRINT);
    }

    public function AtualizarPedido()
    {
        header("Content-Type: application/json; charset=utf-8");
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
        header("Content-Type: application/json; charset=utf-8");
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
        header("Content-Type: application/json; charset=utf-8");
        $dados = json_decode(file_get_contents("php://input"), true);
        $idPedido = $dados['idPedido'];
        if ($this->pedidos->deletarPedido($idPedido)) {
        } else {
        }
    }

    public function deletarItemPedidos(){
        header("Content-Type: application/json; charset=utf-8");
        $dados = json_decode(file_get_contents("php://input"), true);
        $idItem = $dados['itemId'];
        if ($this->ItensPedidos->excluirItemPedido($idItem)) {
        } else {
        }
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
    public function atualizarMetodo(){
        header("Content-Type: application/json; charset=utf-8");
         $dados = json_decode(file_get_contents("php://input"), true);
         $statusID = $dados['statusID'];
         $pedidoID = $dados['pedidoId'];
         $metodoID = $dados['metodoID'];
         $valorTotal = $dados['valorTotal'];
            $this->pagamento->atualizarMetodoPagamento($pedidoID, $metodoID, $statusID, $valorTotal);
    }

}