<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\Endereco;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;

class EnderecoController
{
    private $endereco;
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->endereco = new Endereco($this->db);
    }
    public function Buscarcep ($cep){
        $cep = preg_replace("/[^0-9]/", "", $cep);
        if (strlen($cep) != 8) {
            return null;
        }
        $url = "https://viacep.com.br/ws/{$cep}/json/";
        $response = file_get_contents($url);
        if ($response === FALSE) {
            return null;
        }
        $data = json_decode($response, true);
        if (isset($data['erro'])) {
            return null;
        }
        var_dump($data);
        return [
            'rua' => $data['logradouro'] ?? '',
            'bairro' => $data['bairro'] ?? '',
            'cidade' => $data['localidade'] ?? '',
            'estado' => $data['uf'] ?? ''
        ];
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

    public function viewCriarEndereco()
    {
        $usuario_id = $_POST['usuario_id'] ?? '';
        $rua = $_POST['rua'] ?? '';
        $numero = $_POST['numero'] ?? '';
        $bairro = $_POST['bairro'] ?? '';
        $cidade = $_POST['cidade'] ?? '';
        $estado = $_POST['estado'] ?? '';
        $cep = $_POST['cep'] ?? '';

        View::render("endereco/create", [
            "usuario_id" => htmlspecialchars($usuario_id, ENT_QUOTES, 'UTF-8'),
            "rua" => htmlspecialchars($rua, ENT_QUOTES, 'UTF-8'),
            "numero" => htmlspecialchars($numero, ENT_QUOTES, 'UTF-8'),
            "bairro" => htmlspecialchars($bairro, ENT_QUOTES, 'UTF-8'),
            "cidade" => htmlspecialchars($cidade, ENT_QUOTES, 'UTF-8'),
            "estado" => htmlspecialchars($estado, ENT_QUOTES, 'UTF-8'),
            "cep" => htmlspecialchars($cep, ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function salvarEndereco()
    {
        $usuario_id = intval($_POST['usuario_id'] ?? 0);
        $rua = trim($_POST['rua'] ?? '');
        $numero = trim($_POST['numero'] ?? '');
        $bairro = trim($_POST['bairro'] ?? '');
        $cidade = trim($_POST['cidade'] ?? '');
        $estado = trim($_POST['estado'] ?? '');
        $cep = trim($_POST['cep'] ?? '');

        if ($usuario_id <= 0 || empty($rua) || empty($numero) || empty($bairro) || empty($cidade) || empty($estado) || empty($cep)) {
            Redirect::redirecionarComMensagem("endereco", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        try {
            $resultado = $this->endereco->inserirEndereco($usuario_id, $rua, $numero, $bairro, $cidade, $estado, $cep);
            if ($resultado) {
                Redirect::redirecionarComMensagem("endereco", "success", "Endereço cadastrado com sucesso!");
            } else {
                Redirect::redirecionarComMensagem("endereco", "error", "Erro ao cadastrar endereço!");
            }
        } catch (\Exception $e) {
            Redirect::redirecionarComMensagem("endereco", "error", "Erro: " . $e->getMessage());
        }
    }

    public function viewEditarEndereco($id)
    {
        $id = intval($id);
        $endereco = $this->endereco->buscarPorIdEndereco($id);

        if (!$endereco) {
            Redirect::redirecionarComMensagem("endereco", "error", "Endereço não encontrado!");
            return;
        }

        View::render("endereco/edit", [
            "endereco_id" => $endereco['endereco_id'],
            "usuario_id" => intval($endereco['usuario_id'] ?? 0),
            "rua" => htmlspecialchars($endereco['rua'] ?? '', ENT_QUOTES, 'UTF-8'),
            "numero" => htmlspecialchars($endereco['numero'] ?? '', ENT_QUOTES, 'UTF-8'),
            "bairro" => htmlspecialchars($endereco['bairro'] ?? '', ENT_QUOTES, 'UTF-8'),
            "cidade" => htmlspecialchars($endereco['cidade'] ?? '', ENT_QUOTES, 'UTF-8'),
            "estado" => htmlspecialchars($endereco['estado'] ?? '', ENT_QUOTES, 'UTF-8'),
            "cep" => htmlspecialchars($endereco['cep'] ?? '', ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function atualizarEndereco()
    {
        $id = intval($_POST['id'] ?? 0);
        $rua = trim($_POST['rua'] ?? '');
        $numero = trim($_POST['numero'] ?? '');
        $bairro = trim($_POST['bairro'] ?? '');
        $cidade = trim($_POST['cidade'] ?? '');
        $estado = trim($_POST['estado'] ?? '');
        $cep = trim($_POST['cep'] ?? '');

        if ($id <= 0 || empty($rua) || empty($numero) || empty($bairro) || empty($cidade) || empty($estado) || empty($cep)) {
            Redirect::redirecionarComMensagem("endereco", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        try {
            $resultado = $this->endereco->atualizarEndereco($id, $rua, $numero, $bairro, $cidade, $estado, $cep);
            if ($resultado > 0) {
                Redirect::redirecionarComMensagem("endereco", "success", "Endereço atualizado com sucesso!");
            } else {
                Redirect::redirecionarComMensagem("endereco", "error", "Nenhuma alteração realizada!");
            }
        } catch (\Exception $e) {
            Redirect::redirecionarComMensagem("endereco", "error", "Erro: " . $e->getMessage());
        }
    }

   
    public function deletarEndereco($id)
    {
        $id = intval($id);
        $resultado = $this->endereco->deletarEndereco($id);

        if ($resultado) {
            Redirect::redirecionarComMensagem("endereco", "success", "Endereço excluído com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("endereco", "error", "Erro ao excluir endereço!");
        }
    }

   
    public function reativarEndereco($id)
    {
        $id = intval($id);
        $resultado = $this->endereco->reativarEndereco($id);

        if ($resultado) {
            Redirect::redirecionarComMensagem("endereco", "success", "Endereço reativado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("endereco", "error", "Erro ao reativar endereço!");
        }
    }
}
?>
