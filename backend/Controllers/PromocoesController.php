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
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->promocoes->paginacaoPromocoes($pagina);
        $total = $this->promocoes->totalPromocoes();
        $total_inativos = $this->promocoes->totalPromocoesInativas();
        $total_ativos = $this->promocoes->totalPromocoesAtivos();
        View::render("promocoes/index", 
        [
        "promocoes"=> $dados['data'],
         "total_"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
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
