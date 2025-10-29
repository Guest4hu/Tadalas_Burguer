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
        $sql = "SELECT usu.usuario_id, usu.nome, usu.email, usu.senha, usu.telefone, ca.descricao from tbl_usuario as usu INNER JOIN dom_tipo_usuario as ca ON usu.usuario_id = ca.id WHERE usu.excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar usuário por email
    public function buscarUsuariosPorEMail($email){
        $sql = "SELECT * FROM tbl_usuario where email_usuario = :email and excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function buscarUsuariosPorID(int $id){
        $sql = "SELECT * FROM tbl_usuario where usuario_id = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        $sql = "UPDATE tbl_usuario SET excluido_em = NULL 
    WHERE excluindo_em IS NOT NULL ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function totalUsuario()
    {   
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_usuario WHERE tipo_usuario_id = 1';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return $stmt->fetch();
    }

    public function totalUsuarioAtivos()
    {   
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_usuario WHERE excluido_em IS NULL AND tipo_usuario_id = 1';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return $stmt->fetch();
    }
    public function totalUsuarioInativos()  {
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_usuario WHERE excluido_em IS NOT NULL AND tipo_usuario_id = 1';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function paginacaoUsuario(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_usuario`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * from tbl_usuario as usu INNER JOIN dom_tipo_usuario as ca ON usu.tipo_usuario_id = ca.id WHERE usu.excluido_em IS NULL and usu.tipo_usuario_id = 1 LIMIT :limit OFFSET :offset";
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
