<?php


namespace App\Tadala\Controllers;

use App\Tadala\Models\StatusPagamento;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;

class StatusPagamentoController {
    public $statusPagamento;
    public $db;
     public function __construct(){
         $this->db = Database::getInstance();
        $this->statusPagamento = new StatusPagamento($this->db);
    }

    public function index(){
        $this->statusPagamento->buscarTodosStatusPagamento();
        View::configuracaoIndex("statusPagamento/index");
    }
   
    public function viewlistarStatusPagamento($pagina=1){
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->statusPagamento->paginacaoStatusPagamento($pagina);
        $total = $this->statusPagamento->totalStatusPagamento();
        $total_inativos = $this->statusPagamento->totalStatusPagamentoInativos();
        $total_ativos = $this->statusPagamento->totalStatusPagamentoAtivos();
        View::configuracaoIndex("statusPagamento/index", 
        [
        "status_pagamentos"=> $dados['data'],
         "total"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
    }

    public function viewcriarStatusPagamento($descricao){
        $this->statusPagamento->inserirStatusPagamento($descricao);
        View::configuracaoIndex("statuspagamento/create");
        
    }

    public function atualizarStatusPagamento($id, $descricao){
        $this->statusPagamento->atualizarStatusPagamento($id, $descricao);
        
    }
}
?>
