<?php

namespace App\Tadala\Controllers\API;

use App\Tadala\Models\Produto;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;

class APIProdutosController
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

    public function deletarProduto()
    {
        $dados = json_decode(file_get_contents("php://input"), true);
        $idProduto = $dados['id'];
        $this->produtos->deletarProduto($idProduto);
        ChaveApi::buscarCabecalho([
            "status" => "sucesso",
            "message" => "Produto deletado com sucesso!"
        ], 200);
    }

}