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
        $descricao = $_POST['descricao'];

        View::render("cargo/create", [
            'descricao' => $descricao
        ]);
    }


    public function viewEditarCargo(int $id){
        $dados = $this->cargo->buscarPorIdCargo($id);
        foreach($dados as $cargo){
                $dados = $cargo;
        }
        View::render("cargo/edit", ["cargo"=> $dados ]);
    }
    public function viewExcluirCargo()
    {
        View::render("cargo/delete");
    }
    public function criarCargo(){

        View::render("cargo/create");
    }

    public function salvarCargo()
    {
       $descricao = $_POST['descricao'] ?? '';
       if(empty($descricao)){
        Redirect::redirecionarComMensagem('cargo', 'error', 'A descrição do cargo não pode ser vazia.');
       }
         $resultado = $this->cargo->inserirCargo($descricao);
            if($resultado){
                Redirect::redirecionarComMensagem('cargo', 'success', 'Cargo criado com sucesso!');
            } else {
                Redirect::redirecionarComMensagem('cargo', 'error', 'Erro ao criar o cargo. Tente novamente.');
            }
    }
    public function atualizarCargo()
    {
        echo "Atualizar Cargo";
    }
    public function deletarCargo($id)
    {
        $this->cargo->deletarCargo($id);

    }
    
}
?>
