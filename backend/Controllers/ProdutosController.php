<?php

namespace App\Tadala\Controllers;

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

    public function criarProdutos($usuario_id, $rua, $numero, $bairro, $cidade, $estado, $cep)
    {
        $this->produtos->inserirProduto($usuario_id, $rua, $numero, $bairro, $cidade, $estado, $cep);

    
        header("Location: /backend/Produtos");
        exit;
    }

  
    public function atualizar($id, $rua, $numero, $bairro, $cidade, $estado, $cep)
    {
        $this->produtos->atualizarProduto($id, $rua, $numero, $bairro, $cidade, $estado, $cep);

       
        header("Location: /backend/Produtos");
        exit;
    }

   
    public function deletarProdutos($id)
    {
        $this->produtos->deletarProduto($id);

        header("Location: /backend/Produtos");
        exit;
    }

   
    public function reativarProdutos($id)
    {
        $this->produtos->reativarProduto($id);

        header("Location: /backend/Produtos");
        exit;
    }
}
?>
