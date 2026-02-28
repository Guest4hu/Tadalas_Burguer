<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\Servico;
use App\Tadala\Database\Database;
use App\Tadala\Models\Produto;
use App\Tadala\Models\Pedido;
use App\Tadala\Models\Categoria;
use App\Tadala\Models\ItensPedido;
use App\Tadala\Models\TipoPedido;
use App\Tadala\Models\MetodoPagamento;
use App\Tadala\Models\Endereco;
use App\Tadala\Core\StatusLoja;
use App\Tadala\Core\Session;

class PublicApiController
{
    // As informações a serem exibidas estão nas models
    private $produtoModel;
    private $categoria;
    private $pedido;
    private $itensPedido;
    private $tipoPedido;
    private $metodoPagamento;
    private $endereco;
    private $session;
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->produtoModel = new Produto($this->db);
        $this->categoria = new Categoria($this->db);
        $this->pedido = new Pedido($this->db);
        $this->itensPedido = new ItensPedido($this->db);
        $this->tipoPedido = new TipoPedido($this->db);
        $this->metodoPagamento = new MetodoPagamento($this->db);
        $this->endereco = new Endereco($this->db);
        $this->session = new Session();
    }

    public function getProdutos()
    {
        // puxa os produtos ativos e devolve em forma de JSON
        $dados = $this->produtoModel->buscarProdutosAtivos();
        foreach ($dados as &$produto) {
            $produto['caminho_imagem'] = '/backend/upload/' . $produto['foto_produto'];
        }
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $dados
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
    public function getProdutosporCategoria($categoriaID)
    {
        $produtos = $this->produtoModel->buscarProdutosPorCategoria($categoriaID);
        foreach ($produtos as &$produto) {
            $produto['caminho_imagem'] = '/backend/upload/' . $produto['foto_produto'];
        }
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $produtos
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
    // API REST PARA O ENVIO DAS CATEGORIAS, PARA O FRONTEND EXIBIR AS CATEGORIAS DINAMICAMENTE
    public function getCategorias()
    {
        $categorias = $this->categoria->buscarCategoria();
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $categorias
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public function checkStatus()
    {
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => StatusLoja::getStatus(),
            'is_open' => StatusLoja::isOpen()
        ]);
    }

    public function getMeusPedidos()
    {
        header('Content-Type: application/json');
        
        $usuarioId = $this->session->get('usuario_id');
        
        if (!$usuarioId) {
            http_response_code(401);
            echo json_encode([
                'status' => 'error',
                'message' => 'Usuário não autenticado'
            ]);
            return;
        }

        try {
            // Busca pedidos do usuário
            $sql = "SELECT 
                        p.pedido_id,
                        p.criado_em,
                        p.atualizado_em,
                        sp.descricao as status_descricao,
                        sp.id as status_id,
                        tp.descricao_tipo as tipo_pedido
                    FROM tbl_pedidos p
                    INNER JOIN dom_status_pedido sp ON p.status_pedido_id = sp.id
                    INNER JOIN dom_tipo_pedido tp ON p.tipo_pedido = tp.id
                    WHERE p.usuario_id = :usuario_id 
                    AND p.excluido_em IS NULL
                    ORDER BY p.criado_em DESC
                    LIMIT 20";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':usuario_id', $usuarioId, \PDO::PARAM_INT);
            $stmt->execute();
            $pedidos = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Para cada pedido, busca os itens
            foreach ($pedidos as &$pedido) {
                $itens = $this->itensPedido->buscarPorIdItemPedido($pedido['pedido_id']);
                $pedido['itens'] = $itens;
                
                // Calcula valor total
                $total = 0;
                foreach ($itens as $item) {
                    $total += $item['valor_unitario'] * $item['quantidade'];
                }
                $pedido['valor_total'] = $total;
            }

            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'data' => $pedidos
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'Erro ao buscar pedidos'
            ]);
        }
    }
}