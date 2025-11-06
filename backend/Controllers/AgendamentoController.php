<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;
use App\Tadala\Database\Database;
use App\Tadala\Models\Agendamento;

class AgendamentoController
{
    public $agendamento;
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->agendamento = new Agendamento($this->db);
    }
    // index
    public function index()
    {
        $resultado = $this->agendamento->buscarAgendamentos();
        View::render("agendamento/index", ["agendamentos" => $resultado]);
        
    }


    public function viewListaragendamento($pagina=1){
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->agendamento->paginacaoAgendamento($pagina);
        $total = $this->agendamento->totalAgendamentos();
        $total_inativos = $this->agendamento->totalAgendamentosInativos();
        $total_ativos = $this->agendamento->totalAgendamentosAtivos();
        View::render("agendamento/index", 
        [
        "agendamentos"=> $dados['data'],
         "total"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
    }
    public function viewCriarAgendamento()
    {
        $data_hora_inicio = $_POST['data_hora_inicio'] ?? '';
        $data_hora_fim = $_POST['data_hora_fim'] ?? '';
        $usuario_id = $_POST['usuario_id'] ?? '';
        $mesa_id = $_POST['mesa_id'] ?? '';

        View::render("agendamento/create", [
            "data_hora_inicio" => htmlspecialchars($data_hora_inicio, ENT_QUOTES, 'UTF-8'),
            "data_hora_fim" => htmlspecialchars($data_hora_fim, ENT_QUOTES, 'UTF-8'),
            "usuario_id" => htmlspecialchars($usuario_id, ENT_QUOTES, 'UTF-8'),
            "mesa_id" => htmlspecialchars($mesa_id, ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function salvarAgendamento()
    {
        $data_hora_inicio = trim($_POST['data_hora_inicio'] ?? '');
        $data_hora_fim = trim($_POST['data_hora_fim'] ?? '');
        $usuario_id = intval($_POST['usuario_id'] ?? 0);
        $mesa_id = intval($_POST['mesa_id'] ?? 0);

        if (empty($data_hora_inicio) || empty($data_hora_fim) || $usuario_id <= 0 || $mesa_id <= 0) {
            Redirect::redirecionarComMensagem("agendamento", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        try {
            $resultado = $this->agendamento->inserirAgendamento($data_hora_inicio, $data_hora_fim, $usuario_id, $mesa_id);
            if ($resultado) {
                Redirect::redirecionarComMensagem("agendamento", "success", "Agendamento criado com sucesso!");
            } else {
                Redirect::redirecionarComMensagem("agendamento", "error", "Erro ao criar agendamento!");
            }
        } catch (\Exception $e) {
            Redirect::redirecionarComMensagem("agendamento", "error", $e->getMessage());
        }
    }

    public function viewEditarAgendamento($id)
    {
        $id = intval($id);
        $agendamento_data = $this->agendamento->buscarAgendamentoPorId($id);

        if (!$agendamento_data) {
            Redirect::redirecionarComMensagem("agendamento", "error", "Agendamento não encontrado!");
            return;
        }

        View::render("agendamento/edit", [
            "agendamento_id" => $agendamento_data['agendamento_id'],
            "data_hora_inicio" => htmlspecialchars($agendamento_data['data_hora_inicio'] ?? '', ENT_QUOTES, 'UTF-8'),
            "data_hora_fim" => htmlspecialchars($agendamento_data['data_hora_fim'] ?? '', ENT_QUOTES, 'UTF-8'),
            "usuario_id" => intval($agendamento_data['usuario_id'] ?? 0),
            "mesa_id" => intval($agendamento_data['mesa_id'] ?? 0)
        ]);
    }

    public function atualizarAgendamento()
    {
        $id = intval($_POST['id'] ?? 0);
        $data_hora_inicio = trim($_POST['data_hora_inicio'] ?? '');
        $data_hora_fim = trim($_POST['data_hora_fim'] ?? '');
        $usuario_id = intval($_POST['usuario_id'] ?? 0);
        $mesa_id = intval($_POST['mesa_id'] ?? 0);

        if ($id <= 0 || empty($data_hora_inicio) || empty($data_hora_fim) || $usuario_id <= 0 || $mesa_id <= 0) {
            Redirect::redirecionarComMensagem("agendamento", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        try {
            $resultado = $this->agendamento->atualizarAgendamento($id, $data_hora_inicio, $data_hora_fim, $usuario_id, $mesa_id);
            if ($resultado) {
                Redirect::redirecionarComMensagem("agendamento", "success", "Agendamento atualizado com sucesso!");
            } else {
                Redirect::redirecionarComMensagem("agendamento", "error", "Erro ao atualizar agendamento!");
            }
        } catch (\Exception $e) {
            Redirect::redirecionarComMensagem("agendamento", "error", $e->getMessage());
        }
    }

    public function viewExcluirAgendamento($id)
    {
        $id = intval($id);
        $resultado = $this->agendamento->excluirAgendamento($id);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("agendamento", "success", "Agendamento excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("agendamento", "error", "Erro ao excluir agendamento!");
        }
    }

    public function deletarAgendamento()
    {
        $id = intval($_POST['id'] ?? 0);
        
        if ($id <= 0) {
            Redirect::redirecionarComMensagem("agendamento", "error", "ID inválido!");
            return;
        }

        $resultado = $this->agendamento->excluirAgendamento($id);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("agendamento", "success", "Agendamento excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("agendamento", "error", "Erro ao excluir agendamento!");
        }
    }
}
