<?php

namespace App\Tadala\Controllers\API\Desktop;

use App\Tadala\Models\ItensPedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;


class ApiDesktopItensPedidoController
{
    public $itensPedido;
    public $db;
    private $chaveAPI;
    

    public function __construct()
    {
        $this->chaveAPI = new ChaveApi();
        $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->itensPedido = new ItensPedido($this->db);
    }

    public function Items(){
        $dados = $this->itensPedido->buscarItensPedidoAtivos();    
        ChaveApi::buscarCabecalho($dados);
    }
}