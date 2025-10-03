<?php
namespace Models;
use PDO;
class ItemPedido {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    function buscarTodos(){
        $sql = "SELECT * FROM tbl_itens_pedidos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPorId($id){
        $sql = "SELECT * FROM tbl_itens_pedidos WHERE item_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function inserir($pedido_id, $produto_id, $quantidade, $valor_unitario){
        $sql = "INSERT INTO tbl_itens_pedidos (pedido_id, produto_id, quantidade, valor_unitario) 
                VALUES (:pedido, :produto, :quantidade, :valor)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':pedido', $pedido_id);
        $stmt->bindParam(':produto', $produto_id);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':valor', $valor_unitario);
        return $stmt->execute();
    }

    function atualizar($id, $quantidade, $valor_unitario){
        $sql = "UPDATE tbl_itens_pedidos 
                SET quantidade = :quantidade, valor_unitario = :valor
                WHERE item_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':valor', $valor_unitario);
        return $stmt->execute();
    }
}
?>
