<?php
// gustavo
namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;
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
         var_dump($dados);
        exit;
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
        $usuario_id = $_POST['usuario_id'] ?? '';
        $cargo_id = $_POST['cargo_id'] ?? '';
        $status_funcionario_id = $_POST['status_funcionario_id'] ?? '';
        $salario = $_POST['salario'] ?? '';

        View::render("funcionarios/create", [
            "usuario_id" => htmlspecialchars($usuario_id, ENT_QUOTES, 'UTF-8'),
            "cargo_id" => htmlspecialchars($cargo_id, ENT_QUOTES, 'UTF-8'),
            "status_funcionario_id" => htmlspecialchars($status_funcionario_id, ENT_QUOTES, 'UTF-8'),
            "salario" => htmlspecialchars($salario, ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function salvarFuncionarios()
    {
        $usuario_id = intval($_POST['usuario_id'] ?? 0);
        $cargo_id = intval($_POST['cargo_id'] ?? 0);
        $status_funcionario_id = intval($_POST['status_funcionario_id'] ?? 0);
        $salario = trim($_POST['salario'] ?? '');

        if ($usuario_id <= 0 || $cargo_id <= 0 || $status_funcionario_id <= 0 || empty($salario)) {
            Redirect::redirecionarComMensagem("funcionarios", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        $resultado = $this->Funcionarios->inserirFuncionarios($usuario_id, $cargo_id, $status_funcionario_id, $salario);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("funcionarios", "success", "Funcionário cadastrado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("funcionarios", "error", "Erro ao cadastrar funcionário!");
        }
    }

    public function viewEditarFuncionarios($id)
    {
        $id = intval($id);
        $funcionario = $this->Funcionarios->buscarPorIdFuncionarios($id);

        if (!$funcionario) {
            Redirect::redirecionarComMensagem("funcionarios", "error", "Funcionário não encontrado!");
            return;
        }

        View::render("funcionarios/edit", [
            "funcionario_id" => $funcionario['funcionario_id'],
            "usuario_id" => intval($funcionario['usuario_id'] ?? 0),
            "cargo_id" => intval($funcionario['cargo_id'] ?? 0),
            "status_funcionario_id" => intval($funcionario['status_funcionario_id'] ?? 0),
            "salario" => htmlspecialchars($funcionario['salario'] ?? '', ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function atualizarFuncionarios()
    {
        $id = intval($_POST['id'] ?? 0);
        $cargo_id = intval($_POST['cargo_id'] ?? 0);
        $status_funcionario_id = intval($_POST['status_funcionario_id'] ?? 0);
        $salario = trim($_POST['salario'] ?? '');

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
