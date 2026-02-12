<?php

// gustavo
namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;
use App\Tadala\Database\Database;
use App\Tadala\Models\StatusFuncionario;

class StatusFuncionarioController
{
    public $StatusFuncionario;
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->StatusFuncionario = new StatusFuncionario($this->db);
    }
    // index
    public function index()
    {
        $resultado = $this->StatusFuncionario->buscarStatusFuncionarios();
        View::configuracaoIndex("statusFuncionario/index", ["statusFuncionarios" => $resultado]);
    }

    public function viewListarStatusFuncionario($pagina = 1)
    {
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->StatusFuncionario->paginacaoStatusFuncionario($pagina);
        $total = $this->StatusFuncionario->totalStatusFuncionario();
        $total_inativos = $this->StatusFuncionario->totalStatusFuncionarioInativos();
        $total_ativos = $this->StatusFuncionario->totalStatusFuncionarioAtivos();
        View::configuracaoIndex(
            "statusFuncionario/index",
            [
                "statusFuncionarios" => $dados['data'],
                "total_" => $total['total'],
                "total_inativos" => $total_inativos['total'],
                "total_ativos" => $total_ativos['total'],
                'paginacao' => $dados
            ]
        );
    }

    public function viewCriarStatusFuncionario()
    {
        $descricao = $_POST['descricao'] ?? '';

        View::render("statusFuncionario/create", [
            'descricao' => htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function salvarStatusFuncionario()
    {
        $descricao = trim($_POST['descricao'] ?? '');
        
        if (empty($descricao)) {
            Redirect::redirecionarComMensagem("statusFuncionario", "error", "A descrição não pode ser vazia!");
            return;
        }

        $resultado = $this->StatusFuncionario->inserirStatusFuncionarios($descricao);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("statusFuncionario", "success", "Status de funcionário criado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("statusFuncionario", "error", "Erro ao criar status de funcionário!");
        }
    }

    public function viewEditarStatusFuncionario($id)
    {
        $id = intval($id);
        $status = $this->StatusFuncionario->buscarStatusFuncionariosPorId($id);

        if (!$status) {
            Redirect::redirecionarComMensagem("statusFuncionario", "error", "Status de funcionário não encontrado!");
            return;
        }

        View::render("statusFuncionario/edit", [
            "id" => $status['id'],
            "descricao" => htmlspecialchars($status['descricao'] ?? '', ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function atualizarStatusFuncionario()
    {
        $id = intval($_POST['id'] ?? 0);
        $descricao = trim($_POST['descricao'] ?? '');

        if ($id <= 0 || empty($descricao)) {
            Redirect::redirecionarComMensagem("statusFuncionario", "error", "ID e descrição são obrigatórios!");
            return;
        }

        $resultado = $this->StatusFuncionario->atualizarStatusFuncionarios($id, $descricao);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("statusFuncionario", "success", "Status de funcionário atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("statusFuncionario", "error", "Erro ao atualizar status de funcionário!");
        }
    }

}