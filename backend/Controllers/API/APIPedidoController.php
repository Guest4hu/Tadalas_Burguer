<?php

namespace App\Tadala\Controllers\API;

use App\Tadala\Models\Endereco;
use App\Tadala\Models\ItensPedido;
use App\Tadala\Models\MetodoPagamento;
use App\Tadala\Models\Produto;
use App\Tadala\Models\Pedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;
use App\Tadala\Core\Redirect;
use App\Tadala\Models\Pagamento;
use App\Tadala\Models\StatusPagamento;
use App\Tadala\Models\StatusPedido;

class APIPedidoController
{
    public $status_pagamento;
    public $endereco;

    public $produtos;
    public $pedidos;
    public $db;
    public $ItensPedidos;
    public $statusPedido;

    public $metodo_pagamento;

    public $pagamento;

    private $chaveAPI;
    

    public function __construct()
    {
        $this->chaveAPI = new ChaveApi();
        $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->status_pagamento = new StatusPagamento($this->db);
        $this->metodo_pagamento = new MetodoPagamento($this->db);
        $this->pedidos = new Pedido($this->db);
        $this->ItensPedidos = new ItensPedido($this->db);
        $this->statusPedido = new StatusPedido($this->db);
        $this->produtos = new Produto($this->db);
        $this->pagamento = new Pagamento($this->db);
        $this->endereco = new Endereco($this->db);
    }
    
    public function viewbuscarTipoPedidos(){
    header("Content-Type: application/json; charset=utf-8");

    $statusPed = $this->statusPedido->buscarTodosStatusPedido();
    $dados = $this->pedidos->paginacao();    
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
                if($this->ItensPedidos->atualizarItemPedido($id, $qtd)){
                    echo json_encode([
            "sucesso" => true,
            
        ], JSON_PRETTY_PRINT);
       }
       else{
        echo json_encode([
            "sucesso" => true,
            
        ], JSON_PRETTY_PRINT);
       }
                };
            }
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
         echo json_encode([
            "sucesso" => true,
            
        ], JSON_PRETTY_PRINT);
       }
       else{
        echo json_encode([
            "sucesso" => true,
            
        ], JSON_PRETTY_PRINT);
       }
    }
    public function adicionarPedidos() {
        header("Content-Type: application/json; charset=utf-8");
        $dados = json_decode(file_get_contents("php://input"), true);
        //var_dump($dados);exit;
        $quantidade =$dados['quantidade'];
        $idProduto = $dados['produtoId'];
        $idPedido = $dados['idPedido']; 
       $preco =  $dados['preco'];
       if($this->ItensPedidos->inserirItemPedido($idPedido,$idProduto,$quantidade,$preco)){
        echo json_encode([
            "sucesso" => true,
            
        ], JSON_PRETTY_PRINT);
       }
       else{
        echo json_encode([
            "sucesso" => true,
            
        ], JSON_PRETTY_PRINT);
       }

        
    }
    public function deletarPedidos()
    {
        header("Content-Type: application/json; charset=utf-8");
        $dados = json_decode(file_get_contents("php://input"), true);
        $idPedido = $dados['idPedido'];
        if ($this->pedidos->deletarPedido($idPedido)) {
        echo json_encode([
            "sucesso" => true,
            
        ], JSON_PRETTY_PRINT);
       }
       else{
        echo json_encode([
            "sucesso" => true,
            
        ], JSON_PRETTY_PRINT);
       }
    }

    public function deletarItemPedidos(){
        header("Content-Type: application/json; charset=utf-8");
        $dados = json_decode(file_get_contents("php://input"), true);
        $idItem = $dados['itemId'];
        if ($this->ItensPedidos->excluirItemPedido($idItem)) {
        echo json_encode([
            "sucesso" => true,
            
        ], JSON_PRETTY_PRINT);
       }
       else{
        echo json_encode([
            "sucesso" => true,
            
        ], JSON_PRETTY_PRINT);
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



    public function calculaValorTotal($pedidoID){
        header("Content-Type: application/json; charset=utf-8");
        $dados = $this->pagamento->calculaValorTotal($pedidoID);
        echo json_encode([
            "sucesso" => true,
            "valorTotal" => $dados
        ]);
    }

}