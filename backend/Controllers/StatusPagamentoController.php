<?php

// gustavo

namespace App\Tadala\Controllers;

use App\Tadala\Models\StatusPagamento;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;

class StatusPagamentoController {
    private $statusPagamento;

    public function index(){
        $this->statusPagamento->buscarTodosStatusPagamento();
        View::render("statuspagamento/index");
    }
    public function __construct($db){
        $this->statusPagamento = new StatusPagamento($db);
    }
    public function viewlistarStatusPagamento($id){
        $this->statusPagamento->buscarPorIdStatusPagamento($id);
        view::render("statuspagamento/listar");
        
    }

    public function viewcriarStatusPagamento($descricao){
        $this->statusPagamento->inserirStatusPagamento($descricao);
        View::render("statuspagamento/create");
        
    }

    public function atualizarStatusPagamento($id, $descricao){
        $this->statusPagamento->atualizarStatusPagamento($id, $descricao);
        
    }
}
?>
