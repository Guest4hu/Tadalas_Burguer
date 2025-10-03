<?php
namespace Controllers;
use Models\Produto;

class ProdutoController {
    private $produto;

    public function __construct($db){
        $this->produto = new Produto($db);
    }

    public function listar(){
        echo json_encode($this->produto->buscarTodos());
    }

    public function mostrar($id){
        echo json_encode($this->produto->buscarPorId($id));
    }

    public function criar($nome, $descricao, $preco, $estoque, $categoria_id, $imagem = null){
        $resultado = $this->produto->inserir($nome, $descricao, $preco, $estoque, $categoria_id, $imagem);
        echo json_encode(["success" => $resultado]);
    }

    public function atualizar($id, $nome, $descricao, $preco, $estoque, $categoria_id, $imagem = null){
        $resultado = $this->produto->atualizar($id, $nome, $descricao, $preco, $estoque, $categoria_id, $imagem);
        echo json_encode(["success" => $resultado]);
    }
}
?>
