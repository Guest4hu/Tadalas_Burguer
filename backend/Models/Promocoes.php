<?php

namespace App\Tadala\Models;
use PDO;

/**
 * Classe Model responsável por manipular a tabela de promoções.
 * Tabela: tbl_promocoes
 * Campos esperados:
 *   - promocao_id (PK)
 *   - titulo
 *   - descricao
 *   - percentual_desconto
 *   - data_inicio
 *   - data_fim
 *   - ativo (TINYINT 0/1)
 *   - criado_em
 *   - atualizado_em
 *   - excluido_em
 */
class Promocoes {
    private $db;

    // Atributos da tabela
    private $promocao_id;
    private $titulo;
    private $descricao;
    private $percentual_desconto;
    private $data_inicio;
    private $data_fim;
    private $ativo;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;

    /**
     * Construtor - recebe a conexão PDO
     */
    public function __construct($db) {
        $this->db = $db;
    }

    // ===========================================================
    // MÉTODOS CRUD (Create, Read, Update, Delete lógico)
    // ===========================================================

    /**
     * Buscar todas as promoções ativas (não excluídas)
     */
    public function buscarTodasPromocoes() {
        $sql = "SELECT * FROM tbl_promocoes WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Buscar uma promoção específica pelo ID
     */
    public function buscarPromocaoPorId($id) {
        $sql = "SELECT * FROM tbl_promocoes WHERE promocao_id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Inserir uma nova promoção
     */
    public function inserirPromocao($titulo, $descricao, $percentual_desconto, $data_inicio, $data_fim, $ativo) {
        $sql = "INSERT INTO tbl_promocoes (titulo, descricao, percentual_desconto, data_inicio, data_fim, ativo)
                VALUES (:titulo, :descricao, :percentual_desconto, :data_inicio, :data_fim, :ativo)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':percentual_desconto', $percentual_desconto);
        $stmt->bindParam(':data_inicio', $data_inicio);
        $stmt->bindParam(':data_fim', $data_fim);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_BOOL);
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    /**
     * Atualizar uma promoção existente
     */
    public function atualizarPromocao($id, $titulo, $descricao, $percentual_desconto, $data_inicio, $data_fim, $ativo) {
        $sql = "UPDATE tbl_promocoes 
                SET titulo = :titulo,
                    descricao = :descricao,
                    percentual_desconto = :percentual_desconto,
                    data_inicio = :data_inicio,
                    data_fim = :data_fim,
                    ativo = :ativo,
                    atualizado_em = NOW()
                WHERE promocao_id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':percentual_desconto', $percentual_desconto);
        $stmt->bindParam(':data_inicio', $data_inicio);
        $stmt->bindParam(':data_fim', $data_fim);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_BOOL);
        return $stmt->execute();
    }

    /**
     * Excluir (lógico) uma promoção
     */
    public function excluirPromocao($id) {
        $sql = "UPDATE tbl_promocoes SET excluido_em = NOW() WHERE promocao_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * Reativar uma promoção anteriormente excluída
     */
    public function ativarPromocao($id) {
        $sql = "UPDATE tbl_promocoes SET excluido_em = NULL WHERE promocao_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * Buscar promoções ativas dentro do período válido (atuais)
     */
    public function buscarPromocoesAtivas() {
        $sql = "SELECT * FROM tbl_promocoes 
                WHERE ativo = 1 
                AND excluido_em IS NULL 
                AND CURDATE() BETWEEN data_inicio AND data_fim";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Buscar promoções expiradas
     */
    public function buscarPromocoesExpiradas() {
        $sql = "SELECT * FROM tbl_promocoes 
                WHERE data_fim < CURDATE() AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function totalPromocoes(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_promocoes';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function totalPromocoesAtivos(): int
    {   
        $sql = 'SELECT COUNT(*) FROM tbl_promocoes WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
    public function totalPromocoesInativas(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_promocoes WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
}
?>
