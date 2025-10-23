<?php
// gustavo
namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Database\Database;
use App\Tadala\Models\Funcionarios;

class FuncionariosController
{
    public $Funcionarios;
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->Funcionarios = new Funcionarios($this->db);
    }
    // index
    public function index()
    {
        $resultado = $this->Funcionarios->buscarFuncionarios();
        View::render("funcionarios/index", ["funcionarios" => $resultado]);
    }


    public function viewListarFuncionarios()
    {
       $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->Funcionarios->paginacaoFuncionarios($pagina);
        $total = $this->Funcionarios->totalFuncionarios();
        $total_inativos = $this->Funcionarios->totalFuncionariosInativos();
        $total_ativos = $this->Funcionarios->totalFuncionariosAtivos();
        View::render("funcionarios/index", 
        [
        "funcionarios"=> $dados['data'],
         "total_"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
    }
    public function viewCriarFuncionarios()
    {
        View::render("funcionarios/create");
    }


    public function viewEditarFuncionarios()
    {
        View::render("funcionarios/edit");
    }
    public function viewExcluirFuncionarios()
    {
        View::render("funcionarios/delete");
    }

    public function salvarFuncionarios()
    {
        echo "Salvar Funcionarios";
    }
    public function atualizarFuncionarios()
    {
        echo "Atualizar Funcionarios";
    }
    public function deletarFuncionarios()
    {
        echo "Deletar Funcionarios";
    }
}
