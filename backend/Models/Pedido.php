<?php
namespace Models;
use Database\Databases;
use PDO;
class Pedido {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    function buscarTodos(){
        $sql = "SELECT * FROM tbl_pedidos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPorId($id){
        $sql = "SELECT * FROM tbl_pedidos WHERE pedido_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function inserir($usuario_id, $status_pedido_id){
        $sql = "INSERT INTO tbl_pedidos (usuario_id, status_pedido_id, criado_em) 
                VALUES (:usuario, :status, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario', $usuario_id);
        $stmt->bindParam(':status', $status_pedido_id);
        return $stmt->execute();
    }

    function atualizar($id, $status_pedido_id){
        $sql = "UPDATE tbl_pedidos 
                SET status_pedido_id = :status, atualizado_em = NOW()
                WHERE pedido_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status_pedido_id);
        return $stmt->execute();
    }
    function deletarPedido($id){
        $sql = "UPDATE tbl_pedido
        SET excluido_em = :excluido_em NOW()
        WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt -> bindParam(':id', $id);
        return $stmt->execute();

    }
    function reativarPedido($id){
        $sql = 'UPDATE tbl_pedido set excluido_em = NULL WHERE pedido_id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt -> bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
