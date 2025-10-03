<?php

namespace Models;
use Database\Databases;
use PDO;

class Cargo {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    function buscarTodos(){
        $sql = "SELECT * FROM dom_cargo";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPorId($id){
        $sql = "SELECT * FROM dom_cargo WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function inserir($descricao){
        $sql = "INSERT INTO dom_cargo (descricao) VALUES (:descricao)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    function atualizar($id, $descricao){
        $sql = "UPDATE dom_cargo SET descricao = :descricao WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    function deletar($id){
        $sql = "DELETE FROM dom_cargo WHERE id = :id and excluido_em IS NULL"; 
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}
?>
