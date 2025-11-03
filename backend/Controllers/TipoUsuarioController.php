<?php

// victor

namespace App\Tadala\Controllers;

use App\Tadala\Core\Redirect;
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
        $resultado = $this->tipoUsuario->buscarTodosTipoUsuario();
        View::render("tipoUsuario/index", ["tipoUsuario" => $resultado]);

    }
    public function viewListarTipoUsuario($pagina = 1) {
    $pagina = isset($pagina) ? $pagina : 1;
    $dados = $this->tipoUsuario->paginacaoTipoUsuario($pagina);
    $total = $this->tipoUsuario->totalTipoUsuario();
    $total_inativos = $this->tipoUsuario->totalTipoUsuarioInativos();
    $total_ativos = $this->tipoUsuario->totalTipoUsuarioAtivos();
    
   View::render("tipoUsuario/index", [
        "usuarios" => $dados['data'],
        "total_TipoUsuarios" => $total,
        "total_inativos" => $total_inativos,
        "total_ativos" => $total_ativos,
        'paginacao' => $dados
        ]);
    }


    public function mostrar($id){
        $this->tipoUsuario->buscarPorIdTipoUsuario($id);
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

    // public function viewListarTipoUsuario($id) {
    // $this->tipoUsuario->buscarPorIdTipoUsuario($id);
    // View::render("tipoUsuario/index");
    // }

    public function criar($descricao){
        $resultado = $this->tipoUsuario->inserirTipoUsuario($descricao);
    }

    public function atualizar($id, $descricao){
        $resultado = $this->tipoUsuario->atualizarTipoUsuario($id, $descricao);
       
    }
    public function ViewExcluirTipoUsuario($id){
        $resultado = $this->tipoUsuario->excluirTipoUsuario($id);
        View::render("tipoUsuario/delete", ["id"=>$id, "resultado"=>$resultado]);
        Redirect::redirecionarComMensagem("tipoUsuario","success","Tipo de Usuário excluído com sucesso.");   
    }
}
?>