<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\Usuario;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Session;
use App\Tadala\Core\Redirect;
use App\Tadala\Validadores\UsuarioValidador;


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
        View::render('auth/login', ['redirect' => $redirect], 'login');
    }

    public function viewRegister()
    {
        $redirect = $_GET['redirect'] ?? '/carrinho.php';
        View::render('auth/register', ['redirect' => $redirect], 'login');
    }

    public function authenticar()
    {
        $email = trim($_POST['email_usuario'] ?? $_POST['email'] ?? '');
        $senha = trim($_POST['senha_usuario'] ?? $_POST['senha'] ?? '');

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
        $this->session->set('tipo_usuario_id', $usuario['tipo_usuario_id'] ?? 3);
        $this->session->set('tipo_usuario_nome', $usuario['tipo_usuario_nome']);

        switch($this->session->get('tipo_usuario_id')) {
            case 1: case 2:
            header('Location: /backend/status-store');
            break;

            case 3:
            header('Location: /index.php');
            break;
        }
        
        exit;
    }

    public function cadastrarUsuario()
    {
        $redirect = $_POST['redirect'] ?? 'login';
        $erros = UsuarioValidador::ValidarEntradas($_POST);

        if (!empty($erros)) {
            Redirect::redirecionarComMensagem('/register', 'erros', implode("<br>", $erros));
        }

        $nome = $_POST['nome'] ?? null;
        $email = $_POST['email'] ?? null;
        $telefone = $_POST['telefone'] ?? null;
        $senha = $_POST['senha'] ?? null;
        $senha_confirm = $_POST['confirmar'] ?? null;

        if ($senha != $senha_confirm) {
            Redirect::redirecionarComMensagem('/register', 'erros', 'As senhas não conferem.');
        }

        // $email = trim($_POST['email_usuario'] ?? $_POST['email'] ?? '');
        // $senha = trim($_POST['senha_usuario'] ?? $_POST['senha'] ?? '');

        // if ($email === '' || $senha === '') {
        //     Redirect::redirecionarComMensagem('register', 'error', 'Email e senha são obrigatórios.');
        //     return;
        // }

        // $existente = $this->usuario->buscarUsuariosPorEMail($email);
        if (!empty($this->usuario->buscarUsuariosPorEMail($email))) {
            Redirect::redirecionarComMensagem('register', 'error', 'Email já cadastrado.');
            return;
        }

        $telefone = str_replace('(', '',
                        str_replace(')', '',
                            str_replace('-', '',
                                str_replace(' ', '', $telefone))));

        if (!empty($this->usuario->buscarUsuariosPorTelefone($telefone))) {
            Redirect::redirecionarComMensagem('register', 'error', 'Telefone já cadastrado.');
            return;
        }

        $nome = ucfirst(strtolower($nome));

        $novoUsuarioId = $this->usuario->inserirUsuario($nome, $email, $senha, $telefone);

        if ($novoUsuarioId) {
            Redirect::redirecionarComMensagem('login', 'success', 'Cadastro realizado! Por favor, faça o login.');
        } else {
            Redirect::redirecionarComMensagem('register', 'error', 'Erro no servidor. Tente novamente.');
        }

        // $nome = trim($_POST['nome'] ?? '');
        // if ($nome === '') {
        //     $nome = strstr($email, '@', true) ?: 'Usuário';

        // $telefone = trim($_POST['telefone'] ?? '');

        // if ($telefone === '') {
        //     $telefone = '0000000000';
        // }

        // $this->usuario->inserirUsuario($nome, $email, $senha, $telefone);

        // $usuario = $this->usuario->buscarUsuariosPorEMail($email);
        // if (!empty($usuario) && isset($usuario[0]['usuario_id'])) {
        //     $this->session->set('usuario_id', $usuario[0]['usuario_id']);
        //     $this->session->set('nome', $usuario[0]['nome'] ?? $nome);
        //     $this->session->set('email', $usuario[0]['email'] ?? $email);
        // }

        header('Location: ' . $redirect);
        exit;
    }

    public function logout()
    {
        $this->session->destroy();
        header('Location: login');
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
