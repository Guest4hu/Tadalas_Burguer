<?php

namespace App\Tadala\Models;
use PDO;

class Produto {
    private $db;
    private $produto_id;
    private $nome;
    private $descricao;
    private $preco;
    private $estoque;
    private $categoria_id;

    public function __construct($db){
        $this->db = $db;
    }

    public function buscarTodosProdutos(){
        $sql = "SELECT * FROM tbl_produtos WHERE excluindo_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdProduto($id){
        $sql = "SELECT * FROM tbl_produtos WHERE produto_id = :id AND excluindo_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirProduto($nome, $descricao, $preco, $estoque, $categoria_id, $imagem = null){
        $sql = "INSERT INTO tbl_produtos (nome, descricao, preco, estoque, categoria_id, imagem_produto) 
                VALUES (:nome, :descricao, :preco, :estoque, :categoria, :imagem)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':estoque', $estoque);
        $stmt->bindParam(':categoria', $categoria_id);
        $stmt->bindParam(':imagem', $imagem);
        return $stmt->execute();
    }

    public function atualizarProduto($id, $nome, $descricao, $preco, $estoque, $categoria_id, $imagem = null){
        $sql = "UPDATE tbl_produtos SET nome = :nome, descricao = :descricao, preco = :preco, 
                estoque = :estoque, categoria_id = :categoria, imagem_produto = :imagem 
                WHERE produto_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':estoque', $estoque);
        $stmt->bindParam(':categoria', $categoria_id);
        $stmt->bindParam(':imagem', $imagem);
        return $stmt->execute();
    }

    public function deletarProdutos($id){
        $sql = "UPDATE tbl_produtos SET excluindo_em = NOW() WHERE produto_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function reativarProduto($id){
        $sql = "UPDATE tbl_produtos SET excluido_em = NULL WHERE produto_id = :id AND excluido_em IS NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function totalProduto(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_produto';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function totalProdutosAtivos(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_produtos WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
    public function totalProdutosInativos(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_produtos WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
}

?>
