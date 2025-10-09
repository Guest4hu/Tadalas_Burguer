<?php

namespace App\Tadala\Models;
use PDO;

class Endereco {
    private $db;
    private $endereco_id;
    private $cidade;
    private $estado;
    private $cep;
    private $numero;
    private $bairro;
    private $usuario_id;
    private $rua;

    public function __construct($db){
        if (!($db instanceof PDO)) {
            throw new \InvalidArgumentException("Instância de PDO inválida");
        }
        $this->db = $db;
    }

    public function buscarTodosEndereco(){
        $sql = "SELECT endereco_id, usuario_id, rua, numero, bairro, cidade, estado, cep, criado_em, atualizado_em 
                FROM tbl_endereco 
                WHERE excluido_em IS NULL 
                ORDER BY endereco_id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdEndereco($id){
        $sql = "SELECT endereco_id, usuario_id, rua, numero, bairro, cidade, estado, cep, criado_em, atualizado_em 
                FROM tbl_endereco 
                WHERE endereco_id = :id AND excluido_em IS NULL 
                LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirEndereco($usuario_id, $rua, $numero, $bairro, $cidade, $estado, $cep){
        $sql = "INSERT INTO tbl_endereco (usuario_id, rua, numero, bairro, cidade, estado, cep, criado_em)
                VALUES (:usuario, :rua, :numero, :bairro, :cidade, :estado, :cep, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario', $usuario_id);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':cep', $cep);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function atualizarEndereco($id, $rua, $numero, $bairro, $cidade, $estado, $cep){
        $sql = "UPDATE tbl_endereco 
                SET rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep, atualizado_em = NOW()
                WHERE endereco_id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':cep', $cep);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deletarEndereco($id){
        $sql = "UPDATE tbl_endereco SET excluido_em = NOW() WHERE endereco_id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function reativarEndereco($id){
        $sql = 'UPDATE tbl_endereco SET excluido_em = NULL WHERE endereco_id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function totalEndereco(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_endereco';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function totalEnderecoAtivos(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_endereco WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
    public function totalEnderecoInativos(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_endereco WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
}
