<?php

namespace App\Tadala\Controllers;

use App\tadala\Models\Pagamento;
use App\Tadala\Core\View;

class PagamentoController
{
    private $pagamento;

    public function __construct($db)
    {
        $this->pagamento = new Pagamento($db);
    }

    public function viewListarTodosPagamentos()
    {
        $this->pagamento->buscarTodosPagamento();
    }

    public function viewListarporIdPagamento($id)
    {
        $this->pagamento->buscarPorIdPagamento($id);
        View::render("pagamento/index");
    }

    public function viewCriarPagamento($pedido_id, $metodo, $status_pagamento_id, $valor_total)
    {
        $this->pagamento->inserirPagamento($pedido_id, $metodo, $status_pagamento_id, $valor_total);
        View::render("pagamento/create");
    }

    public function viewAtualizarPagamento($id, $metodo, $status_pagamento_id, $valor_total)
    {
        $this->pagamento->atualizarPagamento($id, $metodo, $status_pagamento_id, $valor_total);
        View::render("pagameto/edit");
    }

    public function viewExcluirPagamento($id)
    {
        $this->pagamento->excluirPagamento($id);
        View::render("pagamento/delete");
    }

    public function viewreativarPagamento($id)
    {
        $this->pagamento->reativarPagamento($id);
        View::render("pagamento/reativar");
    }
}
