<?php

namespace App\Tadala\Controllers;


use App\Tadala\Models\Pedido;
use App\Tadala\Models\ItensPedido;
use App\Tadala\Models\Produto;
use App\Tadala\Models\StatusPedido;
use App\Tadala\Models\Pagamento;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;
use App\Tadala\Controllers\AuthenticatedController;


class PedidosController extends AuthenticatedController
{   
    public $pedidos;
    public $itensPedidos;
    public $produtos;
    public $statusPedido;
    public $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getInstance();
        $this->pedidos = new Pedido($this->db);
        $this->itensPedidos = new ItensPedido($this->db);
        $this->produtos = new Produto($this->db);
        $this->statusPedido = new StatusPedido($this->db);
    }

    public function index()
    {
        $resultado = $this->pedidos->buscarTodosPedido();
        View::render("pedidos/index", ["pedidos" => $resultado]);
    }

    public function viewListarPedidos($pagina = 1, $por_pagina = 5)
    {
        header("Application/json");
        $buscaProduto = $this->produtos->buscarProdutosAtivos();
        $statusPed = $this->statusPedido->buscarTodosStatusPedido();
        $por_pagina = isset($por_pagina) ? $por_pagina : 5;
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->pedidos->paginacaoPedidoNovo($pagina, $por_pagina);
        $dados2 = $this->pedidos->paginacaoPedidoEmPreparo($pagina, $por_pagina);
        $dados3 = $this->pedidos->paginacaoPedidoEmEntrega($pagina, $por_pagina);
        $dados4 = $this->pedidos->paginacaoPedidoComcluido($pagina, $por_pagina);
        $dados5 = $this->pedidos->paginacaoPedidoCancelados($pagina, $por_pagina);
        View::render(
            "pedidos/index",
            [
                'produtos' => $buscaProduto,
            'statusPedido' => $statusPed,
            "pedidos5" => $dados5['data'],
            "pedidos4" => $dados4['data'],
            "pedidos3" => $dados3['data'],
            "pedidos2" => $dados2['data'],
            "pedidos" => $dados['data'],
            'paginacao' => $dados,
            'por_pagina' => $por_pagina,
        ]
    );
    }

    public function viewNovo($pagina = 1, $por_pagina = 20)
    {
        $statusPed = $this->statusPedido->buscarTodosStatusPedido();
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->pedidos->paginacaoPedidoNovo($pagina, $por_pagina);
        View::render(
            "pedidos/tipopedidos/novo",
            [
                'statusPedido' => $statusPed,
                "pedidos" => $dados['data'],
            ]
        );
    }

    public function viewPreparo($pagina = 1, $por_pagina = 20)
    {
        $statusPed = $this->statusPedido->buscarTodosStatusPedido();
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $dados = $this->pedidos->paginacaoPedidoEmPreparo($pagina, $por_pagina);
        View::render(
            "pedidos/tipopedidos/preparo",
            [
                'statusPedido' => $statusPed,
                "pedidos2" => $dados['data'],
            ]
        );
    }

    public function viewEmEntrega($pagina = 1, $por_pagina = 20)
    {
        $statusPed = $this->statusPedido->buscarTodosStatusPedido();
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $dados = $this->pedidos->paginacaoPedidoEmEntrega($pagina, $por_pagina);
        View::render(
            "pedidos/tipopedidos/entrega",
            [
                'statusPedido' => $statusPed,
                "pedidos3" => $dados['data'],
            ]
        );
    }

    public function viewConcluidos($pagina = 1, $por_pagina = 20)
    {
        $statusPed = $this->statusPedido->buscarTodosStatusPedido();
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $dados = $this->pedidos->paginacaoPedidoComcluido($pagina, $por_pagina);
        View::render(
            "pedidos/tipopedidos/concluidos",
            [
                'statusPedido' => $statusPed,
                "pedidos4" => $dados['data'],
            ]
        );
    }
    
    public function viewCancelados($pagina = 1, $por_pagina = 20)
    {
        $statusPed = $this->statusPedido->buscarTodosStatusPedido();
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $dados = $this->pedidos->paginacaoPedidoCancelados($pagina, $por_pagina);
        View::render(
            "pedidos/tipopedidos/cancelados",
            [
                'statusPedido' => $statusPed,
                "pedidos5" => $dados['data'],
            ]
        );
    }

    public function viewCriarPedidos()
    {
        View::render("pedidos/create");
    }


    public function viewEditarPedidos(int $id)
    {
        $dados = $this->pedidos->buscarPorIdPedido($id);
        foreach ($dados as $pedidos) {
            $dados = $pedidos;
        }
        View::render("pedidos/edit", ["pedidos" => $dados]);
    }

    public function viewExcluirPedidos()
    {
        View::render("pedidos/delete");
    }

    public function salvarPedidos()
    {
        echo "Salvar pedidos";
    }

    
    public function salvarPedido()
    {
        header('Content-Type: application/json');
        try {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (!is_array($dados)) {
                http_response_code(400);
                echo json_encode(['sucesso' => false, 'mensagem' => 'Payload inválido.']);
                return;
            }

            $usuarioId = isset($dados['usuario_id']) ? (int)$dados['usuario_id'] : 0;
            $tipoPedido = isset($dados['tipo_pedido']) ? (int)$dados['tipo_pedido'] : 1;
            $metodoPagamento = isset($dados['metodo_pagamento']) ? (int)$dados['metodo_pagamento'] : 1;
            $troco = isset($dados['troco']) ? trim($dados['troco']) : '';
            $itens = $dados['itens'] ?? [];

            if ($usuarioId <= 0 || empty($itens)) {
                http_response_code(422);
                echo json_encode(['sucesso' => false, 'mensagem' => 'Usuário e itens são obrigatórios.']);
                return;
            }

            $itensValidos = [];
            $valorTotal = 0;
            foreach ($itens as $item) {
                $produtoId = (int)($item['id'] ?? 0);
                $quantidade = (int)($item['quantidade'] ?? 0);
                $valor = (float)($item['preco'] ?? 0);
                if ($produtoId > 0 && $quantidade > 0 && $valor >= 0) {
                    $itensValidos[] = [
                        'produto_id' => $produtoId,
                        'quantidade' => $quantidade,
                        'valor' => $valor
                    ];
                    $valorTotal += $valor * $quantidade;
                }
            }

            // Adicionar taxa de entrega se for delivery (tipo 3)
            if ($tipoPedido == 3) {
                $valorTotal += 5.00;
            }

            if (count($itensValidos) === 0) {
                http_response_code(422);
                echo json_encode(['sucesso' => false, 'mensagem' => 'Nenhum item válido no pedido.']);
                return;
            }

            $this->db->beginTransaction();

            // Criar pedido (status_pedido_id = 1 está hardcoded no model)
            $pedidoId = $this->pedidos->inserirPedido($usuarioId, $tipoPedido);
            if (!$pedidoId) {
                $this->db->rollBack();
                http_response_code(500);
                echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao criar pedido.']);
                return;
            }

            // Inserir itens do pedido
            foreach ($itensValidos as $item) {
                $ok = $this->itensPedidos->inserirItemPedido(
                    $pedidoId,
                    $item['produto_id'],
                    $item['quantidade'],
                    $item['valor']
                );
                if (!$ok) {
                    $this->db->rollBack();
                    http_response_code(500);
                    echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao inserir itens do pedido.']);
                    return;
                }
            }

            // Inserir pagamento (status_pagamento_id = 1 = Pendente)
            $pagamento = new Pagamento($this->db);
            $pagamentoOk = $pagamento->inserirPagamento($pedidoId, $metodoPagamento, 1, $valorTotal);
            if (!$pagamentoOk) {
                $this->db->rollBack();
                http_response_code(500);
                echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao registrar pagamento.']);
                return;
            }

            $this->db->commit();
            echo json_encode(['sucesso' => true, 'pedido_id' => $pedidoId]);
        } catch (\Throwable $e) {
            if ($this->db && $this->db->inTransaction()) {
                $this->db->rollBack();
            }
            http_response_code(500);
            echo json_encode(['sucesso' => false, 'mensagem' => 'Erro inesperado.', 'erro' => $e->getMessage()]);
        }
    }

    public function testeSalvarPedido()
    {
        header('Content-Type: application/json');

        $payload = json_decode(file_get_contents('php://input'), true);
        if (!is_array($payload)) {
            $payload = $_REQUEST;
        }

        $usuarioId = isset($payload['usuario_id']) ? (int)$payload['usuario_id'] : 0;
        $produtoId = isset($payload['produto_id']) ? (int)$payload['produto_id'] : 0;
        $quantidade = isset($payload['quantidade']) ? (int)$payload['quantidade'] : 0;
        $valor = isset($payload['valor']) ? (float)$payload['valor'] : 0;
        $tipoPedido = isset($payload['tipo_pedido']) ? (int)$payload['tipo_pedido'] : 1;

        if ($usuarioId <= 0 || $produtoId <= 0 || $quantidade <= 0 || $valor < 0) {
            http_response_code(422);
            echo json_encode([
                'sucesso' => false,
                'mensagem' => 'Informe usuario_id, produto_id, quantidade e valor válidos.'
            ]);
            return;
        }

        try {
            $this->db->beginTransaction();
            $pedidoId = $this->pedidos->inserirPedido($usuarioId, $tipoPedido);
            if (!$pedidoId) {
                $this->db->rollBack();
                http_response_code(500);
                echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao criar pedido.']);
                return;
            }

            $ok = $this->itensPedidos->inserirItemPedido($pedidoId, $produtoId, $quantidade, $valor);
            if (!$ok) {
                $this->db->rollBack();
                http_response_code(500);
                echo json_encode(['sucesso' => false, 'mensagem' => 'Falha ao inserir item.']);
                return;
            }

            $this->db->commit();
            echo json_encode(['sucesso' => true, 'pedido_id' => $pedidoId]);
        } catch (\Throwable $e) {
            if ($this->db && $this->db->inTransaction()) {
                $this->db->rollBack();
            }
            http_response_code(500);
            echo json_encode(['sucesso' => false, 'mensagem' => 'Erro inesperado.', 'erro' => $e->getMessage()]);
        }
    }

    public function viewAtualizarPedidos(int $id, int $status)
    {
        $status = $status ?? 5;
        $dados = $this->pedidos->buscarPorIdPedido($id);
        echo "Atualizar pedidos";
            View::render("pedidos/atualizar", ["pedidos" => $dados, 'stat' => $status]);
        }

    public function atualizarItensPedidoQTD()
    {
        $dados = json_decode(file_get_contents("php://input"), true);
        $tamanho = count($dados);
        for ($i=0; $i <= $tamanho; $i++) {
            $id    = $dados['itens'][$i]['id'];
            $qtd   = intval($dados['itens'][$i]['quantidade']);
            if ($qtd > 0) {
                $this->itensPedidos->atualizarItemPedido($id, $qtd);
            } else {
                Redirect::redirecionarComMensagem("pedidos", "error", "Por favor, Verifique se os campos estão preenchidos corretamente!");
            }
        }
        Redirect::redirecionarComMensagem("pedidos", "success", "Items do Pedido atualizado com sucesso!");
    }

    public function AtualizarPedido()
    {
        $dados = json_decode(file_get_contents("php://input"), true);
        $status = $dados['status'];
        $idPedido = $dados['idPedido'];
        if ($this->pedidos->atualizarPedido($idPedido, $status)) {
            Redirect::redirecionarComMensagem("pedidos", "success", "Pedido atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("pedidos", "error", "Erro ao atualizar pedido.");
        }
    }
    public function adicionarPedidos() {
        $dados = json_decode(file_get_contents("php://input"), true);
        $quantidade = intval($dados['quantidade']);
        $idProduto = $dados['produtoId'];
        $idPedido = $dados['idPedido'];
        $preco =  str_replace(',', '.', floatval($dados['preco']));
        if ($this->itensPedidos->inserirItemPedido($idPedido,$idProduto,$quantidade,$preco)) {
            Redirect::redirecionarComMensagem("pedidos", "success", "Item adicionado ao pedido com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("pedidos", "error", "Erro ao adicionar item ao pedido.");
        }
    }
    public function deletarPedidos()
    {
        $dados = json_decode(file_get_contents("php://input"), true);
        $idPedido = $dados['idPedido'];
        if ($this->pedidos->deletarPedido($idPedido)) {
            Redirect::redirecionarComMensagem("pedidos", "success", "Pedido deletado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("pedidos", "error", "Erro ao deletar pedido.");
        }
    }

    public function deletarItemPedidos(){
        $dados = json_decode(file_get_contents("php://input"), true);
        $idItem = $dados['id'];
        if ($this->itensPedidos->excluirItemPedido($idItem)) {
            Redirect::redirecionarComMensagem("pedidos", "success", "Item deletado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("pedidos", "error", "Erro ao deletar item.");
        }
    }

    public function Items($id)
    {
        header("Application/json");
        $dados = $this->itensPedidos->buscarPorIdItemPedido($id);
        $dadosItems = $this->pedidos->buscarTodosPedido();
        echo json_encode([
            "sucesso" => true,
            "dados2" =>  $dados,
            "dadosItems" => $dadosItems
        ], JSON_PRETTY_PRINT);
    }
}
