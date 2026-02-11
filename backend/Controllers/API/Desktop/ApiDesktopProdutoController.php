<?php

namespace App\Tadala\Controllers\API\Desktop;

use App\Tadala\Models\Produto;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;


class ApiDesktopProdutoController
{
    public $produtos;
    public $db;
    private $chaveAPI;
    

    public function __construct()
    {
        $this->chaveAPI = new ChaveApi();
        $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->produtos = new Produto($this->db);
    }

    public function Items(){

        $dados = $this->produtos->buscarTodosProduto();   
        ChaveApi::buscarCabecalho($dados);
    }
}