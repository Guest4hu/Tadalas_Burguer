<?php
namespace App\Tadala\Models;
use PDO;

class Endereco {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function ativarSincronizacao(){
        $sql = "UPDATE tbl_endereco SET sincronizar = 1 WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }

    public function buscarEnderecosPorUsuarioAtivo(){
        $sql = "SELECT e.endereco_id, e.usuario_id, e.rua, e.numero, e.bairro, e.cidade, e.estado, e.cep, e.criado_em, e.atualizado_em, e.excluido_em 
                FROM tbl_endereco AS e 
                INNER JOIN tbl_usuario AS u ON e.usuario_id = u.usuario_id 
                WHERE u.excluido_em IS NULL AND e.excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarEnderecosAtivos(): array {
        $sql = "SELECT * FROM tbl_endereco WHERE excluido_em IS NULL ORDER BY endereco_id ASC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarTodosEndereco(): array {
        $sql = "SELECT * FROM tbl_endereco WHERE excluido_em IS NULL ORDER BY endereco_id ASC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdEndereco(int $usuario_id): ?array {
        $sql = "SELECT rua,bairro,numero,cidade,estado,cep FROM tbl_endereco WHERE usuario_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function inserirEndereco(int $usuario_id, string $rua, string $numero, string $bairro, string $cidade, string $estado, string $cep): int {
        $sql = "INSERT INTO tbl_endereco (usuario_id, rua, numero, bairro, cidade, estado, cep, criado_em)
                VALUES (:usuario, :rua, :numero, :bairro, :cidade, :estado, :cep, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':usuario' => $usuario_id,
            ':rua' => $rua,
            ':numero' => $numero,
            ':bairro' => $bairro,
            ':cidade' => $cidade,
            ':estado' => $estado,
            ':cep' => $cep
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function atualizarEndereco(int $id, string $rua, string $numero, string $bairro, string $cidade, string $estado, string $cep): int {
        $sql = "UPDATE tbl_endereco 
                SET rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep, atualizado_em = NOW()
                WHERE endereco_id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':rua' => $rua,
            ':numero' => $numero,
            ':bairro' => $bairro,
            ':cidade' => $cidade,
            ':estado' => $estado,
            ':cep' => $cep
        ]);
        return $stmt->rowCount();
    }

    public function deletarEndereco(int $id): bool {
        $sql = "UPDATE tbl_endereco SET excluido_em = NOW() WHERE endereco_id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function reativarEndereco(int $id): bool {
        $sql = "UPDATE tbl_endereco SET excluido_em = NULL WHERE endereco_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function totalEndereco(): int {
        return (int)$this->db->query("SELECT COUNT(*) FROM tbl_endereco")->fetchColumn();
    }

    public function totalEnderecoAtivos(): int {
        return (int)$this->db->query("SELECT COUNT(*) FROM tbl_endereco WHERE excluido_em IS NULL")->fetchColumn();
    }

    public function totalEnderecoInativos(): int {
        return (int)$this->db->query("SELECT COUNT(*) FROM tbl_endereco WHERE excluido_em IS NOT NULL")->fetchColumn();
    }

    public function paginacaoEndereco(int $pagina = 1, int $por_pagina = 10): array {
        $total = $this->totalEndereco();
        $offset = ($pagina - 1) * $por_pagina;
        $sql = "SELECT * FROM tbl_endereco WHERE excluido_em IS NULL LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $por_pagina, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ultima = ceil($total / $por_pagina);

        return [
            'data' => $dados,
            'total' => $total,
            'por_pagina' => $por_pagina,
            'pagina_atual' => $pagina,
            'ultima_pagina' => $ultima,
            'de' => $offset + 1,
            'para' => $offset + count($dados)
        ];
    }
}
