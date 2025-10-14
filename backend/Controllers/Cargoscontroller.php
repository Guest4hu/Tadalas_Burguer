<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\Cargo;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;

class CargosController {   
    public $cargo;
    public $db;

    public function __construct($db){
        $this->db = Database::getInstance();
        $this->cargo = new Cargo($db);
    }

    public function viewTodosCargo(){
        echo json_encode($this->cargo->buscarTodosCargo());
    }

    public function viewListarCargo($pagina=1){
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->cargo->paginacaoCargo($pagina);
        $total = $this->cargo->totalCargo();
        $total_inativos = $this->cargo->totalCargoInativos();
        $total_ativos = $this->cargo->totalCargoAtivos();
        View::render("cargo/index", 
        [
        "cargo"=> $dados['data'],
         "total"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
    }

    public function viewCriarCargo($descricao){
        $resultado = $this->cargo->inserirCargo($descricao);
        echo json_encode(["success" => $resultado]);
    }

    public function atualizar($id, $descricao){
        $resultado = $this->cargo->atualizarCargo($id, $descricao);
        echo json_encode(["success" => $resultado]);
    }
    
}
?>
