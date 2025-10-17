<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Database\Database;
use App\Tadala\Models\Agendamento;

class AgendamentoController
{
    public $agendamento;
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->agendamento = new Agendamento($this->db);
    }
    // index
    public function index()
    {
        $resultado = $this->agendamento->buscarAgendamentos();
        View::render("agendamento/index", ["agendamentos" => $resultado]);
        
    }


    public function viewListaragendamento($pagina=1){
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->agendamento->paginacaoAgendamento($pagina);
        $total = $this->agendamento->totalAgendamentos();
        $total_inativos = $this->agendamento->totalAgendamentosInativos();
        $total_ativos = $this->agendamento->totalAgendamentosAtivos();
        View::render("agendamento/index", 
        [
        "agendamentos"=> $dados['data'],
         "total"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
    }
    public function viewCriarAgendamento()
    {
        View::render("agendamento/create");
    }


    public function viewEditarAgendamento()
    {
        View::render("agendamento/edit");
    }
    public function viewExcluirAgendamento()
    {
        View::render("agendamento/delete");
    }

    public function salvarAgendamento()
    {
        echo "Salvar agendamento";
    }
    public function atualizarAgendamento()
    {
        echo "Atualizar agendamento";
    }
    public function deletarAgendamento()
    {
        echo "Deletar agendamento";
    }
}
