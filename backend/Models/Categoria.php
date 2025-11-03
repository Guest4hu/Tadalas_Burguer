<?php

namespace App\Tadala\Models;

use PDO;
use PDOException;
use InvalidArgumentException;
use Exception;

/**
 * Model: Categoria (tbl_categoria)
 * Colunas esperadas: id_categoria, nome, descricao, criado_em, atualizado_em, excluido_em
 */
class Categoria
{
    /**
     * @var PDO
     */
    private $db;

    /**
     * Categoria constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
        // Garante que exceções PDO sejam lançadas para facilitar debug
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Retorna todas categorias ativas (não excluídas).
     * @return array
     * @throws PDOException
     */
    public function buscarCategoria()
    {
        $sql = "SELECT * FROM tbl_categoria
                WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca categoria por id (only active).
     * @param int $id
     * @return array|null
     * @throws PDOException
     */
    public function buscarPorIdCategoria($id)
    {
        $sql = "SELECT id_categoria, nome, descricao, criado_em, atualizado_em
                FROM tbl_categoria
                WHERE id_categoria = :id AND excluido_em IS NULL
                LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? null : $row;
    }

    /**
     * Verifica se já existe uma categoria com mesmo nome (não excluída).
     * @param string $nome
     * @param int|null $excludeId (opcional, para updates)
     * @return bool
     * @throws PDOException
     */
    public function existeNomeCategoria($nome, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) FROM tbl_categoria WHERE nome = :nome AND excluido_em IS NULL";
        if ($excludeId !== null) {
            $sql .= " AND id_categoria != :excludeId";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', trim($nome), PDO::PARAM_STR);
        if ($excludeId !== null) {
            $stmt->bindValue(':excludeId', (int)$excludeId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return (bool)$stmt->fetchColumn();
    }

    /**
     * Insere nova categoria. Retorna id inserido ou false.
     * @param string $nome
     * @param string|null $descricao
     * @return int|false
     * @throws Exception|InvalidArgumentException|PDOException
     */
    public function inserirCategoria($nome, $descricao = null)
    {
        $nome = trim((string)$nome);
        if ($nome === '') {
            throw new InvalidArgumentException('Nome da categoria não pode ser vazio.');
        }

        if ($this->existeNomeCategoria($nome)) {
            throw new Exception('Já existe uma categoria com esse nome.');
        }

        $sql = "INSERT INTO tbl_categoria (nome, descricao, criado_em)
                VALUES (:nome, :descricao, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return (int)$this->db->lastInsertId();
        }

        return false;
    }

    /**
     * Atualiza categoria. Retorna true/false.
     * @param int $id
     * @param string $nome
     * @param string|null $descricao
     * @return bool
     * @throws Exception|InvalidArgumentException|PDOException
     */
    public function atualizarCategoria($id, $nome, $descricao = null)
    {
        $nome = trim((string)$nome);
        if ($nome === '') {
            throw new InvalidArgumentException('Nome da categoria não pode ser vazio.');
        }

        if ($this->existeNomeCategoria($nome, (int)$id)) {
            throw new Exception('Outra categoria já utiliza esse nome.');
        }

        $sql = "UPDATE tbl_categoria
                SET nome = :nome,
                    descricao = :descricao,
                    atualizado_em = NOW()
                WHERE id_categoria = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Soft-delete: marca excluido_em. Retorna true/false.
     * @param int $id
     * @return bool
     * @throws PDOException
     */
    public function excluirCategoria($id){
        $hoje = date("Y-m-d h:m:s");
        $sql = "UPDATE tbl_categoria SET excluido_em = :excluido_em 
        WHERE id_categoria = :id";
        $stmt = $this->db->prepare($sql);
        $stmt -> bindParam(':id', $id);
        $stmt -> bindParam(':excluido_em', $hoje);
        return $stmt->execute();
    }

    /**
     * Restaurar categoria (remover excluido_em). Retorna true/false.
     * @param int $id
     * @return bool
     * @throws PDOException
     */
    public function reativarCategoria($id)
    {
        $sql = "UPDATE tbl_categoria SET excluido_em = NULL, atualizado_em = NOW() WHERE id_categoria = :id AND excluido_em IS NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    
    }

     public function totalCategoria()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_categoria';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function totalCategoriaAtivos()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_categoria WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function totalCategoriaInativos()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_categoria WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetch();
    }
    public function paginacaoCategoria(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_categoria` WHERE excluido_em IS NULL";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * FROM `tbl_categoria` WHERE excluido_em IS NULL LIMIT :limit OFFSET :offset";
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
