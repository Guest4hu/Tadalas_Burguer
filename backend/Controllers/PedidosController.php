<?php


namespace App\Tadala\Controllers;
use App\Tadala\Models\ItensPedido;
use App\Tadala\Models\Pedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;
use App\Tadala\Core\Redirect;
use App\Tadala\Models\StatusPedido;


class PedidosController{
    public $pedidos;
    public $db;
    public $ItensPedidos;
    public $statusPedido;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->pedidos = new Pedido($this->db);
        $this->ItensPedidos = New ItensPedido($this->db);
        $this->statusPedido = new StatusPedido($this->db);
    }
    // index
    public function index()
    {
        $resultado = $this->pedidos->buscarTodosPedido();
        View::render("pedidos/index", ["pedidos" => $resultado]);
        
    }


public function viewListarPedidos($pagina=1,$por_pagina=5){
        $statusPed = $this->statusPedido->buscarTodosStatusPedido();
        $por_pagina = isset($por_pagina) ? $por_pagina : 5;
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->pedidos->paginacaoPedidoNovo($pagina,$por_pagina);
        $dados2 = $this->pedidos->paginacaoPedidoEmPreparo($pagina,$por_pagina);
        $dados3 = $this->pedidos->paginacaoPedidoEmEntrega($pagina,$por_pagina);
        $dados4 = $this->pedidos->paginacaoPedidoComcluido($pagina,$por_pagina);
        $dados5 = $this->pedidos->paginacaoPedidoCancelados($pagina,$por_pagina);
        View::render("pedidos/index", 
        [
            'statusPedido' => $statusPed,
            "pedidos5" => $dados5['data'],
            "pedidos4" => $dados4['data'],
            "pedidos3" => $dados3['data'],
        "pedidos2" => $dados2['data'],
        "pedidos"=> $dados['data'],
         'paginacao' => $dados
        ] 
        );
    }



     public function viewNovo($pagina=1,$por_pagina = 20){
        $statusPed = $this->statusPedido->buscarTodosStatusPedido();
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->pedidos->paginacaoPedidoNovo($pagina,$por_pagina);
        View::render("pedidos/tipopedidos/novo", 
        [
             'statusPedido' => $statusPed,
        "pedidos" => $dados['data'],
        ] 
        );
    }
      public function viewPreparo($pagina=1,$por_pagina = 20){
        $statusPed = $this->statusPedido->buscarTodosStatusPedido();
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $dados = $this->pedidos->paginacaoPedidoEmPreparo($pagina, $por_pagina);
        View::render("pedidos/tipopedidos/preparo", 
        [
             'statusPedido' => $statusPed,
        "pedidos2" => $dados['data'],
        ] 
        );
    }
      public function viewEmEntrega($pagina=1,$por_pagina = 20){
        $statusPed = $this->statusPedido->buscarTodosStatusPedido();
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $dados = $this->pedidos->paginacaoPedidoEmEntrega($pagina, $por_pagina);
        View::render("pedidos/tipopedidos/entrega", 
        [
             'statusPedido' => $statusPed,
        "pedidos3" => $dados['data'],
        ] 
        );
    }
      public function viewConcluidos($pagina=1,$por_pagina = 20){
        $statusPed = $this->statusPedido->buscarTodosStatusPedido();
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $dados = $this->pedidos->paginacaoPedidoComcluido($pagina, $por_pagina);
        View::render("pedidos/tipopedidos/concluidos", 
        [
             'statusPedido' => $statusPed,
        "pedidos4" => $dados['data'],
        ] 
        );
    }
      public function viewCancelados($pagina=1,$por_pagina = 20){
        $statusPed = $this->statusPedido->buscarTodosStatusPedido();
        $por_pagina = isset($por_pagina) ? $por_pagina : 20;
        $dados = $this->pedidos->paginacaoPedidoCancelados($pagina, $por_pagina);
        View::render("pedidos/tipopedidos/cancelados", 
        [
             'statusPedido' => $statusPed,
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


    public function viewAtualizarPedidos(int $id, int $status)
    {
        $status = $status ?? 5;
        $dados = $this->pedidos->buscarPorIdPedido($id);
        echo "Atualizar pedidos";
        View::render("pedidos/atualizar", ["pedidos"=> $dados, 'stat' => $status]);
    }


    public function AtualizarPedido(){
        $dados = json_decode(file_get_contents("php://input"),true);
        $status = $dados['status'] ;
        $idPedido = $dados['idPedido'];
        if ($this->pedidos->atualizarPedido($idPedido, $status)) {
            Redirect::redirecionarComMensagem("pedidos", "success", "Pedido atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("pedidos", "error", "Erro ao atualizar pedido.");
        }
    }


    public function deletarPedidos()
    {
         $dados = json_decode(file_get_contents("php://input"),true);
          $idPedido = $dados['idPedido'];
          if ($this->pedidos->deletarPedido($idPedido)) {
            Redirect::redirecionarComMensagem("pedidos", "success", "Pedido deletado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("pedidos", "error", "Erro ao deletar pedido.");
        }        
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
