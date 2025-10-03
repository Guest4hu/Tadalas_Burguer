<?php

namespace App\Tadala\Models;
use PDO;
class Funcionario {
    private $db;
    private $funcionario_id;
    private $usuario_id;
    private $cargo_id;
    private $status_funcionario_id;
    private $salario;

    public function __construct($db){
        $this->db = $db;
    }

    function buscarTodos(){
        $sql = "SELECT * FROM tbl_funcionarios WHERE excluindo_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPorId($id){
        $sql = "SELECT * FROM tbl_funcionarios WHERE funcionario_id = :id and excluindo_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function inserir($usuario_id, $cargo_id, $status_funcionario_id, $salario){
        $sql = "INSERT INTO tbl_funcionarios (usuario_id, cargo_id, status_funcionario_id, salario) 
                VALUES (:usuario, :cargo, :status, :salario)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario', $usuario_id);
        $stmt->bindParam(':cargo', $cargo_id);
        $stmt->bindParam(':status', $status_funcionario_id);
        $stmt->bindParam(':salario', $salario);
        return $stmt->execute();
    }

    function atualizar($id, $cargo_id, $status_funcionario_id, $salario){
        $sql = "UPDATE tbl_funcionarios 
                SET cargo_id = :cargo, status_funcionario_id = :status, salario = :salario
                WHERE funcionario_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':cargo', $cargo_id);
        $stmt->bindParam(':status', $status_funcionario_id);
        $stmt->bindParam(':salario', $salario);
        return $stmt->execute();
    }
}
?>
