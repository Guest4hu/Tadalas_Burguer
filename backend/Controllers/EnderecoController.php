<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\Endereco;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;

class EnderecoController
{
    private $endereco;
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->endereco = new Endereco($this->db);
    }

   
    public function index()
    {
        $resultado = $this->endereco->buscarTodosEndereco();
        View::render("endereco/index", [
            "enderecos" => $resultado
        ]);
    }


    public function viewListarEndereco($pagina = 1)
    {
        $pagina = (int) ($pagina ?? 1);

        $dados = $this->endereco->paginacaoEndereco($pagina);
        $total = $this->endereco->totalEndereco();
        $total_inativos = $this->endereco->totalEnderecoInativos();
        $total_ativos = $this->endereco->totalEnderecoAtivos();

        View::render("endereco/index", [
            "enderecos"        => $dados['data'],
            "total_Enderecos"  => $total,
            "total_inativos"   => $total_inativos,
            "total_ativos"     => $total_ativos,
            "paginacao"        => $dados
        ]);
    }

 
    public function mostrar($id)
    {
        $endereco = $this->endereco->buscarPorIdEndereco($id);

        View::render("endereco/mostrar", [
            "endereco" => $endereco
        ]);
    }

    public function criarEndereco($usuario_id, $rua, $numero, $bairro, $cidade, $estado, $cep)
    {
        $this->endereco->inserirEndereco($usuario_id, $rua, $numero, $bairro, $cidade, $estado, $cep);

    
        header("Location: /backend/endereco");
        exit;
    }

  
    public function atualizar($id, $rua, $numero, $bairro, $cidade, $estado, $cep)
    {
        $this->endereco->atualizarEndereco($id, $rua, $numero, $bairro, $cidade, $estado, $cep);

       
        header("Location: /backend/endereco");
        exit;
    }

   
    public function deletarEndereco($id)
    {
        $this->endereco->deletarEndereco($id);

        header("Location: /backend/endereco");
        exit;
    }

   
    public function reativarEndereco($id)
    {
        $this->endereco->reativarEndereco($id);

        header("Location: /backend/endereco");
        exit;
    }
}
?>
