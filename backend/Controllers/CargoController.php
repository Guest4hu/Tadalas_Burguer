<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\Cargo;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;

class CargoController {   
    public $cargo;
    public $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->cargo = new Cargo($this->db);
    }
    // index
    public function index()
    {
        $resultado = $this->cargo->buscarTodosCargo();
        View::render("cargo/index", ["cargos" => $resultado]);

    }


public function viewListarCargo($pagina=1){
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->cargo->paginacaoCargo($pagina);
        $total = $this->cargo->totalCargo();
        $total_inativos = $this->cargo->totalCargoInativos();
        $total_ativos = $this->cargo->totalCargoAtivos();
        View::render("cargo/index", 
        [
        "cargos"=> $dados['data'],
         "total"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados,
        ] 
        );
    }
    public function viewCriarCargo()
    {
        $descricao = $_POST['descricao'] ?? '';

        View::render("cargo/create", [
            'descricao' => htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8')
        ]);
    }


    public function viewEditarCargo(int $id)
    {
        $id = intval($id);
        $cargo = $this->cargo->buscarPorIdCargo($id);

        if (!$cargo) {
            Redirect::redirecionarComMensagem("cargo", "error", "Cargo não encontrado!");
            return;
        }

        View::render("cargo/edit", [
            "id" => $cargo['id'],
            "cargo_descricao" => htmlspecialchars($cargo['cargo_descricao'] ?? '', ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function viewExcluirCargo($id)
    {
        $id = intval($id);
        $resultado = $this->cargo->deletarCargo($id);

        if ($resultado) {
            Redirect::redirecionarComMensagem("cargo", "success", "Cargo excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("cargo", "error", "Erro ao excluir cargo!");
        }
    }

    public function criarCargo()
    {
        View::render("cargo/create");
    }

    public function salvarCargo()
    {
        $descricao = trim($_POST['descricao'] ?? '');
        
        if (empty($descricao)) {
            Redirect::redirecionarComMensagem('cargo', 'error', 'A descrição do cargo não pode ser vazia!');
            return;
        }

        $resultado = $this->cargo->inserirCargo($descricao);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem('cargo', 'success', 'Cargo criado com sucesso!');
        } else {
            Redirect::redirecionarComMensagem('cargo', 'error', 'Erro ao criar o cargo. Tente novamente.');
        }
    }

    public function atualizarCargo()
    {
        $id = intval($_POST['id'] ?? 0);
        $descricao = trim($_POST['descricao'] ?? '');

        if ($id <= 0 || empty($descricao)) {
            Redirect::redirecionarComMensagem('cargo', 'error', 'ID e descrição são obrigatórios!');
            return;
        }

        $resultado = $this->cargo->atualizarCargo($id, $descricao);
        
        if ($resultado > 0) {
            Redirect::redirecionarComMensagem('cargo', 'success', 'Cargo atualizado com sucesso!');
        } else {
            Redirect::redirecionarComMensagem('cargo', 'error', 'Nenhuma alteração realizada!');
        }
    }
    public function deletarCargo()
    {
         $dados = json_decode(file_get_contents("php://input"),true);
          $idCargo = $dados['id'];
          if ($this->cargo->deletarCargo($idCargo)) {
            Redirect::redirecionarComMensagem("cargos", "success", "Cargo deletado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("cargos", "error", "Erro ao deletar cargo.");
        }
    }
    
}
?>
