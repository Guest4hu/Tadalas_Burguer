<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Database\Database;
use App\Tadala\Models\StatusFuncionario;

class StatusFuncionarioController
{
    public $StatusFuncionario;
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->StatusFuncionario = new StatusFuncionario($this->db);
    }
    // index
    public function index()
    {
        $resultado = $this->StatusFuncionario->buscarStatusFuncionarios();
        View::render("statusFuncionario/index", ["statusFuncionarios" => $resultado]);
        
    }


    public function viewListarStatusFuncionario()
    {
        $dados = $this->StatusFuncionario->buscarStatusFuncionarios();
        View::render("statusFuncionario/index", ["statusFuncionarios" => $dados]);
    }
    public function viewCriarStatusFuncionario()
    {
        View::render("statusFuncionario/create");
    }


    public function viewEditarStatusFuncionario()
    {
        View::render("statusFuncionario/edit");
    }
    public function viewExcluirStatusFuncionario()
    {
        View::render("statusFuncionario/delete");
    }

    public function salvarStatusFuncionario()
    {
        echo "Salvar statusFuncionario";
    }
    public function atualizarStatusFuncionario()
    {
        echo "Atualizar statusFuncionario";
    }
    public function deletarStatusFuncionario()
    {
        echo "Deletar statusFuncionario";
    }
}
