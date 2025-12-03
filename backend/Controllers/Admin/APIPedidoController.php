<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\ItensPedido;
use App\Tadala\Models\Produto;
use App\Tadala\Models\Pedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;
use App\Tadala\Models\StatusPedido;

class APIPedidoController
{
    public $produtos;
    public $pedidos;
    public $db;
    public $ItensPedidos;
    public $statusPedido;

    private $chaveAPI;
    

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->pedidos = new Pedido($this->db);
        $this->ItensPedidos = new ItensPedido($this->db);
        $this->statusPedido = new StatusPedido($this->db);
        $this->produtos = new Produto($this->db);
        $this->chaveAPI =  "5d242b5294d72df332ca2c492d2c0b9b";
    }

    private function validaChaveAPI(){
        $header = getallheaders();
        if (!isset($header['Authorization'])) {
            return false;
        }
        $Autorizar = explode(" ", $header['Authorization'])[1];
        return $Autorizar === $this->chaveAPI;
    }


    
    public function viewbuscarTipoPedidos($tipo){
        if (!$this->validaChaveAPI()) {
            header('Content-Type: application/json');
            http_response_code(401);
            echo json_encode([
                'status' => 'error',
                'message' => 'Acesso não autorizado. Chave API inválida.'
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            exit;
        }
    header("Content-Type: application/json; charset=utf-8");

    $statusPed = $this->statusPedido->buscarTodosStatusPedido();
    $por_pagina = isset($_GET['por_pagina']) ? (int)$_GET['por_pagina'] : 30;
    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $dados = $this->pedidos->paginacao($pagina, $por_pagina, $tipo);

    echo json_encode([
        "sucesso" => true,
        "pedidos" => $dados['data'] ?? [],
        "statusPedido" => $statusPed ?? []
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

}
}