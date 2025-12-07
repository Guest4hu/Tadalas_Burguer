<?php

namespace App\Tadala\Controllers;


use App\Tadala\Models\Pedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;



class PedidosController
{   
    public $pedidos;
    public $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->pedidos = new Pedido($this->db);
    }

    public function index()
    {
        $resultado = $this->pedidos->buscarTodosPedido();
        View::render("pedidos/index", ["pedidos" => $resultado]);
    }
}