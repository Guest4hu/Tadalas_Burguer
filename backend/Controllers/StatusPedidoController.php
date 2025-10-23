<?php

namespace App\Tadala\Controllers;

use App\Tadala\Models\StatusPedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;

class StatusPedidoController {
    private $statusPedido;

    public $db;

    public function __construct(){
        $this->db = Database::getInstance();
        $this->statusPedido = new StatusPedido($this->db);
    }

    public function viewListarStatusPedido($pagina=1){
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->statusPedido->paginacaoStatusPedido($pagina);
        $total = $this->statusPedido->totalStatusPedido();
        $total_inativos = $this->statusPedido->totalStatusPedidoInativos();
        $total_ativos = $this->statusPedido->totalStatusPedidoAtivos();
        View::configuracaoIndex("statusPedido/index", 
        [
        "status_pedidos"=> $dados['data'],
         "total"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
    }

    public function viewCriarStatusPedido()
    {
        View::configuracaoIndex("statusPedido/create");
    }


    public function viewEditarStatusPedido(int $id){
        $dados = $this->statusPedido->buscarPorIdStatusPedido($id);
        foreach($dados as $statusPedido){
                $dados = $statusPedido;
        }
        View::configuracaoIndex("statusPedido/edit", ["statusPedido"=> $dados ]);
    }
    public function viewExcluirStatusPedido()
    {
        View::configuracaoIndex("statusPedido/delete");
    }

    public function salvarStatusPedido()
    {
        echo "Salvar statusPedido";
    }
    public function atualizarStatusPedido()
    {
        echo "Atualizar statusPedido";
    }
    public function deletarStatusPedido($id)
    {
        $this->statusPedido->excluirStatusPedido($id);

    }
}
?>
