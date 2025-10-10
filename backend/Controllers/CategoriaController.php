<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Database\Database;
use App\Tadala\Models\Categoria;

class CategoriaController
{
    public $Categoria;
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->Categoria = new Categoria($this->db);
    }
    // index
    public function index()
    {
        $resultado = $this->Categoria->buscarCategoria();
        View::render("Categoria/index", ["Categorias" => $resultado]);
        
    }


    public function viewListarCategoria()
    {
        $dados = $this->Categoria->buscarCategoria();
        View::render("categoria/index", ["categorias" => $dados]);
    }
    public function viewCriarCategoria()
    {
        View::render("categoria/create");
    }


    public function viewEditarCategoria()
    {
        View::render("categoria/edit");
    }
    public function viewExcluirCategoria()
    {
        View::render("categoria/delete");
    }

    public function salvarCategoria()
    {
        echo "Salvar Categoria";
    }
    public function atualizarCategoria()
    {
        echo "Atualizar Categoria";
    }
    public function deletarCategoria()
    {
        echo "Deletar Categoria";
    }
}
