<?php

namespace App\Tadala\Controllers\API\Desktop;

use App\Tadala\Models\Pagamento;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;
class ApiDesktopPagamentoController
{
    public $pagamentos;
    public $db;
    private $chaveAPI;
    

    public function __construct()
    {
        $this->chaveAPI = new ChaveApi();
        $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->pagamentos = new Pagamento($this->db);
    }

    public function Items(){
        $dados = $this->pagamentos->buscarPagamentosAtivos();
        ChaveApi::buscarCabecalho($dados);
    }

}