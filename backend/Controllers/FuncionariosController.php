<?php
// gustavo
namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;
use App\Tadala\Database\Database;
use App\Tadala\Models\Funcionarios;
use App\Tadala\Models\Usuario;
use App\Tadala\Models\Cargo;
use App\Tadala\Models\StatusFuncionario;
use App\Tadala\Controllers\AdminController;

class FuncionariosController extends AdminController
{
    public $Funcionarios;
    public $usuario;
    public $cargo;

    public $status_funcionario;
    public $db;
    
    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getInstance();
        $this->Funcionarios = new Funcionarios($this->db);  
        $this->usuario = new Usuario($this->db);
        $this->status_funcionario = new StatusFuncionario($this->db);
        $this->cargo = new Cargo($this->db);

    }
    // index
    public function index()
    {
        $resultado = $this->Funcionarios->buscarFuncionarios();
        View::render("funcionarios/index", ["funcionarios" => $resultado]);
    }


    public function viewListarFuncionarios($pagina = 1)
    {
        $pagina = (int) ($pagina ?? 1);
        if ($pagina < 1) {
            $pagina = 1;
        }
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
        $data = $this->usuario->buscarUsuariosAtivos();
        $cargos = $this->cargo->buscarTodosCargo();
        $status_funcionarios = $this->status_funcionario->buscarStatusFuncionarios();

        View::render("funcionarios/create", [
            "userData" => $data,
            "cargosData" => $cargos,
            "statusFuncionariosData" => $status_funcionarios
        ]);
    }
    public function viewEditarFuncionarios($id)
    {
        $id = intval($id);
        $funcionario = $this->Funcionarios->buscarPorIdFuncionarios($id);
        $cargos = $this->cargo->buscarTodosCargo();
        $status_funcionarios = $this->status_funcionario->buscarStatusFuncionarios();

        View::render("funcionarios/edit", [
            "funcionario" => $funcionario,
            "cargosData" => $cargos,
            "statusFuncionariosData" => $status_funcionarios
        ]);
    }

    public function atualizarFuncionarios()
    {
        $id = intval($_POST['funcionario_id'] ?? 0);
        $cargo_id = intval($_POST['cargo_id'] ?? 0);
        $status_funcionario_id = intval($_POST['status_funcionario_id'] ?? 0);
        $salario = floatval(str_replace(',', '.', $_POST['salario'] ?? 0));




        if ($id <= 0 || $cargo_id <= 0 || $status_funcionario_id <= 0 || empty($salario)) {
            Redirect::redirecionarComMensagem("funcionarios", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        $resultado = $this->Funcionarios->atualizarFuncionarios($id, $cargo_id, $status_funcionario_id, $salario);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("funcionarios", "success", "Funcionário atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("funcionarios", "error", "Erro ao atualizar funcionário!");
        }
    }

    public function viewExcluirFuncionarios($id)
    {
        $id = intval($id);
        $resultado = $this->Funcionarios->excluirLogicamenteFuncionarios($id);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("funcionarios", "success", "Funcionário excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("funcionarios", "error", "Erro ao excluir funcionário!");
        }
    }

    public function deletarFuncionarios()
    {
        $id = intval($_POST['id'] ?? 0);
        
        if ($id <= 0) {
            Redirect::redirecionarComMensagem("funcionarios", "error", "ID inválido!");
            return;
        }

        $resultado = $this->Funcionarios->excluirLogicamenteFuncionarios($id);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("funcionarios", "success", "Funcionário excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("funcionarios", "error", "Erro ao excluir funcionário!");
        }
    }


}
