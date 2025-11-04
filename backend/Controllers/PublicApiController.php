<?php
namespace App\Tadala\Controllers;

use App\Tadala\Models\Servico;
use App\Tadala\Database\Database;
use App\Tadala\Models\Produto;
use App\Tadala\Models\Pedido;

class PublicApiController{
    // As informações a serem exibidas estão nas models
    private $produtoModel;
    public function __construct(){
        $db = Database::getInstance();
        $this->produtoModel = new Produto($db);
    }

public function getProdutos() {
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

}