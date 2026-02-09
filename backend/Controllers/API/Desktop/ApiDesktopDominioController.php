<?php

namespace App\Tadala\Controllers\API\Desktop;

use App\Tadala\Models\TipoUsuario;
use App\Tadala\Models\TipoPedido;
use App\Tadala\Models\StatusPagamento;
use App\Tadala\Models\MetodoPagamento;
use App\Tadala\Models\StatusPedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\ChaveApi;

class ApiDesktopDominioController
{
    public $tipoUsuario;
    public $tipoPedido;
    public $statusPagamento;
    public $metodoPagamento;
    public $statusPedido;
    public $db;
    private $chaveAPI;
    

    public function __construct()
    {
        $this->chaveAPI = new ChaveApi();
        $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->tipoUsuario = new TipoUsuario($this->db);
        $this->tipoPedido = new TipoPedido($this->db);
        $this->statusPagamento = new StatusPagamento($this->db);
        $this->metodoPagamento = new MetodoPagamento($this->db);
        $this->statusPedido = new StatusPedido($this->db);
    }

    public function dominioTipoUsuario(){
        $dados = $this->tipoUsuario->buscarTodosTipoUsuario();
        ChaveApi::buscarCabecalho($dados);
    }
    public function dominioTipoPedido(){
        $dados = $this->tipoPedido->buscarTodosTipoPedido();
        ChaveApi::buscarCabecalho($dados);
    }
    public function dominioStatusPagamento(){
        $dados = $this->statusPagamento->buscarTodosStatusPagamento();
        ChaveApi::buscarCabecalho($dados);
    }

    public function dominioMetodoPagamento(){
        $dados = $this->metodoPagamento->buscarTodosMetodosPagamento();
        ChaveApi::buscarCabecalho($dados);
    }
    public function dominioStatusPedido(){
        $dados = $this->statusPedido->buscarTodosStatusPedido();
        ChaveApi::buscarCabecalho($dados);
    }

}