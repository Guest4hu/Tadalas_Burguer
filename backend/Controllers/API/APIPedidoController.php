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

    $statusPed = $this->statusPedido->buscarTodosStatusPedido();
    $dados = $this->pedidos->paginacao();    
    $statusPed = $this->statusPedido->buscarTodosStatusPedido();
    $data = [
        "sucesso" => true,
        "pedidos" => $dados['data'] ?? [],
        "statusPedido" => $statusPed ?? []
    ];
    ChaveApi::buscarCabecalho($data);
}


public function atualizarItensPedidoQTD()
    {
        $dados = ChaveApi::CabecalhoDecode();
        $tamanho = count($dados['itens']);
        for ($i=0; $i < $tamanho; $i++) {
            $id    = $dados['itens'][$i]['id'];
            $qtd   = intval($dados['itens'][$i]['quantidade']);
                $this->ItensPedidos->atualizarItemPedido($id, $qtd);
            }
    }



    public function buscaEndereco($usuarioId){
        $endereco = $this->endereco->buscarPorIdEndereco($usuarioId);
        $data = [
            "sucesso" => true,
            "endereco" => $endereco
        ];
        ChaveApi::buscarCabecalho($data);
    }

     public function Items($id)
    {
        $valorTotal = 0;
        $dados = $this->ItensPedidos->buscarPorIdItemPedido($id);
        for ($i = 0; $i < count($dados); $i++) {
            $valorTotal += $dados[$i]['valor_unitario'] * $dados[$i]['quantidade'];
            
        }
        $tipoPedido = $this->pedidos->buscarPorIdPedido($id);
        $buscarMetodoPagamento = $this->pagamento->buscarPorIdPagamento($id);
        $metodoPagamento = $this->metodo_pagamento->buscarTodosMetodosPagamento();
        $statusPagamento = $this->status_pagamento->buscarTodosStatusPagamento();
        

        $data = [
            "sucesso" => true,
            "tipoPedido" => $tipoPedido,
            "dados2" =>  $dados,
            "metodoPagamento" => $metodoPagamento,
            "statusPagamento" => $statusPagamento,
            
            "buscarMetodoPagamento" => $buscarMetodoPagamento,
            'valorTotal' => number_format($valorTotal, 2, ',', '.')
        ];
        ChaveApi::buscarCabecalho($data);
    }

    public function AtualizarPedido()
    {
        $dados = ChaveApi::CabecalhoDecode();
        $status = $dados['status'];
        $idPedido = $dados['idPedido'];
        if ($this->pedidos->atualizarPedido($idPedido, $status)) {
         $data = [
            "sucesso" => true,
            
        ];
        ChaveApi::buscarCabecalho($data);
       }
       else{
        $data = [
            "sucesso" => true,
            
        ];
        ChaveApi::buscarCabecalho($data);
       }
    }
    public function adicionarPedidos() {
        $dados = ChaveApi::CabecalhoDecode();
        $quantidade =$dados['quantidade'];
        $idProduto = $dados['produtoId'];
        $idPedido = $dados['idPedido']; 
       $preco =  $dados['preco'];
       if($this->ItensPedidos->inserirItemPedido($idPedido,$idProduto,$quantidade,$preco)){
        $data = [
            "sucesso" => true,
            
        ];
        ChaveApi::buscarCabecalho($data);
       }
       else{
        $data = [
            "sucesso" => true,
            
        ];
        ChaveApi::buscarCabecalho($data);
       }

        
    }
    public function deletarPedidos()
    {
        $dados = ChaveApi::CabecalhoDecode();
        $idPedido = $dados['idPedido'];
        if ($this->pedidos->deletarPedido($idPedido)) {
        $data = [
            "sucesso" => true,
            
        ];
        ChaveApi::buscarCabecalho($data);
       }
       else{
        $data = [
            "sucesso" => true,
            
        ];
        ChaveApi::buscarCabecalho($data);
       }
    }

    public function deletarItemPedidos(){
        $dados = ChaveApi::CabecalhoDecode();
        $idItem = $dados['itemId'];
        if ($this->ItensPedidos->excluirItemPedido($idItem)) {
        $data = [
            "sucesso" => true,
            
        ];
        ChaveApi::buscarCabecalho($data);
       }
       else{
        $data = [
            "sucesso" => true,
            
        ];
        ChaveApi::buscarCabecalho($data);
       }
    }


    public function contarPedidosPorTipo($tipo){
        $contagem = $this->pedidos->contarPedidosPorTipo($tipo);
        $data = [
            "sucesso" => true,
            "contagem" => $contagem
        ];
        ChaveApi::buscarCabecalho($data);
    }

    public function ContarNotificacoes(){
        $contagem = $this->pedidos->contarPedidosPorTipo(1);
        $data = [
            "sucesso" => true,
            "contagem" => $contagem
        ];
        ChaveApi::buscarCabecalho($data);
    }
    public function atualizarMetodo(){
        
         $dados = ChaveApi::CabecalhoDecode();
         $pedidoID = $dados['pedidoId'];
         $valorTotal = $this->pagamento->calculaValorTotal($pedidoID);
         $dados['metodoid'] == '' ? null : $this->pagamento->atualizarMetodoPagamento(intval($pedidoID), intval($dados['metodoid']), intval($valorTotal));
         $dados['metodoStatus'] == '' ? null : $this->pagamento->atualizarStatusPagamento(intval($pedidoID), intval($dados['metodoStatus']), intval($valorTotal));
    }



    public function calculaValorTotal($pedidoID){
        $dados = $this->pagamento->calculaValorTotal($pedidoID);
        $data = [
            "sucesso" => true,
            "valorTotal" => $dados
        ];
        ChaveApi::buscarCabecalho($data);
    }

    public function buscarProdutos(){
        $produtos = $this->produtos->buscarProdutosAtivos();
            $data = [
            "sucesso" => true,
            "produtos" => $produtos,
        ];
        ChaveApi::buscarCabecalho($data);
    }

}