<?php

namespace App\Tadala\Controllers\API\Desktop;

use App\Tadala\Models\Pedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;
use App\Tadala\Models\Usuario;
use App\Tadala\Models\ItensPedido;
use App\Tadala\Models\Endereco;
use App\Tadala\Models\Pagamento;


class ApiDesktopPedidoController
{

    public $itemPedido;
    public $pedidos;
    public $db;
    private $chaveAPI;
    
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
        $this->itemPedido = new ItensPedido($this->db);
        $this->endereco = new Endereco($this->db);
        $this->pagamento = new Pagamento($this->db);
    }

    public function Items(){
        $dados = $this->pedidos->buscaTodosPedidos();    
        ChaveApi::buscarCabecalho($dados);
    }

    public function newOrderData(){
        $dados = json_decode(file_get_contents("php://input"),true);
        try {
        $usuarioid = $dados['usuario_id'] ?? $this->usuario->inserirUsuarioDesktopPeido($dados['userData']['nome'], $dados['userData']['password'], $dados['userData']['telefone']);
        } catch (\Exception $e) {
            ChaveApi::buscarCabecalho([
                "status" => "erro",
                "message" => "Erro ao criar usuário: " . $e->getMessage()
            ], 500);
            return;
        }
        try{
        $pedidoID = $this->pedidos->inserirPedido($usuarioid,$dados['tipo_pedido_id']);
        } catch (\Exception $e) {
            ChaveApi::buscarCabecalho([
                "status" => "erro",
                "message" => "Erro ao criar pedido: " . $e->getMessage()
            ], 500);
            return;
        }
        try {
        foreach($dados['items'] as $item){
            $this->itemPedido->inserirItemPedido($pedidoID, $item['id_produto'], $item['quantidade'], $item['preco_unitario']);
        }
        } catch (\Exception $e) {
            ChaveApi::buscarCabecalho([
                "status" => "erro",
                "message" => "Erro ao adicionar itens ao pedido: " . $e->getMessage()
            ], 500);
            return;
        }
        try {
        if ($dados['address']['endereco_id'] == null) {
            $this->endereco->inserirEndereco($usuarioid, $dados['address']['rua'], $dados['address']['numero'], $dados['address']['bairro'], $dados['address']['cidade'] ?? '', $dados['address']['estado'] ?? '', $dados['address']['cep']);
        } else {
            $this->endereco->atualizarEndereco($dados['address']['endereco_id'], $dados['address']['rua'], $dados['address']['numero'], $dados['address']['bairro'], $dados['address']['cidade'] ?? '', $dados['address']['estado'] ?? '', $dados['address']['cep']);
        }
        } catch (\Exception $e) {
            ChaveApi::buscarCabecalho([
                "status" => "erro",
                "message" => "Erro ao criar/atualizar endereço: " . $e->getMessage()
            ], 500);
            return;
        }
        try {
        $this->pagamento->inserirPagamento($pedidoID, $dados['metodo_pagamento_id'], 1, $dados['subtotal']);
        } catch (\Exception $e) {
            ChaveApi::buscarCabecalho([
                "status" => "erro",
                "message" => "Erro ao criar pagamento: " . $e->getMessage()
            ], 500);
            return;
        }
        ChaveApi::buscarCabecalho([
            "status" => "sucesso",
            "message" => "Pedido criado com sucesso!",
            "pedido_id" => $pedidoID
        ], 201);
    }


}