<?php
namespace App\Tadala\Controllers;
use App\Tadala\Models\ItensPedido;
use App\Tadala\Core\View;
use App\Tadala\Database\Database;
class ItensPedidosController{
    private $ItensPedidos;

    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->ItensPedidos = new ItensPedido($this->db);
    }
    // index 
    public function index()
    {
        $livros = [
            'titulo' => 'x','preco' => '123', 'autor' => 'y',
        ];

        $resultado = $this->ItensPedidos->buscarTodosItemPedido();
        View::render("itensPedidos/index", ["itensPedidos" => $resultado,
    'detalhe' => $livros]);

    }


public function viewListarItensPedido($pagina=1){
        $pagina = isset($pagina) ? $pagina : 1;
        $dados = $this->ItensPedidos->paginacaoItensPedido($pagina);
        $total = $this->ItensPedidos->totalItensPedidos();
        $total_inativos = $this->ItensPedidos->totalItensPedidosInativos();
        $total_ativos = $this->ItensPedidos->totalItensPedidosAtivos();
        $livros = [
            'titulo' => 'x','preco' => '123', 'autor' => 'y',
        ];
        View::render("itensPedidos/index", 
        [
        "itensPedidos"=> $dados['data'],
         "total"=> $total['total'],
         "total_inativos" => $total_inativos['total'],
         "total_ativos" => $total_ativos['total'],
         'paginacao' => $dados,
         'detalhe' => $livros,
        ] 
        );
    }
    public function viewCriarItensPedido()
    {
        View::render("itensPedidos/create");
    }


    public function viewEditarItensPedido(int $id){
        $dados = $this->ItensPedidos->buscarPorIdItemPedido($id);
        foreach($dados as $iTensPedidos){
                $dados = $iTensPedidos;
        }
        View::render("itensPedidos/edit", ["itensPedidos"=> $dados ]);
    }
    public function viewExcluirItensPedido()
    {
        View::render("itensPedidos/delete");
    }

    public function salvarItensPedido()
    {
        echo "Salvar Itens Pedidos";
    }
    public function atualizarItensPedido()
    {
        echo "Atualizar Itens Pedidos";
    }
    public function deletarItensPedido($id)
    {
        $this->ItensPedidos->excluirItemPedido($id);
    }
}

