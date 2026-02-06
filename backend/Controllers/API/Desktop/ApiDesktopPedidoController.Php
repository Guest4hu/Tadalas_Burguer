<?php

namespace App\Tadala\Controllers\API\Desktop;

use App\Tadala\Models\Pedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;


class ApiDesktopPedidoController
{
    public $pedidos;
    public $db;
    private $chaveAPI;
    

    public function __construct()
    {
        $this->chaveAPI = new ChaveApi();
        $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->pedidos = new Pedido($this->db);
    }

    public function Items(){
        $dados = $this->pedidos->buscarPedidoAtivos();    
        ChaveApi::buscarCabecalho($dados);
    }




}