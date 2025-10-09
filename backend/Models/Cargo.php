<?php

namespace App\Tadala\Models;
use PDO;

class Cargo {
    private $db;
    private $descricao;

    public function __construct($db){
        $this->db = $db;
    }

    public function buscarTodosCargo(){
        $sql = "SELECT id, descricao, criado_em, atualizado_em 
                FROM dom_cargo 
                WHERE excluido_em IS NULL 
                ORDER BY id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdCargo($id){
        $sql = "SELECT id, descricao, criado_em, atualizado_em 
                FROM dom_cargo 
                WHERE id = :id AND excluido_em IS NULL 
                LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirCargo($descricao){
        $sql = "INSERT INTO dom_cargo (descricao, criado_em) 
                VALUES (:descricao, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function atualizarCargo($id, $descricao){
        $sql = "UPDATE dom_cargo 
                SET descricao = :descricao, atualizado_em = NOW() 
                WHERE id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deletarCargo($id){
        $sql = "UPDATE dom_cargo 
                SET excluido_em = NOW() 
                WHERE id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function reativarCargo($id){
        $sql = 'UPDATE dom_cargo SET excluido_em = NULL WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function totalCargo(): int
    {
        $sql = 'SELECT COUNT(id) FROM dom_cargo';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function totalCargoAtivos(): int
    {
        $sql = 'SELECT COUNT(id) FROM dom_cargo WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
    public function totalCargoInativos(): int
    {
        $sql = 'SELECT COUNT(id) FROM dom_cargo WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
}
