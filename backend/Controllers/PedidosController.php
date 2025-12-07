<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\ItensPedido;
use App\Tadala\Models\MetodoPagamento;
use App\Tadala\Models\Produto;
use App\Tadala\Models\Pedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;
use App\Tadala\Models\Pagamento;
use App\Tadala\Models\StatusPagamento;
use App\Tadala\Models\StatusPedido;


class PedidosController
{   
    public $status_pagamento;
    public $metodo_pagamento;
    public $produtos;
    public $pedidos;
    public $db;
    public $ItensPedidos;
    public $statusPedido;

    public $pagamento;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->status_pagamento = new StatusPagamento($this->db);
        $this->metodo_pagamento = new MetodoPagamento($this->db);
        $this->pedidos = new Pedido($this->db);
        $this->ItensPedidos = new ItensPedido($this->db);
        $this->statusPedido = new StatusPedido($this->db);
        $this->produtos = new Produto($this->db);
        $this->pagamento = new Pagamento($this->db);
    }

    public function index()
    {
        $resultado = $this->pedidos->buscarTodosPedido();
        View::render("pedidos/index", ["pedidos" => $resultado]);
    }
}