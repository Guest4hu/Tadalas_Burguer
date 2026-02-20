<?php

namespace App\Tadala\Controllers\API;

use App\Tadala\Core\ChaveApi;
use App\Tadala\Database\Database;
use App\Tadala\Models\Funcionarios;
use App\Tadala\Models\Usuario;
use App\Tadala\Core\Redirect;

    class APIFuncionariosController {

        public $Funcionarios;
        private $ChaveApi;
        private $db;

        public $user;


        public function __construct()
        {
            $this->ChaveApi = new ChaveApi();
            $this->ChaveApi->getChaveAPI();
            $this->db = Database::getInstance();
            $this->Funcionarios = new Funcionarios($this->db);
            $this->user = new Usuario($this->db);
        }

        public function criarFuncionario()
        {
            $dados = ChaveApi::CabecalhoDecode();
            $userID = $dados['usuario_id'] ?? $this->user->inserirUsuario($dados['nome'], $dados['email'], $dados['password'], $dados['telefone'] ?? null);
            $this->user->setTypeoUser($userID, 2);
            $cargoID = $dados['cargo_id'];
            $salario = $dados['salario'];
            $statusFuncionarioID = $dados['status_funcionario_id'];
            $this->Funcionarios->inserirFuncionarios($userID, $cargoID, $statusFuncionarioID, $salario);
            ChaveApi::buscarCabecalho([
                "status" => "sucesso",
                "message" => "Funcionário criado com sucesso!"
            ]);
        }
        public function deletarFuncionario()
        {
            $dados = ChaveApi::CabecalhoDecode();
            $funcionarioID = $dados['funcID'];
            $userID = $dados['userID'];
            $this->Funcionarios->excluirLogicamenteFuncionarios($funcionarioID);
            $this->user->setTypeoUser($userID, 3);
            ChaveApi::buscarCabecalho([
                "status" => "sucesso",
                "message" => "Funcionário deletado com sucesso!"
            ]);
        }
    }
