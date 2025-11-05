<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\FileManager;
use App\Tadala\Models\Produto;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;

class ProdutosController
{
    private $produtos;
    private $db;
    private $gerenciarImagem;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->produtos = new Produto($this->db);
        $this->gerenciarImagem = new FileManager('upload');
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
        $nome       = $_POST['nome'] ?? '';
        $descricao  = $_POST['descricao'] ?? '';
        $preco      =  intval($_POST['preco']) ?? '';
        $estoque    = $_POST['estoque'] ?? '';
        $categoria_id = $_POST['categoria'] ?? '';
        $imagem     = $_POST['imagem'] ?? '';

        if (empty($nome) || empty($descricao) || empty($preco) || empty($estoque) || empty($categoria_id)) {
            Redirect::redirecionarComMensagem("produtos", "error", "Todos os campos devem ser prenchidos");
        }

        $imagem = $this->gerenciarImagem->salvarArquivo($_FILES['imagem'], 'produtos');

        if ($this->produtos->inserirProduto(
            $nome,
            $descricao,
            $preco,
            $estoque,
            $categoria_id,
            $imagem
        )) {
            Redirect::redirecionarComMensagem("produtos", "success", "Produto cadastrado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("produtos", "error", "Erro ao cadastrar o produto!");
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
        $this->produtos->reativarProduto($id);

        header("Location: /backend/Produtos");
        exit;
    }
}






// public function atualizarServico() {
//         $id = (int)$_POST['id_servico'];
//         $nome = $_POST['nome_servico'];
//         $descricao = $_POST['descricao_servico'];
//         $imagem = null;

//         if (isset($_FILES['foto_servico']) && $_FILES['foto_servico']['error'] == 0 && !empty($_FILES['foto_servico']['name'])) {
//             $imagem = $this->gerenciarImagem->salvarArquivo($_FILES['foto_servico'], 'servicos');
//         }

//         if ($this->servico->atualizarServico($id, $nome, $descricao, $imagem)) {
//             Redirect::redirecionarComMensagem("servico/listar", "success", "Serviço atualizado com sucesso!");
//         } else {
//             Redirect::redirecionarComMensagem("servico/editar/" . $id, "error", "Erro ao atualizar serviço.");
//         }
//     }

//     public function viewExcluirServico(int $id) {
//         $servico = $this->servico->buscarPorID($id);
//         if (!$servico) {
//             Redirect::redirecionarComMensagem("servico/listar", "error", "Serviço não encontrado.");
//         }

//         View::render("servico/delete", ["servico" => $servico]);
//     }

//     public function deletarServico() {
//         $id = (int)$_POST['id_servico'];

//         if ($this->servico->deletarServico($id)) {
//             Redirect::redirecionarComMensagem("servico/listar", "success", "Serviço inativado com sucesso!");
//         } else {
//             Redirect::redirecionarComMensagem("servico/listar", "error", "Erro ao inativar serviço.");
//         }
//     }
// }