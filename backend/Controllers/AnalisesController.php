<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Database\Database;
use App\Tadala\Models\Usuario;

class AnalisesController
{
    public $usuario;
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->usuario = new Usuario($this->db);
    }
    

    public function index(){
        View::render("analises/index");
    }

    public function viewPedidos(){
        View::render("analises/pedidos/index");
    }

    public function viewProdutos(){
        View::render("analises/produtos/index");
    }

    public function viewVendas(){
        View::render("analises/vendas/index");
    }
}
