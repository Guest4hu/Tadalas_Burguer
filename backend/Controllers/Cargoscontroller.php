<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\Cargo;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;

class Cargoscontroller {
    private $cargo;

    public function __construct($db){
        $this->cargo = new Cargo($db);
    }

    public function listar(){
        echo json_encode($this->cargo->buscarTodos());
    }

    public function mostrar($id){
        echo json_encode($this->cargo->buscarPorId($id));
    }

    public function criar($descricao){
        $resultado = $this->cargo->inserir($descricao);
        echo json_encode(["success" => $resultado]);
    }

    public function atualizar($id, $descricao){
        $resultado = $this->cargo->atualizar($id, $descricao);
        echo json_encode(["success" => $resultado]);
    }
    
}
?>
