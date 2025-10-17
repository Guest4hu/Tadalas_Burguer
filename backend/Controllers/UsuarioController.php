<?php

// gustavo

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
        View::render("usuario/index", ["usuarios" => $resultado]);
        
    }


public function viewListarUsuario($pagina=1){
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->usuario->paginacaoUsuario($pagina);
        $total = $this->usuario->totalUsuario();
        $total_inativos = $this->usuario->totalUsuarioInativos();
        $total_ativos = $this->usuario->totalUsuarioAtivos();
        View::render("usuario/index", 
        [
        "usuarios"=> $dados['data'],
         "total_usuarios"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
    }
    public function viewCriarUsuario()
    {
        View::render("usuario/create");
    }


    public function viewEditarUsuario(int $id){
        $dados = $this->usuario->buscarUsuariosPorID($id);
        foreach($dados as $usuario){
                $dados = $usuario;
        }
        View::render("usuario/edit", ["usuario"=> $dados ]);
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
    public function deletarUsuario($id)
    {
        $this->usuario->excluirUsuario($id);
        
    }
}
