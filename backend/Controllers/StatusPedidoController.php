<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\StatusPedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;

class StatusPedidoController
{
    public $statusPedido;
    public $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->statusPedido = new StatusPedido($this->db);
    }

    public function viewListarStatusPedido($pagina = 1)
    {
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->statusPedido->paginacaoStatusPedido($pagina);
        $total = $this->statusPedido->totalStatusPedido();
        $total_inativos = $this->statusPedido->totalStatusPedidoInativos();
        $total_ativos = $this->statusPedido->totalStatusPedidoAtivos();
        View::configuracaoIndex(
            "statusPedido/index",
            [
                "status_pedidos" => $dados['data'],
                "total" => $total['total'],
                "total_inativos" => $total_inativos['total'],
                "total_ativos" => $total_ativos['total'],
                'paginacao' => $dados
            ]
        );
    }

    public function viewCriarStatusPedido()
    {
        $descricao = $_POST['descricao'] ?? '';

        View::render("statusPedido/create", [
            'descricao' => htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function salvarStatusPedido()
    {
        $descricao = trim($_POST['descricao'] ?? '');
        
        if (empty($descricao)) {
            Redirect::redirecionarComMensagem("statusPedido", "error", "A descrição não pode ser vazia!");
            return;
        }

        $resultado = $this->statusPedido->inserirStatusPedido($descricao);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("statusPedido", "success", "Status de pedido criado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("statusPedido", "error", "Erro ao criar status de pedido!");
        }
    }

    public function viewEditarStatusPedido(int $id)
    {
        $id = intval($id);
        $status = $this->statusPedido->buscarPorIdStatusPedido($id);

        if (!$status) {
            Redirect::redirecionarComMensagem("statusPedido", "error", "Status de pedido não encontrado!");
            return;
        }

        View::render("statusPedido/edit", [
            "id" => $status['id'],
            "descricao" => htmlspecialchars($status['descricao'] ?? '', ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function atualizarStatusPedido()
    {
        $id = intval($_POST['id'] ?? 0);
        $descricao = trim($_POST['descricao'] ?? '');

        if ($id <= 0 || empty($descricao)) {
            Redirect::redirecionarComMensagem("statusPedido", "error", "ID e descrição são obrigatórios!");
            return;
        }

        $resultado = $this->statusPedido->atualizarStatusPedido($id, $descricao);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("statusPedido", "success", "Status de pedido atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("statusPedido", "error", "Erro ao atualizar status de pedido!");
        }
    }

    public function viewExcluirStatusPedido($id)
    {
        $id = intval($id);
        $resultado = $this->statusPedido->excluirStatusPedido($id);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("statusPedido", "success", "Status de pedido excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("statusPedido", "error", "Erro ao excluir status de pedido!");
        }
    }

    public function deletarStatusPedido()
    {
        $id = intval($_POST['id'] ?? 0);
        
        if ($id <= 0) {
            Redirect::redirecionarComMensagem("statusPedido", "error", "ID inválido!");
            return;
        }

        $resultado = $this->statusPedido->excluirStatusPedido($id);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("statusPedido", "success", "Status de pedido excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("statusPedido", "error", "Erro ao excluir status de pedido!");
        }
    }
}
