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

    // Exibe dashboard de usuários
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

    // Lista usuários com paginação
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

    // Form para criar usuário
    public function viewCriarUsuario()
    {
        $nome  = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $telefone = $_POST['telefone'] ?? '';

        View::render("usuario/create", [
            "nome"     => htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'),
            "email"    => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
            "senha"    => htmlspecialchars($senha, ENT_QUOTES, 'UTF-8'),
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

    // Form para editar usuário
    public function viewEditarUsuario($id)
    {
        $id = intval($id);
        $usuario = $this->usuario->buscarUsuariosPorId($id);

        if (!$usuario) {
            Redirect::redirecionarComMensagem("usuario", "error", "Usuário não encontrado!");
            return;
        }

        View::render("usuario/edit", [
            "nome"       => htmlspecialchars($usuario['nome'] ?? '', ENT_QUOTES, 'UTF-8'),
            "email"      => htmlspecialchars($usuario['email'] ?? '', ENT_QUOTES, 'UTF-8'),
            "senha"      => '', // Não exibir senha atual
            "tipo"       => intval($usuario['tipo'] ?? 1),
            "usuario_id" => $id
        ]);
    }

    // Atualizar usuário
    public function atualizarUsuario()
    {
        $id    = intval($_POST['id'] ?? 0);
        $nome  = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = trim($_POST['senha'] ?? '');
        $tipo  = intval($_POST['tipo'] ?? 1);

        if ($id <= 0 || empty($nome) || empty($email)) {
            Redirect::redirecionarComMensagem("usuario", "error", "ID, nome e email são obrigatórios!");
            return;
        }

        $resultado = $this->usuario->atualizarUsuario($id, $nome, $email, $senha, $tipo);

        if ($resultado) {
            Redirect::redirecionarComMensagem("usuario", "success", "Usuário atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("usuario", "error", "Erro ao atualizar Usuário!");
        }
    }

    // Excluir usuário
    public function viewExcluirUsuario($id)
    {
        $resultado = $this->usuario->excluirUsuario($id);           
        View::render("usuario/delete", [
            "usuario_id" => intval($id),
            "resultado"  => $resultado
        ]);
        if ($resultado) {
            Redirect::redirecionarComMensagem("usuario", "success", "Usuário excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("usuario", "error", "Erro ao excluir Usuário!");
        }
    }
}

