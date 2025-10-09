<?php
namespace App\Tadala\Models;
use PDO;
class Pedido 
{
    private $db;
    private $pedido_id;
    private $usuario_id;
    private $status_pedido_id;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;
    public function __construct($db){
        $this->db = $db;
    }

    public function buscarTodosPedido(){
        $sql = "SELECT * FROM tbl_pedidos where excluindo_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdPedido($id){
        $sql = "SELECT * FROM tbl_pedidos WHERE pedido_id = :id and excluindo_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirPedido($usuario_id, $status_pedido_id){
        $sql = "INSERT INTO tbl_pedidos (usuario_id, status_pedido_id, criado_em) 
                VALUES (:usuario, :status, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario', $usuario_id);
        $stmt->bindParam(':status', $status_pedido_id);
        return $stmt->execute();
    }

    public function atualizarPedido($id, $status_pedido_id){
        $sql = "UPDATE tbl_pedidos 
                SET status_pedido_id = :status, atualizado_em = NOW()
                WHERE pedido_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status_pedido_id);
        return $stmt->execute();
    }
    public function deletarPedido($id){
        $sql = "UPDATE tbl_pedido
        SET excluido_em = :excluido_em NOW()
        WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt -> bindParam(':id', $id);
        return $stmt->execute();

    }
    public function reativarPedido($id){
        $sql = 'UPDATE tbl_pedido set excluido_em = NULL WHERE pedido_id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt -> bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function totalPedido(): int
    {   
        $sql = 'SELECT COUNT(*) FROM tbl_pedido';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function totalPedidoAtivos(): int
    {   
        $sql = 'SELECT COUNT(*) FROM tbl_pedido WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
    public function totalPedidoInativos(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_pedido WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
}
?>
