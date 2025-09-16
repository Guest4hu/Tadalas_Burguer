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
    //inserir novos pedidos
    function inserirPedidos($id_usuario, $descricao, $valor, $status = 'pendente'){
        $sql = "INSERT INTO tbl_pedidos 
                (id_usuario, descricao, valor, status, criado_em) 
                VALUES (:id_usuario, :descricao, :valor, :status, NOW())";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':status', $status);

        if($stmt->execute()){
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    //autualizar pedidos
    

}