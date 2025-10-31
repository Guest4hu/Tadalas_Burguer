<?php
// gustavo
namespace App\Tadala\Controllers;

use App\Tadala\Core\Redirect;
use App\Tadala\Core\View;
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
    // index
    public function index()
    {
        $resultado = $this->Categoria->buscarCategoria();
        View::render("categoria/index", ["categorias" => $resultado]);
        
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
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
    }
    public function viewCriarCategoria()
    {
      $nome = $_POST['nome'];
      $descricao = ['descricao'];
      
      View::render("categoria/create", 
      [
        'nome' => $nome,
        'descricao' => $descricao
      ]);
    }
    public function salvarCategoria(){
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        
        if(empty($nome)|| empty($descricao)){
            Redirect::redirecionarComMensagem("categoria", "error", "Todos o campos devem ser prechidos");

        }
        $this->Categoria->inserirCategoria($nome, $descricao);
        if(true){
            Redirect::redirecionarComMensagem("categoria", "success", "Categoria criada com sucesso");
        }

    }


    public function viewEditarCategoria()
    {
        View::render("categoria/edit");
    }
    public function viewExcluirCategoria()
    {
        View::render("categoria/delete");
    }

    public function atualizarCategoria()
    {
        echo "Atualizar Categoria";
    }
    public function deletarCategoria()
    {
        echo "Deletar Categoria";
    }
}
