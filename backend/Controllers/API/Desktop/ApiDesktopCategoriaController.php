<?php

namespace App\Tadala\Controllers\API\Desktop;

use App\Tadala\Models\Categoria;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;

class ApiDesktopCategoriaController
{
    public $categorias;
    public $db;
    private $chaveAPI;
    

    public function __construct()
    {
        $this->chaveAPI = new ChaveApi();
        $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->categorias = new Categoria($this->db);
    }

    public function Items(){
        $dados = $this->categorias->buscarCategoria();
        ChaveApi::buscarCabecalho(['dados' => $dados]);
    }

}