<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\TipoUsuario;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;


class TipoUsuarioControler {
    private $tipoUsuario;

    public function __construct($db){
        $this->tipoUsuario = new TipoUsuario($db);
    }

    public function listar(){
        echo json_encode($this->tipoUsuario->buscarTodos());
    }

    public function mostrar($id){
        echo json_encode($this->tipoUsuario->buscarPorId($id));
    }

    public function criar($descricao){
        $resultado = $this->tipoUsuario->inserir($descricao);
        echo json_encode(["success" => $resultado]);
    }

    public function atualizar($id, $descricao){
        $resultado = $this->tipoUsuario->atualizar($id, $descricao);
        echo json_encode(["success" => $resultado]);
    }
}
?>