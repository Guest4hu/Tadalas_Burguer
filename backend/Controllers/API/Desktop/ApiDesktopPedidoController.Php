<?php

namespace App\Tadala\Controllers\API\Desktop;

use App\Tadala\Models\Pedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;
use App\Tadala\Models\Usuario;
use App\Tadala\Models\ItensPedido;
use App\Tadala\Models\Endereco;
use App\Tadala\Models\Pagamento;
use App\Tadala\Models\Produto;


class ApiDesktopPedidoController
{

    public $itemPedido;
    public $pedidos;
    public $db;
    private $chaveAPI;
    public $produtos;
    public $usuario;
    public $endereco;
    public $pagamento;

    public function __construct()
    {
        $this->chaveAPI = new ChaveApi();
        $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->pedidos = new Pedido($this->db);
        $this->usuario = new Usuario($this->db);
        $this->produtos = new Produto($this->db);
        $this->itemPedido = new ItensPedido($this->db);
        $this->endereco = new Endereco($this->db);
        $this->pagamento = new Pagamento($this->db);
    }

    public function Items(){
        $dados = $this->pedidos->buscaTodosPedidos();    
        ChaveApi::buscarCabecalho(['dados' => $dados]);
    }

    public function newOrderData(){
        $dados = json_decode(file_get_contents("php://input"),true);
        $usuarioid = $dados['usuario_id'] ?? $this->usuario->inserirUsuarioDesktopPedido($dados['userData']['nome'], $dados['userData']['password'], $dados['userData']['telefone']);
        $pedidoID = $this->pedidos->inserirPedido($usuarioid,$dados['tipo_pedido_id']);
        foreach($dados['items'] as $item){
            $this->itemPedido->inserirItemPedido($pedidoID, $item['id_produto'], $item['quantidade'], $item['preco_unitario']);
            $this->produtos->atualizarEstoque($item['id_produto'], $item['quantidade']);
        }
        if ($dados['address']) {
            if ($dados['address']['endereco_id'] == null) {
                $this->endereco->inserirEndereco($usuarioid, $dados['address']['rua'], $dados['address']['numero'], $dados['address']['bairro'], $dados['address']['cidade'] ?? '', $dados['address']['estado'] ?? '', $dados['address']['cep']);
            } else {
                $this->endereco->atualizarEndereco($dados['address']['endereco_id'], $dados['address']['rua'], $dados['address']['numero'], $dados['address']['bairro'], $dados['address']['cidade'] ?? '', $dados['address']['estado'] ?? '', $dados['address']['cep']);
            }
        }
        $this->pagamento->inserirPagamento($pedidoID, $dados['metodo_pagamento_id'], 1, $dados['subtotal']);
        ChaveApi::buscarCabecalho([
            "status" => "sucesso",
            "message" => "Pedido criado com sucesso!",
            "pedido_id" => $pedidoID
        ], 201);
    }
}