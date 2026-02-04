<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\Produto;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;
use App\Tadala\Models\Categoria;

class ProdutosController
{
    private $produtos;
    private $db;
    private $categorias;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->produtos = new Produto($this->db);
        $this->categorias = new Categoria($this->db);
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
        $categorias = $this->categorias->buscarCategoria();

        View::render("produtos/create", [
            "nome"      => htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'),
            "descricao" => htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8'),
            "preco"     => htmlspecialchars($preco, ENT_QUOTES, 'UTF-8'),
            "estoque"   => htmlspecialchars($estoque, ENT_QUOTES, 'UTF-8'),
            "categoria" => htmlspecialchars($categoria_id, ENT_QUOTES, 'UTF-8'),
            "imagem"    => htmlspecialchars($imagem, ENT_QUOTES, 'UTF-8'),
            "categorias" => $categorias
        ]);
    }

    public function salvarProduto()
    {
        $nome       = trim($_POST['nome'] ?? '');
        $descricao  = trim($_POST['descricao'] ?? '');
        $preco      = trim($_POST['preco'] ?? '');
        $estoque    = trim($_POST['estoque'] ?? '');
        $categoria_id = intval($_POST['categoria'] ?? 0);
        $imagem     = null;

        if (empty($nome) || empty($descricao) || empty($preco) || empty($estoque) || $categoria_id <= 0) {
            Redirect::redirecionarComMensagem("produtos", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        if (!$this->categorias->buscarPorIdCategoria($categoria_id)) {
            Redirect::redirecionarComMensagem("produtos", "error", "Categoria inválida.");
            return;
        }

        $imagem = $this->processarUploadImagem();
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
        $categorias = $this->categorias->buscarCategoria();

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
            "foto_produto" => htmlspecialchars($produto['foto_produto'] ?? '', ENT_QUOTES, 'UTF-8'),
            "categorias" => $categorias
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
        $imagem     = null;

        if ($id <= 0 || empty($nome) || empty($descricao) || empty($preco) || empty($estoque) || $categoria_id <= 0) {
            Redirect::redirecionarComMensagem("produtos", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        if (!$this->categorias->buscarPorIdCategoria($categoria_id)) {
            Redirect::redirecionarComMensagem("produtos", "error", "Categoria inválida.");
            return;
        }

        $imagem = $this->processarUploadImagem();
        if ($imagem === null) {
            $produtoAtual = $this->produtos->buscarPorIdProduto($id);
            $imagem = $produtoAtual['foto_produto'] ?? null;
        }
        $resultado = $this->produtos->atualizarProduto($id, $nome, $descricao, $preco, $estoque, $categoria_id, $imagem);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("produtos", "success", "Produto atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("produtos", "error", "Erro ao atualizar o produto!");
        }
    }

    public function deletarProduto()
    {
        $dados = json_decode(file_get_contents("php://input"), true);
        $idProduto = $dados['id'];
        if ($this->produtos->deletarProduto($idProduto)) {
            Redirect::redirecionarComMensagem("produtos", "success", "Produto deletado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("produtos", "error", "Erro ao deletar produto.");
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

    private function processarUploadImagem(): ?string
    {
        if (empty($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $arquivo = $_FILES['imagem'];
        $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'webp', 'avif'];

        if (!in_array($extensao, $permitidas, true)) {
            return null;
        }

        $uploadDir = __DIR__ . '/../upload';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $nomeArquivo = uniqid('produto_', true) . '.' . $extensao;
        $destino = $uploadDir . '/' . $nomeArquivo;

        if (!move_uploaded_file($arquivo['tmp_name'], $destino)) {
            return null;
        }

        return $nomeArquivo;
    }
}
