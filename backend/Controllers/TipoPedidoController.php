<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\Redirect;
use App\Tadala\Models\TipoPedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;


class TipoPedidoController
{
    public $tipoPedido;
    public $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->tipoPedido = new TipoPedido($this->db);
    }

    public function index()
    {
        $resultado = $this->tipoPedido->buscarTodosTipoPedido();
        View::configuracaoIndex("tipoPedido/index", ["tipoPedido" => $resultado]);
    }

    public function viewListarTipoPedido($pagina = 1)
    {
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->tipoPedido->paginacaoTipoPedido($pagina);
        $total = $this->tipoPedido->totalTipoPedido();
        $total_inativos = $this->tipoPedido->totalTipoPedidoInativos();
        $total_ativos = $this->tipoPedido->totalTipoPedidoAtivos();

        View::configuracaoIndex("tipoPedido/index", [
            "TipoPedido" => $dados['data'],
            "total" => $total['total'],
            "total_inativos" => $total_inativos['total'],
            "total_ativos" => $total_ativos['total'],
            'paginacao' => $dados
        ]);
    }

    public function mostrar($id)
    {
        $this->tipoPedido->buscarPorIdTipoPedido($id);
    }

    public function criar($descricao)
    {
        $resultado = $this->tipoPedido->inserirTipoPedido($descricao);
    }

    public function atualizar($id, $descricao)
    {
        $resultado = $this->tipoPedido->atualizarTipoPedido($id, $descricao);
    }
    
    public function ViewExcluirTipoPedido($id)
    {
        $resultado = $this->tipoPedido->excluirTipoPedido($id);
        View::configuracaoIndex("tipoPedido/delete", ["id" => $id, "resultado" => $resultado]);
        Redirect::redirecionarComMensagem("tipoPedido", "success", "Tipo de Pedido excluído com sucesso.");
    }
}
