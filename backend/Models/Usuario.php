<?php

namespace App\Tadala\Models;

use PDO;

class Usuario
{
    private $db;

    // Construtor inicializa a classe e/ou atributos
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Método de buscar todos usuários
    public function buscarUsuarios()
    {
        $sql = "SELECT * FROM tbl_usuario WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar usuário por email
    public function buscarUsuarioPorEmail($email)
    {
        $sql = "SELECT * FROM tbl_usuario WHERE email_usuario = :email AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirUsuario($nome, $email, $senha, $tipo = 'cliente', $status = 'ativo')
    {
        $sql = "INSERT INTO tbl_usuario 
                (nome_usuario, email_usuario, senha_usuario, tipo_usuario, status_usuario, criado_em) 
                VALUES (:nome, :email, :senha, :tipo, :status, NOW())";
        $stmt = $this->db->prepare($sql);

        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindValue(':senha', $senhaHash);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function atualizarUsuario($id, $nome, $email, $senha = null, $tipo = null, $status = null)
    {
        $sql = "UPDATE tbl_usuario SET nome_usuario = :nome, email_usuario = :email";

        if ($senha) {
            $sql .= ", senha_usuario = :senha";
        }
        if ($tipo) {
            $sql .= ", tipo_usuario = :tipo";
        }
        if ($status) {
            $sql .= ", status_usuario = :status";
        }

        $sql .= ", atualizado_em = NOW() WHERE id_usuario = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);

        if ($senha) {
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
            $stmt->bindValue(':senha', $senhaHash);
        }
        if ($tipo) {
            $stmt->bindParam(':tipo', $tipo);
        }
        if ($status) {
            $stmt->bindParam(':status', $status);
        }

        return $stmt->execute();
    }

    public function excluirUsuario($id)
    {
        $sql = "UPDATE tbl_usuario SET excluido_em = NOW() WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function reativarUsuario($id)
    {
        $sql = "UPDATE tbl_usuarios SET excluido_em = NULL 
    WHERE excluindo_em IS NOT NULL ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
