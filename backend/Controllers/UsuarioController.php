<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Database\Database;
use App\Tadala\Models\Usuario;

class UsuarioController
{
    public $usuario;
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->usuario = new Usuario($this->db);
    }
    // index
    public function index()
    {
        $resultado = $this->usuario->buscarUsuarios();
        var_dump($resultado);
    }


    public function viewListarUsuario()
    {
        $dados = $this->usuario->buscarUsuarios();
        View::render("usuario/index", ["usuarios" => $dados]);
    }
    public function viewCriarUsuario()
    {
        View::render("usuario/create");
    }


    public function viewEditarUsuario()
    {
        View::render("usuario/edit");
    }
    public function viewExcluirUsuario()
    {
        View::render("usuario/delete");
    }

    public function salvarUsuario()
    {
        echo "Salvar Usuario";
    }
    public function atualizarUsuario()
    {
        echo "Atualizar Usuario";
    }
    public function deletarUsuario()
    {
        echo "Deletar Usuario";
    }
}
