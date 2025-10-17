<?php

// victor

namespace App\Tadala\Controllers;

use App\Tadala\Models\TipoUsuario;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;


class TipoUsuarioController {
    private $tipoUsuario;
    public $db;

    public function __construct(){
        $this->db = Database::getInstance();
        $this->tipoUsuario = new TipoUsuario($this->db);
    }
    public function index(){
        View::render("tipoUsuario/index");
    }

    public function viewListarTodosTipoUsuario(){
        $this->tipoUsuario->buscarTodosTipoUsuario();
        
    }

    public function viewListarTipoUsuario($id){
    $this->tipoUsuario->buscarPorIdTipoUsuario($id);
    View::render("tipoUsuario/index");
    }

    public function viewCriarTipoUsuario($descricao){
        $this->tipoUsuario->inserirTipoUsuario($descricao);
       View::render("tipoUsuario/create");
    }

    public function viewatualizarTipoUsuario($id, $descricao){
        $this->tipoUsuario->atualizarTipoUsuario($id, $descricao);
       View::render("tipoUsuario/edit");
    }
}
?>