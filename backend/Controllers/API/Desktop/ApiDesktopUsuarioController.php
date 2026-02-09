<?php

namespace App\Tadala\Controllers\API\Desktop;

use App\Tadala\Models\Usuario;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;


class ApiDesktopUsuarioController
{
    public $usuarios;
    public $db;
    private $chaveAPI;
    

    public function __construct()
    {
        $this->chaveAPI = new ChaveApi();
        $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->usuarios = new Usuario($this->db);
    }

    public function Items(){
        $dados = $this->usuarios->buscarUsuariosAtivos();
        $this->usuarios->ativarSincronizacao();    
        ChaveApi::buscarCabecalho($dados);
    }
}
