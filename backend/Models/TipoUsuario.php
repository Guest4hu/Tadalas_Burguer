<?php

namespace App\Tadala\Models;

use PDO;

class TipoUsuario
{
    private $db;
    private $id;
    private $descricao;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function buscarTodosTipoUsuario()
    {
        $sql = "SELECT * FROM dom_tipo_usuario where excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdTipoUsuario($id)
    {
        $sql = "SELECT * FROM dom_tipo_usuario WHERE id = :id and excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirTipoUsuario($descricao)
    {
        $sql = "INSERT INTO dom_tipo_usuario (descricao) VALUES (:descricao)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    public function atualizarTipoUsuario($id, $descricao)
    {
        $sql = "UPDATE dom_tipo_usuario SET descricao = :descricao WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function excluirTipoUsuario($id)
    {
        $sql = "UPDATE dom_tipo_usuario SET excluido_em = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function reativarTipoUsuario($id)
    {
        $sql = 'UPDATE dom_tipo_usuario SET excluido_em = NULL WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function totalTipoUsuario()
    {
        $sql = 'SELECT COUNT(*) FROM dom_tipo_usuario';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return  $stmt->fetch();
    }

    public function totalTipoUsuarioAtivos()
    {
        $sql = 'SELECT COUNT(*) FROM dom_tipo_usuario WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function totalTipoUsuarioInativos()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM dom_tipo_usuario WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function paginacaoTipoUsuario(int $pagina = 1, int $por_pagina = 10): array
    {
        $totalQuery = "SELECT COUNT(*) FROM `dom_tipo_usuario`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * FROM `dom_tipo_usuario` LIMIT :limit OFFSET :offset";
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
