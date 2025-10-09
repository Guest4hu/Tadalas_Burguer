<?php

namespace App\Tadala\Models;

use PDO;

class StatusPagamento
{
    private $db;
    private $id;
    private $descricao;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function buscarTodosStatusPagamento()
    {
        $sql = "SELECT * FROM dom_status_pagamento where excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdStatusPagamento($id)
    {
        $sql = "SELECT * FROM dom_status_pagamento WHERE id = :id and excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirStatusPagamento($descricao)
    {
        $sql = "INSERT INTO dom_status_pagamento (descricao) VALUES (:descricao)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    public function atualizarStatusPagamento($id, $descricao)
    {
        $sql = "UPDATE dom_status_pagamento SET descricao = :descricao WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function excluirStatusPagamentoStatusPagamento($id)
    {
        $sql = "UPDATE dom_status_pagamento SET excluido_em = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function reativarStatusPagamento($id)
    {
        $sql = 'UPDATE dom_status_pagamento SET excluido_em = NULL WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
