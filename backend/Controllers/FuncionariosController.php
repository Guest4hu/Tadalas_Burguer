<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
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
        View::render("funcionarios/index", ["funcionarioss" => $resultado]);
    }


    public function viewListarFuncionarios()
    {
        $dados = $this->Funcionarios->buscarFuncionarios();
        View::render("funcionarios/index", ["funcionarios" => $dados]);
    }
    public function viewCriarFuncionarios()
    {
        View::render("funcionarios/create");
    }


    public function viewEditarFuncionarios()
    {
        View::render("funcionarios/edit");
    }
    public function viewExcluirFuncionarios()
    {
        View::render("funcionarios/delete");
    }

    public function salvarFuncionarios()
    {
        echo "Salvar Funcionarios";
    }
    public function atualizarFuncionarios()
    {
        echo "Atualizar Funcionarios";
    }
    public function deletarFuncionarios()
    {
        echo "Deletar Funcionarios";
    }
}
