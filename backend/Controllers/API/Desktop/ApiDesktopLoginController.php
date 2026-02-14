<?php 


namespace App\Tadala\Controllers\API\Desktop;
use App\Tadala\Models\Usuario;
use App\Tadala\Core\ChaveApi;
use App\Tadala\Database\Database;

class ApiDesktopLoginController
{
    public $usuarios;
    public $db;
    private $chaveAPI;
    

    public function __construct()
    {
        $this->chaveAPI = new ChaveApi();
        $this->chaveAPI->getChaveAPI();
        $this->db = Database::getInstance();
        $this->usuarios = new Usuario($this->db);
    }

    public function login(){
        $dados = json_decode(file_get_contents(filename: "php://input"),true);
        $usuario = $this->usuarios->buscarUsuariosPorEmailDesktop($dados['email']);
        if ($usuario && password_verify($dados['senha'], $usuario['senha'])) {
            ChaveApi::buscarCabecalho(['success' => true, 'message' => 'Login successful', 'user' => ['id' => $usuario['usuario_id'], 'nome' => $usuario['nome'], 'email' => $usuario['email'], 'telefone' => $usuario['telefone'], 'tipo_usuario_id' => $usuario['tipo_usuario_id']], 'autenticated' => true], 200);
        } else {
            ChaveApi::buscarCabecalho(['success' => false, 'message' => 'Invalid email or password']);
        }
    }
}

