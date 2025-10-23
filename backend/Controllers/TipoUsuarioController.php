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

    public function viewListarTodosTipoUsuario($pagina=1){
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->tipoUsuario->paginacaoTipoUsuario($pagina);
        $total = $this->tipoUsuario->totalTipoUsuario();
        $total_inativos = $this->tipoUsuario->totalTipoUsuarioInativos();
        $total_ativos = $this->tipoUsuario->totalTipoUsuarioAtivos();
        View::render("tipoUsuario/index", 
        [
        "tipoUsuario"=> $dados['data'],
         "total"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
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