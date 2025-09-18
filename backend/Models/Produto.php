<?php
class Produto {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    function buscarTodos(){
        $sql = "SELECT * FROM tbl_produtos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPorId($id){
        $sql = "SELECT * FROM tbl_produtos WHERE produto_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function inserir($nome, $descricao, $preco, $estoque, $categoria_id, $imagem = null){
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

    function atualizar($id, $nome, $descricao, $preco, $estoque, $categoria_id, $imagem = null){
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
}
     function deletarProdutos($id){
        $sql = "DELETE FROM tbl_produtos WHERE produto_id = :id AND ecluindo_em is NULL"; 
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
?>
