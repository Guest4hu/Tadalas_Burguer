<?php
namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Models\Usuario;
use App\Tadala\Database\Database;
use App\Tadala\Core\Redirect;

class UsuarioController
{
    private $usuario;
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->usuario = new Usuario($this->db);
    }

 
    public function index()
    {
        $resultado = $this->usuario->buscarUsuarios();

       
        $total_usuarios   = count($resultado);
        $total_ativos     = 0; 
        $total_inativos   = 0;

        View::render("usuario/index", [
            "usuarios"        => $resultado,
            "total_usuarios"  => $total_usuarios,
            "total_ativos"    => $total_ativos,
            "total_inativos"  => $total_inativos
        ]);
    }


    public function viewListarUsuario($pagina = 1)
    {
        $dados = $this->usuario->paginacaoUsuario($pagina);
        $total = $this->usuario->totalUsuario();
        $total_ativos = $this->usuario->totalUsuarioAtivos();
        $total_inativos = $this->usuario->totalUsuarioInativos();

        View::render("usuario/index", [
            "usuarios"        => $dados['data'] ?? [],
            "total_usuarios"  => $total['total'] ?? 0,
            "total_ativos"    => $total_ativos['total'] ?? 0,
            "total_inativos"  => $total_inativos['total'] ?? 0,
            "paginacao"       => $dados
        ]);
    }











    public function viewCriarUsuario()
    {
        $nome  = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $telefone = $_POST['telefone'] ?? '';

     
        View::render("usuario/create", [
            "nome"  => htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'),
            "email" => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
            "senha" => htmlspecialchars($senha, ENT_QUOTES, 'UTF-8'),
            "telefone" => htmlspecialchars($telefone, ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function salvarUsuario()
    {

    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

 
    if (empty($nome) || empty($email) || empty($senha) || empty($telefone)) {
        Redirect::redirecionarComMensagem("usuario", "error", "Todos os campos são obrigatórios!");
        return;
    }

    
    $resultado = $this->usuario->inserirUsuario($nome, $email, $senha, $telefone);

    if ($resultado) {
        Redirect::redirecionarComMensagem("usuario", "success", "Usuário cadastrado com sucesso!");
    } else {
        Redirect::redirecionarComMensagem("usuario", "error", "Erro ao cadastrar Usuário!");
    }
    }







    public function viewEditarUsuario($id)
    {
        $nome = $_POST['nome'] ?? '';
        $email  = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $tipo = $_POST['tipo'] ?? '';
    
        View::render("usuario/edit", [
            "nome" => htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'),
            "email" => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
            "senha" => $senha,
            "tipo" => intval($tipo),
            "id" => $id
        ]);
    }

    public function atualizarUsuario()
    {
       
    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    $tipo =  $_POST['tipo'] ?? '';
   

    if ( empty($nome) || empty($email)) {
        Redirect::redirecionarComMensagem("usuario", "error", "ID, nome e email são obrigatórios!");
        return;
    }
    
    $resultado = $this->usuario->atualizarUsuario($id, $nome, $email, $senha, $tipo);

    if ($resultado) {
        Redirect::redirecionarComMensagem("usuario", "success", "Usuário atualizado com sucesso");
    } else {
        Redirect::redirecionarComMensagem("usuario", "error", "Erro ao atualizar Usuário!");
    } 
    }
    





    public function ViewExcluirUsuario($id){
        $resultado = $this->usuario->excluirUsuario($id);
        View::render("usuario/delete", ["id"=>$id, "resultado"=>$resultado]);
        Redirect::redirecionarComMensagem("usuario","success","Usuário excluído com sucesso.");   
    }

}


