<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Database\Database;
use App\Tadala\Models\Usuario;
use App\Tadala\Models\Pagamento;
use PDO;

class AnalisesController
{
    public $usuario;
    public $db;

    public $pagamento;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->usuario = new Usuario($this->db);
        $this->pagamento = new Pagamento($this->db);
    }


    public function index()
    {
        View::render("analises/index");
    }

    public function viewPedidos()
    {
        View::render("analises/pedidos/index");
    }

    public function viewProdutos()
    {
        View::render("analises/produtos/index");
    }

    public function viewVendas()
    {
        $vendasTotais = $this->pagamento->TotalVendas();
        View::render("analises/vendas/index",[
            'vendastotal' => $vendasTotais,
        ]);
    }
}
