<?php


namespace App\Tadala\Controllers;
use App\Tadala\Models\ItensPedido;
use App\Tadala\Models\Pedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;


class PedidosController{
    public  $pedidos;
    public $db;
    public $ItensPedidos;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->pedidos = new Pedido($this->db);
        $this->ItensPedidos = New ItensPedido($this->db);
    }
    // index
    public function index()
    {
        $resultado = $this->pedidos->buscarTodosPedido();
        View::render("pedidos/index", ["pedidos" => $resultado]);
        
    }


public function viewListarPedidos($pagina=1,$por_pagina=5){
        $por_pagina = isset($por_pagina) ? $por_pagina : 5;
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->pedidos->paginacaoPedidoNovo($pagina,$por_pagina);
        $dados2 = $this->pedidos->paginacaoPedidoEmPreparo($pagina,$por_pagina);
        $dados3 = $this->pedidos->paginacaoPedidoEmEntrega($pagina,$por_pagina);
        $dados4 = $this->pedidos->paginacaoPedidoComcluido($pagina,$por_pagina);
        $dados5 = $this->pedidos->paginacaoPedidoCancelados($pagina,$por_pagina);
        $total = $this->pedidos->totalPedido();
        $total_inativos = $this->pedidos->totalPedidoInativos();
        $total_ativos = $this->pedidos->totalPedidoAtivos();
        View::render("pedidos/index", 
        [
            "pedidos5" => $dados5['data'],
            "pedidos4" => $dados4['data'],
            "pedidos3" => $dados3['data'],
        "pedidos2" => $dados2['data'],
        "pedidos"=> $dados['data'],
         "total"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
        ] 
        );
    }



     public function viewNovo($pagina=1,$por_pagina = 20){
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->pedidos->paginacaoPedidoNovo($pagina,$por_pagina);
        View::render("pedidos/tipopedidos/novo", 
        [
        "pedidos" => $dados['data'],
        ] 
        );
    }
      public function viewPreparo($pagina=1,$por_pagina = 20){
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $dados = $this->pedidos->paginacaoPedidoEmPreparo($pagina, $por_pagina);
        View::render("pedidos/tipopedidos/preparo", 
        [
        "pedidos2" => $dados['data'],
        ] 
        );
    }
      public function viewEmEntrega($pagina=1,$por_pagina = 20){
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $dados = $this->pedidos->paginacaoPedidoEmEntrega($pagina, $por_pagina);
        View::render("pedidos/tipopedidos/entrega", 
        [
        "pedidos3" => $dados['data'],
        ] 
        );
    }
      public function viewConcluidos($pagina=1,$por_pagina = 20){
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $dados = $this->pedidos->paginacaoPedidoComcluido($pagina, $por_pagina);
        View::render("pedidos/tipopedidos/concluidos", 
        [
        "pedidos4" => $dados['data'],
        ] 
        );
    }
      public function viewCancelados($pagina=1,$por_pagina = 20){
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $dados = $this->pedidos->paginacaoPedidoCancelados($pagina, $por_pagina);
        View::render("pedidos/tipopedidos/cancelados", 
        [
        "pedidos5" => $dados['data'],
        ] 
        );
    }


    public function viewCriarPedidos()
    {
        View::render("pedidos/create");
    }


    public function viewEditarPedidos(int $id){
        $dados = $this->pedidos->buscarPorIdPedido($id);
        foreach($dados as $pedidos){
                $dados = $pedidos;
        }
        View::render("pedidos/edit", ["pedidos"=> $dados ]);
    }
    public function viewExcluirPedidos()
    {
        View::render("pedidos/delete");
    }

    public function salvarPedidos()
    {
        echo "Salvar pedidos";
    }


    public function viewAtualizarPedidos(int $id)
    {
        $dados = $this->pedidos->buscarPorIdPedido($id);
        echo "Atualizar pedidos";
        View::render("pedidos/atualizar", ["pedidos"=> $dados]);
    }


    public function AtualizarPedido(){
        $id = (int)$_POST['id_pedido'];
        $status = (int)$_POST['status_pedido'];
        if ($this->pedidos->atualizarPedido($id, $status)) {
            Redirect::redirecionarComMensagem("pedidos/listar/1", "success", "Pedido atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("pedidos/listar/1", "error", "Erro ao atualizar pedido.");
        }
    }


    public function deletarPedidos($id)
    {
        $this->pedidos->deletarPedido($id);
        
    }
    public function Items($id){
        header("Application/json");
        $dados = $this->ItensPedidos->buscarPorIdItemPedido($id);
        $dadosItems = $this->pedidos->buscarTodosPedido();
        echo json_encode([
            "sucesso" => true,
            "dados2" =>  $dados,
            "dadosItems" => $dadosItems
        ],JSON_PRETTY_PRINT);
    }
}
