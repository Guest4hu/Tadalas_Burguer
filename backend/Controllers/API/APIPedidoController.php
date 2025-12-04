<?php

namespace App\Tadala\Controllers\API;

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
        $dados = json_decode(file_get_contents("php://input"), true);
        $tamanho = count($dados);
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

     public function Items($id)
    {
        $valorTotal = 0;
        header("Application/json");
        $dados = $this->ItensPedidos->buscarPorIdItemPedido($id);
        for ($i = 0; $i < count($dados); $i++) {
            $valorTotal += $dados[$i]['valor_unitario'] * $dados[$i]['quantidade'];
            
        }
        $metodoPagamento = $this->metodo_pagamento->buscarTodosMetodosPagamento();
        $statusPagamento = $this->status_pagamento->buscarTodosStatusPagamento();
        $produtos = $this->produtos->buscarProdutosAtivos();
        echo json_encode([
            "sucesso" => true,
            "dados2" =>  $dados,
            "metodoPagamento" => $metodoPagamento,
            "statusPagamento" => $statusPagamento,
            "produtos" => $produtos,
            'valorTotal' => number_format($valorTotal, 2, ',', '.')
        ], JSON_PRETTY_PRINT);
    }

}