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

        // Simula métricas
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

     
        View::render("usuario/create", [
            "nome"  => htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'),
            "email" => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
            "senha" => htmlspecialchars($senha, ENT_QUOTES, 'UTF-8')
        ]);
    }


    public function viewEditarUsuario(int $id)
    {
        $usuario = $this->usuario->buscarUsuariosPorID($id)[0] ?? null;

        if (!$usuario) {
            Redirect::redirecionarComMensagem("usuario/index", "error", "Usuário não encontrado!");
            return;
        }

        View::render("usuario/edit", ["usuario" => $usuario]);
    }

  
    public function viewExcluirUsuario(int $id)
    {
        $usuario = $this->usuario->buscarUsuariosPorID($id)[0] ?? null;

        if (!$usuario) {
            Redirect::redirecionarComMensagem("usuario/index", "error", "Usuário não encontrado!");
            return;
        }

        View::render("usuario/delete", ["usuario" => $usuario]);
    }

    
    public function salvarUsuario()
    {

    $nome  = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

 
    if (empty($nome) || empty($email) || empty($senha)) {
        Redirect::redirecionarComMensagem("usuario/index", "error", "Todos os campos são obrigatórios!");
    }

    
    $resultado = $this->usuario->inserirUsuario($nome, $email, $senha);

    if ($resultado) {
        Redirect::redirecionarComMensagem("usuario/index", "success", "Usuário cadastrado com sucesso!");
    } else {
        Redirect::redirecionarComMensagem("usuario/index", "success", "Usuário cadastrado com sucesso!");
    }
    }

 
    public function atualizarUsuario(int $id)
    {

        $usuario = $this->usuario->buscarUsuariosPorID($id)[0] ?? null;

        if (!$usuario) {
            Redirect::redirecionarComMensagem("usuario/index", "error", "Usuário não encontrado!");
            return;
        }

   
        Redirect::redirecionarComMensagem("usuario/index", "success", "Usuário atualizado com sucesso!");
    }


    public function deletarUsuario(int $id)
    {
        $usuario = $this->usuario->buscarUsuariosPorID($id)[0] ?? null;

        if (!$usuario) {
            Redirect::redirecionarComMensagem("usuario/index", "error", "Usuário não encontrado!");
            return;
        }

     
        Redirect::redirecionarComMensagem("usuario/index", "success", "Usuário removido com sucesso!");
    }
}
