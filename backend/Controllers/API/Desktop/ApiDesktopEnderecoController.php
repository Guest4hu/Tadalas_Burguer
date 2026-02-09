<?php

namespace App\Tadala\Controllers\API\Desktop;

use App\Tadala\Models\Endereco;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;


class ApiDesktopEnderecoController
{
    public $enderecos;
    public $db;
    private $chaveAPI;
    

    public function __construct()
    {
        $this->chaveAPI = new ChaveApi();
        $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->enderecos = new Endereco($this->db);
    }

    public function Items(){
        $dados = $this->enderecos->buscarEnderecosPorUsuarioAtivo();   
        $this->enderecos->ativarSincronizacao(); 
        ChaveApi::buscarCabecalho($dados);
    }
}
