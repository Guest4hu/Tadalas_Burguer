<?php
namespace Models;
use PDO;
class Pagamento {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    function buscarTodos(){
        $sql = "SELECT * FROM tbl_pagamento";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPorId($id){
        $sql = "SELECT * FROM tbl_pagamento WHERE pagamento_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function inserir($pedido_id, $metodo, $status_pagamento_id, $valor_total){
        $sql = "INSERT INTO tbl_pagamento (pedido_id, metodo, status_pagamento_id, valor_total) 
                VALUES (:pedido, :metodo, :status, :valor)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':pedido', $pedido_id);
        $stmt->bindParam(':metodo', $metodo);
        $stmt->bindParam(':status', $status_pagamento_id);
        $stmt->bindParam(':valor', $valor_total);
        return $stmt->execute();
    }

    function atualizar($id, $metodo, $status_pagamento_id, $valor_total){
        $sql = "UPDATE tbl_pagamento 
                SET metodo = :metodo, status_pagamento_id = :status, valor_total = :valor
                WHERE pagamento_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':metodo', $metodo);
        $stmt->bindParam(':status', $status_pagamento_id);
        $stmt->bindParam(':valor', $valor_total);
        return $stmt->execute();
    }
}
?>
