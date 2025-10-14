<?php


namespace App\Tadala\Controllers;

use App\Tadala\Models\Produto;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;

class ProdutoController {
    private $produto;

    public function __construct($db){
        $this->produto = new Produto($db);
    }

    public function index(){
       $this->produto->buscarTodosProduto();
       View::render("produto/index");
   }

    public function mostrar($id){
       $this->produto->buscarPorIdProduto($id);
    }

    public function criar($nome, $descricao, $preco, $estoque, $categoria_id, $imagem = null){
        $this->produto->inserirProduto($nome, $descricao, $preco, $estoque, $categoria_id, $imagem);
       
    }

    public function atualizar($id, $nome, $descricao, $preco, $estoque, $categoria_id, $imagem = null){
        $this->produto->atualizarProduto($id, $nome, $descricao, $preco, $estoque, $categoria_id, $imagem);
       
    }
}
?>
