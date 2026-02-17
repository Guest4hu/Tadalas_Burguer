<?php

namespace App\Tadala\Controllers\Api;

use App\Tadala\Http\Response;
use App\Tadala\Database\Database;
use App\Tadala\Models\Produto;

class ProdutosApiController {
    private $produtoModel;
    
    public function __construct()
    {
        $db = Database::getInstance();
        $this->produtoModel = new Produto($db);
    }

    public function getProdutos()
    {
        $dados = $this->addImagePath(
                    $this->produtoModel->buscarProdutosAtivos()
                );
        
        Response::json([
            'status' => 'success',
            'data' => $dados
        ]);
    }

    public function getProdutosPorCategoria($categoriaID)
    {
        $produtos = $this->addImagePath(
                        $this->produtoModel->buscarProdutosPorCategoria($categoriaID)
                    );
        
        Response::json([
            'status' => 'success',
            'data' => $produtos
        ]);
    }

    private function addImagePath($produtos) {
        foreach ($produtos as &$produto) {
            $produto['caminho_imagem'] = '/backend/upload/' . $produto['foto_produto'];
        }
        return $produtos;
    }
}
