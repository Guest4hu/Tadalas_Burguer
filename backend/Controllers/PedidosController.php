<?php


namespace App\Tadala\Controllers;
use App\Tadala\Models\ItensPedido;
use App\Tadala\Models\Pedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;


class PedidosController{
    public $pedidos;
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


public function viewListarPedidos($pagina=1){
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->pedidos->paginacaoPedido($pagina);
        $total = $this->pedidos->totalPedido();
        $total_inativos = $this->pedidos->totalPedidoInativos();
        $total_ativos = $this->pedidos->totalPedidoAtivos();
        View::render("pedidos/index", 
        [
        "pedidos"=> $dados['data'],
         "total"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados
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
    public function atualizarPedidos()
    {
        echo "Atualizar pedidos";
    }
    public function deletarPedidos($id)
    {
        $this->pedidos->deletarPedido($id);
        
    }
    public function Items($id){
        header("Application/json");
        $dados = $this->ItensPedidos->buscarPorIdItemPedido($id);
        echo json_encode([
            "sucesso" => true,
            "dados" =>  $dados,

        ],JSON_PRETTY_PRINT
    );
    }
}
