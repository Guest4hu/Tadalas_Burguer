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
        View::configuracaoIndex("statusFuncionario/index", ["statusFuncionarios" => $resultado]);
        
    }


    public function viewListarStatusFuncionario($pagina=1)
    {
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->StatusFuncionario->paginacaoStatusFuncionario($pagina);
        $total = $this->StatusFuncionario->totalStatusFuncionario();
        $total_inativos = $this->StatusFuncionario->totalStatusFuncionarioInativos();
        $total_ativos = $this->StatusFuncionario->totalStatusFuncionarioAtivos();
        View::configuracaoIndex("statusFuncionario/index", 
        [
        "statusFuncionarios"=> $dados['data'],
         "total_"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
    }
    public function viewCriarStatusFuncionario()
    {
        View::configuracaoIndex("statusFuncionario/create");
    }


    public function viewEditarStatusFuncionario()
    {
        View::configuracaoIndex("statusFuncionario/edit");
    }
    public function viewExcluirStatusFuncionario()
    {
        View::configuracaoIndex("statusFuncionario/delete");
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
