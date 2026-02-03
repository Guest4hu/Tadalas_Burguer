<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\Usuario;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Session;
use App\Tadala\Core\Redirect;

class AuthController
{
    private $usuario;
    private $session;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->usuario = new Usuario($db);
        $this->session = new Session();
    }

    public function viewLogin()
    {
        $redirect = $_GET['redirect'] ?? '/carrinho.php';
        View::renderPublic('auth/login', ['redirect' => $redirect]);
    }

    public function viewRegister()
    {
        $redirect = $_GET['redirect'] ?? '/carrinho.php';
        View::renderPublic('auth/register', ['redirect' => $redirect]);
    }

    public function authenticar()
    {
        $email = trim($_POST['email_usuario'] ?? $_POST['email'] ?? '');
        $senha = trim($_POST['senha_usuario'] ?? $_POST['senha'] ?? '');
        $redirect = $_POST['redirect'] ?? '/carrinho.php';

        if ($email === '' || $senha === '') {
            Redirect::redirecionarComMensagem('login', 'error', 'Email e senha são obrigatórios.');
            return;
        }

        $usuario = $this->usuario->checarCredenciais($email, $senha);
        if (!$usuario) {
            Redirect::redirecionarComMensagem('login', 'error', 'Credenciais inválidas.');
            return;
        }

        $this->session->set('usuario_id', $usuario['usuario_id']);
        $this->session->set('nome', $usuario['nome'] ?? 'Usuário');
        $this->session->set('email', $usuario['email'] ?? $email);

        header('Location: ' . $redirect);
        exit;
    }

    public function cadastrarUsuario()
    {
        $email = trim($_POST['email_usuario'] ?? $_POST['email'] ?? '');
        $senha = trim($_POST['senha_usuario'] ?? $_POST['senha'] ?? '');
        $redirect = $_POST['redirect'] ?? '/carrinho.php';

        if ($email === '' || $senha === '') {
            Redirect::redirecionarComMensagem('register', 'error', 'Email e senha são obrigatórios.');
            return;
        }

        $existente = $this->usuario->buscarUsuariosPorEMail($email);
        if (!empty($existente)) {
            Redirect::redirecionarComMensagem('register', 'error', 'Email já cadastrado.');
            return;
        }

        $nome = trim($_POST['nome'] ?? '');
        if ($nome === '') {
            $nome = strstr($email, '@', true) ?: 'Usuário';
        }

        $telefone = trim($_POST['telefone'] ?? '');
        if ($telefone === '') {
            $telefone = '0000000000';
        }

        $this->usuario->inserirUsuario($nome, $email, $senha, $telefone);

        $usuario = $this->usuario->buscarUsuariosPorEMail($email);
        if (!empty($usuario) && isset($usuario[0]['usuario_id'])) {
            $this->session->set('usuario_id', $usuario[0]['usuario_id']);
            $this->session->set('nome', $usuario[0]['nome'] ?? $nome);
            $this->session->set('email', $usuario[0]['email'] ?? $email);
        }

        header('Location: ' . $redirect);
        exit;
    }

    public function logout()
    {
        $this->session->destroy();
        header('Location: /carrinho.php');
        exit;
    }

    public function me()
    {
        header('Content-Type: application/json');
        $usuarioId = $this->session->get('usuario_id');
        if (!$usuarioId) {
            echo json_encode(['logged_in' => false]);
            return;
        }

        echo json_encode([
            'logged_in' => true,
            'usuario_id' => $usuarioId,
            'nome' => $this->session->get('nome'),
            'email' => $this->session->get('email')
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
