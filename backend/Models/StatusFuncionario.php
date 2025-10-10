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

    public function buscarStatusFuncionarios() {
        $sql = "SELECT * FROM dom_status_funcionario WHERE excluido_em IS NULL ORDER BY descricao ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarStatusFuncionariosPorId($id) {
        $sql = "SELECT * FROM dom_status_funcionario WHERE id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirStatusFuncionarios($descricao) {
        $sql = "INSERT INTO dom_status_funcionario (descricao) VALUES (:descricao)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function atualizarStatusFuncionarios($id, $descricao) {
        $sql = "UPDATE dom_status_funcionario 
                SET descricao = :descricao,
                    atualizado_em = NOW()
                WHERE id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    public function excluirStatusFuncionarios($id) {
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
    public function paginacaoStatusFuncionario(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `dom_status_funcionario`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * FROM `dom_status_funcionario` LIMIT :limit OFFSET :offset";
        $dataStmt = $this->db->prepare($dataQuery);
        $dataStmt->bindValue(':limit', $por_pagina, PDO::PARAM_INT);
        $dataStmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $dataStmt->execute();
        $dados = $dataStmt->fetchAll(PDO::FETCH_ASSOC);
        $lastPage = ceil($total_de_registros / $por_pagina);
 
        return [
            'data' => $dados,
            'total' => (int) $total_de_registros,
            'por_pagina' => (int) $por_pagina,
            'pagina_atual' => (int) $pagina,
            'ultima_pagina' => (int) $lastPage,
            'de' => $offset + 1,
            'para' => $offset + count($dados)
        ];
    }
}
?>
