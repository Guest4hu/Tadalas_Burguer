<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Database\Database;
use App\Tadala\Models\Promocoes;

class PromocoesController
{
    public $promocoes;
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->promocoes = new Promocoes($this->db);
    }
    // index
    public function index()
    {
        $resultado = $this->promocoes->buscarPromocoes();
        View::render("promocoes/index", ["promocoes" => $resultado]);
        
    }


    public function viewListarPromocoes()
    {
        $dados = $this->promocoes->buscarPromocoes();
        View::render("promocoes/index", ["promocoess" => $dados]);
    }
    public function viewCriarPromocoes()
    {
        View::render("promocoes/create");
    }


    public function viewEditarPromocoes()
    {
        View::render("promocoes/edit");
    }
    public function viewExcluirPromocoes()
    {
        View::render("promocoes/delete");
    }

    public function salvarPromocoes()
    {
        echo "Salvar Promocoes";
    }
    public function atualizarPromocoes()
    {
        echo "Atualizar Promocoes";
    }
    public function deletarPromocoes()
    {
        echo "Deletar Promocoes";
    }
}
