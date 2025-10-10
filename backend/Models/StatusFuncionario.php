<?php

namespace App\Tadala\Models;
use PDO;

class StatusFuncionario {
    private $db;

    private $id;
    private $descricao;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;

    public function __construct($db) {
        $this->db = $db;
    }

    public function buscarTodosStatus() {
        $sql = "SELECT * FROM dom_status_funcionario WHERE excluido_em IS NULL ORDER BY descricao ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarStatusPorId($id) {
        $sql = "SELECT * FROM dom_status_funcionario WHERE id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirStatus($descricao) {
        $sql = "INSERT INTO dom_status_funcionario (descricao) VALUES (:descricao)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function atualizarStatus($id, $descricao) {
        $sql = "UPDATE dom_status_funcionario 
                SET descricao = :descricao,
                    atualizado_em = NOW()
                WHERE id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    public function excluirStatus($id) {
        $sql = "UPDATE dom_status_funcionario SET excluido_em = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function ativarStatusFuncionario($id) {
        $sql = "UPDATE dom_status_funcionario SET excluido_em = NULL WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function buscarStatusFuncionarioExcluidos() {
        $sql = "SELECT * FROM dom_status_funcionario WHERE excluido_em IS NOT NULL ORDER BY atualizado_em DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function totalStatusFuncionario(): int
    {   
        $sql = 'SELECT COUNT(*) FROM dom_funcionario';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function totalStatusFuncionarioAtivos(): int
    {   
        $sql = 'SELECT COUNT(*) FROM dom_funcionario WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
    public function totalStatusFuncionarioInativos(): int
    {
        $sql = 'SELECT COUNT(*) FROM dom_funcionario WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
}
?>
