<?php

// gustavo

namespace App\Tadala\Controllers;

use App\Tadala\Models\StatusPagamento;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;

class StatusPagamentoController {
    public $statusPagamento;
    public $db;
     public function __construct(){
         $this->db = Database::getInstance();
        $this->statusPagamento = new StatusPagamento($this->db);
    }

    public function index()
    {
        $resultado = $this->statusPagamento->buscarTodosStatusPagamento();
        View::render("statusPagamento/index", ["status_pagamentos" => $resultado]);
    }
   
    public function viewListarStatusPagamento($pagina = 1)
    {
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->statusPagamento->paginacaoStatusPagamento($pagina);
        $total = $this->statusPagamento->totalStatusPagamento();
        $total_inativos = $this->statusPagamento->totalStatusPagamentoInativos();
        $total_ativos = $this->statusPagamento->totalStatusPagamentoAtivos();
        
        View::render("statusPagamento/index", [
            "status_pagamentos" => $dados['data'],
            "total" => $total['total'],
            "total_inativos" => $total_inativos['total'],
            "total_ativos" => $total_ativos['total'],
            'paginacao' => $dados
        ]);
    }

    public function viewCriarStatusPagamento()
    {
        $descricao = $_POST['descricao'] ?? '';

        View::render("statusPagamento/create", [
            'descricao' => htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function salvarStatusPagamento()
    {
        $descricao = trim($_POST['descricao'] ?? '');
        
        if (empty($descricao)) {
            Redirect::redirecionarComMensagem("statusPagamento", "error", "A descrição não pode ser vazia!");
            return;
        }

        $resultado = $this->statusPagamento->inserirStatusPagamento($descricao);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("statusPagamento", "success", "Status de pagamento criado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("statusPagamento", "error", "Erro ao criar status de pagamento!");
        }
    }

    public function viewEditarStatusPagamento($id)
    {
        $id = intval($id);
        $status = $this->statusPagamento->buscarPorIdStatusPagamento($id);

        if (!$status) {
            Redirect::redirecionarComMensagem("statusPagamento", "error", "Status de pagamento não encontrado!");
            return;
        }

        View::render("statusPagamento/edit", [
            "id" => $status['id'],
            "descricao" => htmlspecialchars($status['descricao'] ?? '', ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function atualizarStatusPagamento()
    {
        $id = intval($_POST['id'] ?? 0);
        $descricao = trim($_POST['descricao'] ?? '');

        if ($id <= 0 || empty($descricao)) {
            Redirect::redirecionarComMensagem("statusPagamento", "error", "ID e descrição são obrigatórios!");
            return;
        }

        $resultado = $this->statusPagamento->atualizarStatusPagamento($id, $descricao);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("statusPagamento", "success", "Status de pagamento atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("statusPagamento", "error", "Erro ao atualizar status de pagamento!");
        }
    }

    public function viewExcluirStatusPagamento($id)
    {
        $id = intval($id);
        $resultado = $this->statusPagamento->excluirStatusPagamentoStatusPagamento($id);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("statusPagamento", "success", "Status de pagamento excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("statusPagamento", "error", "Erro ao excluir status de pagamento!");
        }
    }

    public function deletarStatusPagamento()
    {
        $id = intval($_POST['id'] ?? 0);
        
        if ($id <= 0) {
            Redirect::redirecionarComMensagem("statusPagamento", "error", "ID inválido!");
            return;
        }

        $resultado = $this->statusPagamento->excluirStatusPagamentoStatusPagamento($id);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("statusPagamento", "success", "Status de pagamento excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("statusPagamento", "error", "Erro ao excluir status de pagamento!");
        }
    }
}
?>
