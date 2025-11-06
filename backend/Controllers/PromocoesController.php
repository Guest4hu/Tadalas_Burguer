<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;
use App\Tadala\Database\Database;
use App\Tadala\Models\Promocoes;

class PromocoesController
{
    public $promocoes;
    public $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->promocoes = new Promocoes($this->db);
    }
    // index
    public function index()
    {
        $resultado = $this->promocoes->buscarPromocoes();
        View::render("promocoes/index", ["promocoes" => $resultado]);
        
    }


    public function viewListarPromocoes()
    {
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->promocoes->paginacaoPromocoes($pagina);
        $total = $this->promocoes->totalPromocoes();
        $total_inativos = $this->promocoes->totalPromocoesInativas();
        $total_ativos = $this->promocoes->totalPromocoesAtivos();
        View::render("promocoes/index", 
        [
        "promocoes"=> $dados['data'],
         "total_"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
    }
    public function viewCriarPromocoes()
    {
        $titulo = $_POST['titulo'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $percentual_desconto = $_POST['percentual_desconto'] ?? '';
        $data_inicio = $_POST['data_inicio'] ?? '';
        $data_fim = $_POST['data_fim'] ?? '';
        $ativo = $_POST['ativo'] ?? 1;

        View::render("promocoes/create", [
            "titulo" => htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8'),
            "descricao" => htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8'),
            "percentual_desconto" => htmlspecialchars($percentual_desconto, ENT_QUOTES, 'UTF-8'),
            "data_inicio" => htmlspecialchars($data_inicio, ENT_QUOTES, 'UTF-8'),
            "data_fim" => htmlspecialchars($data_fim, ENT_QUOTES, 'UTF-8'),
            "ativo" => intval($ativo)
        ]);
    }

    public function salvarPromocoes()
    {
        $titulo = trim($_POST['titulo'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        $percentual_desconto = trim($_POST['percentual_desconto'] ?? '');
        $data_inicio = trim($_POST['data_inicio'] ?? '');
        $data_fim = trim($_POST['data_fim'] ?? '');
        $ativo = intval($_POST['ativo'] ?? 1);

        if (empty($titulo) || empty($descricao) || empty($percentual_desconto) || empty($data_inicio) || empty($data_fim)) {
            Redirect::redirecionarComMensagem("promocoes", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        $resultado = $this->promocoes->inserirPromocao($titulo, $descricao, $percentual_desconto, $data_inicio, $data_fim, $ativo);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("promocoes", "success", "Promoção criada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("promocoes", "error", "Erro ao criar promoção!");
        }
    }

    public function viewEditarPromocoes($id)
    {
        $id = intval($id);
        $promocao = $this->promocoes->buscarPromocaoPorId($id);

        if (!$promocao) {
            Redirect::redirecionarComMensagem("promocoes", "error", "Promoção não encontrada!");
            return;
        }

        View::render("promocoes/edit", [
            "promocao_id" => $promocao['promocao_id'],
            "titulo" => htmlspecialchars($promocao['titulo'] ?? '', ENT_QUOTES, 'UTF-8'),
            "descricao" => htmlspecialchars($promocao['descricao'] ?? '', ENT_QUOTES, 'UTF-8'),
            "percentual_desconto" => htmlspecialchars($promocao['percentual_desconto'] ?? '', ENT_QUOTES, 'UTF-8'),
            "data_inicio" => htmlspecialchars($promocao['data_inicio'] ?? '', ENT_QUOTES, 'UTF-8'),
            "data_fim" => htmlspecialchars($promocao['data_fim'] ?? '', ENT_QUOTES, 'UTF-8'),
            "ativo" => intval($promocao['ativo'] ?? 1)
        ]);
    }

    public function atualizarPromocoes()
    {
        $id = intval($_POST['id'] ?? 0);
        $titulo = trim($_POST['titulo'] ?? '');
        $descricao = trim($_POST['descricao'] ?? '');
        $percentual_desconto = trim($_POST['percentual_desconto'] ?? '');
        $data_inicio = trim($_POST['data_inicio'] ?? '');
        $data_fim = trim($_POST['data_fim'] ?? '');
        $ativo = intval($_POST['ativo'] ?? 1);

        if ($id <= 0 || empty($titulo) || empty($descricao) || empty($percentual_desconto) || empty($data_inicio) || empty($data_fim)) {
            Redirect::redirecionarComMensagem("promocoes", "error", "Todos os campos devem ser preenchidos!");
            return;
        }

        $resultado = $this->promocoes->atualizarPromocao($id, $titulo, $descricao, $percentual_desconto, $data_inicio, $data_fim, $ativo);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("promocoes", "success", "Promoção atualizada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("promocoes", "error", "Erro ao atualizar promoção!");
        }
    }

    public function viewExcluirPromocoes($id)
    {
        $id = intval($id);
        $resultado = $this->promocoes->excluirPromocao($id);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("promocoes", "success", "Promoção excluída com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("promocoes", "error", "Erro ao excluir promoção!");
        }
    }

    public function deletarPromocoes()
    {
        $id = intval($_POST['id'] ?? 0);
        
        if ($id <= 0) {
            Redirect::redirecionarComMensagem("promocoes", "error", "ID inválido!");
            return;
        }

        $resultado = $this->promocoes->excluirPromocao($id);
        
        if ($resultado) {
            Redirect::redirecionarComMensagem("promocoes", "success", "Promoção excluída com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("promocoes", "error", "Erro ao excluir promoção!");
        }
    }
}
