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
    public function buscarUsuariosPorEMail($email)
    {
        $sql = "SELECT * FROM tbl_usuario where email = :email and excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function buscarUsuariosPorID(int $id)
    {
        $sql = "SELECT * FROM tbl_usuario where usuario_id = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
    public function inserirUsuario($nome, $email, $senha)
    {
        $sql = "INSERT INTO tbl_usuario 
                (nome, email, senha, tipo_usuario_id,  criado_em) 
                VALUES (:nome, :email, :senha, 1,  NOW())";
        $stmt = $this->db->prepare($sql);

        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindValue(':senha', $senhaHash);
        if($stmt->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    public function atualizarUsuario($id, $nome, $email, $senha, $tipo)
    {

        $sql = "UPDATE tbl_usuario 
                SET nome = :nome, 
                    email = :email, 
                    tipo_usuario_id = :tipo, 
                    atualizado_em = NOW()";


        if (!empty($senha)) {
            $sql .= ", senha = :senha";
        }

        $sql .= " WHERE usuario_id = :id";

        $stmt = $this->db->prepare($sql);


        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':tipo', $tipo);


        if (!empty($senha)) {
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
            $stmt->bindValue(':senha', $senhaHash);
        }

        return $stmt->execute();
    }





    public function excluirUsuario($id)
    {
        $sql = "UPDATE tbl_usuario SET excluido_em = NOW() WHERE usuario_id = :id";
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
    public function totalUsuarioInativos()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_usuario WHERE excluido_em IS NOT NULL AND tipo_usuario_id = 1';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function paginacaoUsuario(int $pagina = 1, int $por_pagina = 10): array
    {
        $totalQuery = "SELECT COUNT(*) FROM `tbl_usuario`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;

        //Query que o Gustavo tinha feito
        // $dataQuery = "SELECT * from tbl_usuario as usu INNER JOIN dom_tipo_usuario as ca ON usu.tipo_usuario_id = ca.id WHERE usu.excluido_em IS NULL and usu.tipo_usuario_id = 1 LIMIT :limit OFFSET :offset";

        // Query do Vitão
        $dataQuery = "SELECT usu.usuario_id, usu.nome, usu.email, usu.senha, usu.telefone, ca.descricao from tbl_usuario as usu INNER JOIN dom_tipo_usuario as ca ON usu.tipo_usuario_id = ca.id WHERE usu.excluido_em IS NULL LIMIT :limit OFFSET :offset";
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

    public function formatarTipoUsuario($tipoId) {
        $sql = "SELECT descricao FROM dom_tipo_usuario WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $tipoId);
        $stmt->execute();
        return $stmt->fetch()['descricao'];
    }

    public function checarCredenciais(string $email, string $senha)
    {
        $usuario = $this->buscarUsuariosPorEMail($email);
        if (count($usuario) !== 1) {
            return false;
        }
        $usuario = $usuario[0];

        $usuario['tipo_usuario_nome'] = $this->formatarTipoUsuario($usuario['tipo_usuario_id']);
        if (password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }
}