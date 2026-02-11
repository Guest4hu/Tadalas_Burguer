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
       // $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->produtos = new Produto($this->db);
    }

    public function Items(){

        $dados = $this->produtos->buscarTodosProduto();   

        foreach ($dados as &$produto) {
            if (!empty($produto['foto_produto'])) {
                $imagePath = __DIR__ . '/../../../upload/' . $produto['foto_produto'];
                
                if (file_exists($imagePath)) {
                    $type = pathinfo($imagePath, PATHINFO_EXTENSION);
                    $data = file_get_contents($imagePath);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    $produto['foto_produto'] = $base64;
                }
            }
        }

        ChaveApi::buscarCabecalho($dados);
    }
}