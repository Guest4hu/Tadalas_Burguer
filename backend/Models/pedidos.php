<?php
class pedidos {
    private $db;
    public function __construct($db){
        $this->db = $db;
    }

    //essa funçao vai fazer a busca de todos os pedidos
    function buscarPedidos(){
        $sql = "SELECT * FROM tbl_pedidos WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    function inserirPedidos($usuario_id, $status_pedido_id = 'pendente'){
        
        $sql = "INSERT INTO tbl_pedidos 
                (usuario_id,, status_pedido_id $status_pedido_id, criado_em) 
                VALUES (:usuario_id, :, :status_pedido_id $status_pedido_id, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':status_pedido_id$status_pedido_id', $status_pedido_id);

        if($stmt->execute()){
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    //autualizar pedidos
    

}