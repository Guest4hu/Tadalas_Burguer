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
        $sql = "SELECT * 
                FROM dom_cargo 
                WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdCargo($id){
        $sql = "SELECT id, cargo_descricao, criado_em, atualizado_em 
                FROM dom_cargo 
                WHERE id = :id AND excluido_em IS NULL 
                LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirCargo($descricao){
        $sql = "INSERT INTO dom_cargo (cargo_descricao, criado_em) 
                VALUES (:descricao, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function atualizarCargo($id, $descricao){
        $sql = "UPDATE dom_cargo 
                SET cargo_descricao = :descricao, atualizado_em = NOW() 
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

    public function totalCargo()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM dom_cargo';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function totalCargoAtivos()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM dom_cargo WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function totalCargoInativos()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM dom_cargo WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function paginacaoCargo(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `dom_cargo`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * FROM `dom_cargo` LIMIT :limit OFFSET :offset";
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
