<?php

namespace App\Tadala\Models;

use PDO;
use PDOException;
use InvalidArgumentException;
use Exception;

class Agendamento
{
    /** @var PDO */
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        // Garante tratamento de erro via exceções
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Retorna todos os agendamentos ativos (não excluídos)
     * @return array
     */
    public function buscarAgendamentos(): array
    {
        $sql = "select  u.nome, u.telefone, a.data_hora_inicio, a.data_hora_fim, a.mesa_id from tbl_agendamento as a INNER JOIN tbl_usuario as u on a.usuario_id = u.usuario_id
                WHERE a.excluido_em IS NULL
                ORDER BY a.data_hora_inicio DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca um agendamento específico por ID
     * @param int $id
     * @return array|null
     */
    public function buscarAgendamentoPorId(int $id): ?array
    {
        $sql = "SELECT 
                    agendamento_id,
                    usuario_id,
                    mesa_id,
                    data_hora_inicio,
                    data_hora_fim,
                    criado_em,
                    atualizado_em
                FROM tbl_agendamento
                WHERE agendamento_id = :id
                  AND excluido_em IS NULL
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row === false ? null : $row;
    }

    /**
     * Insere um novo agendamento
     * @param string $data_hora_inicio
     * @param string $data_hora_fim
     * @param int $usuario_id
     * @param int $mesa_id
     * @return int|false
     */
    public function inserirAgendamento(string $data_hora_inicio, string $data_hora_fim, int $usuario_id, int $mesa_id)
    {
        // Validação básica
        if (empty(trim($data_hora_inicio)) || empty(trim($data_hora_fim))) {
            throw new InvalidArgumentException("Data e hora do agendamento são obrigatórias.");
        }

        $sql = "INSERT INTO tbl_agendamento 
                (data_hora_inicio, data_hora_fim, usuario_id, mesa_id, criado_em)
                VALUES (:inicio, :fim, :usuario_id, :mesa_id, NOW())";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':inicio', $data_hora_inicio);
        $stmt->bindValue(':fim', $data_hora_fim);
        $stmt->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindValue(':mesa_id', $mesa_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return (int)$this->db->lastInsertId();
        }

        return false;
    }

    /**
     * Atualiza informações de um agendamento existente
     * @param int $id
     * @param string $data_hora_inicio
     * @param string $data_hora_fim
     * @param int $usuario_id
     * @param int $mesa_id
     * @return bool
     */
    public function atualizarAgendamento(int $id, string $data_hora_inicio, string $data_hora_fim, int $usuario_id, int $mesa_id): bool
    {
        $sql = "UPDATE tbl_agendamento 
                SET data_hora_inicio = :inicio,
                    data_hora_fim = :fim,
                    usuario_id = :usuario_id,
                    mesa_id = :mesa_id,
                    atualizado_em = NOW()
                WHERE agendamento_id = :id AND excluido_em IS NULL";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':inicio', $data_hora_inicio);
        $stmt->bindValue(':fim', $data_hora_fim);
        $stmt->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindValue(':mesa_id', $mesa_id, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Soft delete de um agendamento
     * @param int $id
     * @return bool
     */
    public function excluirAgendamento(int $id): bool
    {
        $sql = "UPDATE tbl_agendamento
                SET excluido_em = NOW()
                WHERE agendamento_id = :id AND excluido_em IS NULL";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Restaura um agendamento excluído
     * @param int $id
     * @return bool
     */
    public function reativarAgendamento(int $id): bool
    {
        $sql = "UPDATE tbl_agendamento
                SET excluido_em = NULL, atualizado_em = NOW()
                WHERE agendamento_id = :id AND excluido_em IS NOT NULL";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

     public function totalAgendamentos()
    {
        $sql = 'SELECT COUNT(*)as "total" FROM tbl_agendamento';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function totalAgendamentosAtivos()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_agendamento WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function totalAgendamentosInativos()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_agendamento WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function paginacaoAgendamento(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_agendamento`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT 
        ag.agendamento_id,
        us.usuario_id,
        us.nome,
        us.telefone,
        ag.data_hora_inicio,
        ag.data_hora_fim,
        ag.mesa_id
    FROM tbl_agendamento AS ag
    INNER JOIN tbl_usuario AS us 
        ON ag.usuario_id = us.usuario_id
    WHERE 
        ag.excluido_em IS NULL
        AND us.excluido_em IS NULL
    ORDER BY ag.data_hora_inicio DESC
    LIMIT :limit OFFSET :offset";
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
