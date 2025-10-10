<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\Cargo;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;

class CargosController {   
    private $cargo;

    public function __construct($db){
        $this->cargo = new Cargo($db);
    }

    public function viewTodosCargo(){
        echo json_encode($this->cargo->buscarTodosCargo());
    }

    public function viewListarCargo($id){
        echo json_encode($this->cargo->buscarPorIdCargo($id));
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
