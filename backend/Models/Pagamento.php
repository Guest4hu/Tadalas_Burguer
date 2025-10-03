<?php
namespace App\Tadala\Models;
use PDO;
class Pagamento {
    private $db;
    private $pagamento_id;
    private $pedido_id;
    private $metodo;
    private $status_pagamento;
    private $valor_total;

    public function __construct($db){
        $this->db = $db;
    }

    function buscarTodos(){
        $sql = "SELECT * FROM tbl_pagamento where excluindo_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPorId($id){
        $sql = "SELECT * FROM tbl_pagamento WHERE pagamento_id = :id and excluindo_em IS NULL";
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
