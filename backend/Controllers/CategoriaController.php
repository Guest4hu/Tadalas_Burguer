<?php
// gustavo
namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;
use App\Tadala\Database\Database;
use App\Tadala\Models\Categoria;

class CategoriaController
{
    public $Categoria;
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->Categoria = new Categoria($this->db);
    }
 

    public function viewListarCategoria($pagina = 1)
    {
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->Categoria->paginacaoCategoria($pagina);
        $total = $this->Categoria->totalCategoria();
        $total_inativos = $this->Categoria->totalCategoriaInativos();
        $total_ativos = $this->Categoria->totalCategoriaAtivos();
        View::render("categoria/index", 
        [
        "categorias"=> $dados['data'],
         "total_"=> $total['total'],
        //  "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
    }
    public function viewCriarCategoria()
    {
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        
        View::render("categoria/create", [
            'nome' => htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'),
            'descricao' => htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function salvarCategoria()
    {
        $nome = trim($_POST['nome'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        
        if (empty($nome) || empty($descricao)) {
            Redirect::redirecionarComMensagem("categoria", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        try {
            $resultado = $this->Categoria->inserirCategoria($nome, $descricao);
            if ($resultado) {
                Redirect::redirecionarComMensagem("categoria", "success", "Categoria criada com sucesso!");
            } else {
                Redirect::redirecionarComMensagem("categoria", "error", "Erro ao criar categoria!");
            }
        } catch (\Exception $e) {
            Redirect::redirecionarComMensagem("categoria", "error", $e->getMessage());
        }
    }

    public function viewEditarCategoria($id)
    {
        $id = intval($id);
        $categoria = $this->Categoria->buscarPorIdCategoria($id);

        if (!$categoria) {
            Redirect::redirecionarComMensagem("categoria", "error", "Categoria não encontrada!");
            return;
        }

        View::render("categoria/edit", [
            "id_categoria" => $categoria['id_categoria'],
            "nome" => htmlspecialchars($categoria['nome'] ?? '', ENT_QUOTES, 'UTF-8'),
            "descricao" => htmlspecialchars($categoria['descricao'] ?? '', ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function atualizarCategoria()
    {
        $id = intval($_POST['id'] ?? 0);
        $nome = trim($_POST['nome'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');

        if ($id <= 0 || empty($nome) || empty($descricao)) {
            Redirect::redirecionarComMensagem("categoria", "error", "ID, nome e descrição são obrigatórios!");
            return;
        }

        try {
            $resultado = $this->Categoria->atualizarCategoria($id, $nome, $descricao);
            if ($resultado) {
                Redirect::redirecionarComMensagem("categoria", "success", "Categoria atualizada com sucesso!");
            } else {
                Redirect::redirecionarComMensagem("categoria", "error", "Erro ao atualizar categoria!");
            }
        } catch (\Exception $e) {
            Redirect::redirecionarComMensagem("categoria", "error", $e->getMessage());
        }
    }

    public function viewExcluirCategoria($id)
    {
        $id = intval($id);
        $resultado = $this->Categoria->excluirCategoria($id);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("categoria", "success", "Categoria excluída com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("categoria", "error", "Erro ao excluir categoria!");
        }
    }

    public function deletarCategoria()
   {
         $dados = json_decode(file_get_contents("php://input"),true);
         $idCategoria = $dados['id'];
          if ($this->Categoria->excluirCategoria($idCategoria)) {
            Redirect::redirecionarComMensagem("categoria", "success", "Categoria deletada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("categoria", "error", "Erro ao deletar categoria.");
        }
    }
}
