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
    public function index(){
        View::render("tipousuario/index");
    }

    public function viewListarTodosTipoUsuario(){
        $this->tipoUsuario->buscarTodosTipoUsuario();
        
    }

    public function viewListarTipoUsuario($id){
    $this->tipoUsuario->buscarPorIdTipoUsuario($id);
    View::render("tipousuario/index");
    }

    public function viewCriarTipoUsuario($descricao){
        $this->tipoUsuario->inserirTipoUsuario($descricao);
       View::render("tipousuario/create");
    }

    public function viewatualizarTipoUsuario($id, $descricao){
        $this->tipoUsuario->atualizarTipoUsuario($id, $descricao);
       View::render("tipousuario/edit");
    }
}
?>