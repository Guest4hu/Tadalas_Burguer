<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\Redirect;
use App\Tadala\Models\Produto;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;

class ProdutosController
{
    private $produtos;
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->produtos = new Produto($this->db);
    }

   
    public function index()
    {
        $resultado = $this->produtos->buscarTodosProduto();
        View::render("Produtos/index", [
            "Produtoss" => $resultado
        ]);
    }


    public function viewListarProdutos($pagina = 1)
    {
        $pagina = (int) ($pagina ?? 1);

        $dados = $this->produtos->paginacaoProduto($pagina);
        $total = $this->produtos->totalProduto();
        $total_inativos = $this->produtos->totalProdutoInativos();
        $total_ativos = $this->produtos->totalProdutoAtivos();

        View::render("produtos/index", [
            "Produtos"        => $dados['data'],
            "total_Produtos"  => $total,
            "total_inativos"   => $total_inativos,
            "total_ativos"     => $total_ativos,
            "paginacao"        => $dados
        ]);
    }

 
    public function mostrar($id)
    {
        $Produtos = $this->produtos->buscarPorIdProduto($id);

        View::render("produtos/mostrar", [
            "Produtos" => $Produtos
        ]);
    }

    public function viewCriarProdutos()
    {
        $nome       = $_POST['nome'] ?? '';
        $descricao  = $_POST['descricao'] ?? '';
        $preco      = $_POST['preco'] ?? '';
        $estoque    = $_POST['estoque'] ?? '';
        $categoria_id = $_POST['categoria'] ?? '';
        $imagem     = $_POST['imagem'] ?? '';

        View::render("produtos/create", [
            "nome"      => htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'),
            "descricao" => htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8'),
            "preco"     => htmlspecialchars($preco, ENT_QUOTES, 'UTF-8'),
            "estoque"   => htmlspecialchars($estoque, ENT_QUOTES, 'UTF-8'),
            "categoria" => htmlspecialchars($categoria_id, ENT_QUOTES, 'UTF-8'),
            "imagem"    => htmlspecialchars($imagem, ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function salvarProduto()
    {
        $nome       = trim($_POST['nome'] ?? '');
        $descricao  = trim($_POST['descricao'] ?? '');
        $preco      = trim($_POST['preco'] ?? '');
        $estoque    = trim($_POST['estoque'] ?? '');
        $categoria_id = intval($_POST['categoria'] ?? 0);
        $imagem     = $_POST['imagem'] ?? null;

        if (empty($nome) || empty($descricao) || empty($preco) || empty($estoque) || $categoria_id <= 0) {
            Redirect::redirecionarComMensagem("produtos", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        $resultado = $this->produtos->inserirProduto($nome, $descricao, $preco, $estoque, $categoria_id, $imagem);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("produtos", "success", "Produto cadastrado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("produtos", "error", "Erro ao cadastrar o produto!");
        }
    }

    public function viewEditarProdutos($id)
    {
        $id = intval($id);
        $produto = $this->produtos->buscarPorIdProduto($id);

        if (!$produto) {
            Redirect::redirecionarComMensagem("produtos", "error", "Produto não encontrado!");
            return;
        }

        View::render("produtos/edit", [
            "produto_id" => $produto['produto_id'],
            "nome"      => htmlspecialchars($produto['nome'] ?? '', ENT_QUOTES, 'UTF-8'),
            "descricao" => htmlspecialchars($produto['descricao'] ?? '', ENT_QUOTES, 'UTF-8'),
            "preco"     => htmlspecialchars($produto['preco'] ?? '', ENT_QUOTES, 'UTF-8'),
            "estoque"   => htmlspecialchars($produto['estoque'] ?? '', ENT_QUOTES, 'UTF-8'),
            "categoria_id" => intval($produto['categoria_id'] ?? 0),
            "foto_produto" => htmlspecialchars($produto['foto_produto'] ?? '', ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function atualizarProduto()
    {
        $id         = intval($_POST['id'] ?? 0);
        $nome       = trim($_POST['nome'] ?? '');
        $descricao  = trim($_POST['descricao'] ?? '');
        $preco      = trim($_POST['preco'] ?? '');
        $estoque    = trim($_POST['estoque'] ?? '');
        $categoria_id = intval($_POST['categoria'] ?? 0);
        $imagem     = $_POST['imagem'] ?? null;

        if ($id <= 0 || empty($nome) || empty($descricao) || empty($preco) || empty($estoque) || $categoria_id <= 0) {
            Redirect::redirecionarComMensagem("produtos", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        $resultado = $this->produtos->atualizarProduto($id, $nome, $descricao, $preco, $estoque, $categoria_id, $imagem);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("produtos", "success", "Produto atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("produtos", "error", "Erro ao atualizar o produto!");
        }
    }


   
    public function deletarProdutos($id)
    {
        $id = intval($id);
        $resultado = $this->produtos->deletarProduto($id);

        if ($resultado) {
            Redirect::redirecionarComMensagem("produtos", "success", "Produto excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("produtos", "error", "Erro ao excluir produto!");
        }
    }

   
    public function reativarProdutos($id)
    {
        $id = intval($id);
        $resultado = $this->produtos->reativarProduto($id);

        if ($resultado) {
            Redirect::redirecionarComMensagem("produtos", "success", "Produto reativado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("produtos", "error", "Erro ao reativar produto!");
        }
    }
}
