<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\Servico;
use App\Tadala\Database\Database;
use App\Tadala\Models\Produto;
use App\Tadala\Models\Pedido;
use App\Tadala\Models\Categoria;
use App\Tadala\Core\StatusLoja;

class PublicApiController
{
    // As informações a serem exibidas estão nas models
    private $produtoModel;
    private $categoria;
    public function __construct()
    {
        $db = Database::getInstance();
        $this->produtoModel = new Produto($db);
        $this->categoria = new Categoria($db);
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
}