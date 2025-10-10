<?php

namespace App\Tadala\Models;
use PDO;
use InvalidArgumentException;

/**
 * Classe responsável por manipular dados de Funcionários no banco de dados.
 */
class Funcionarios {
    /** @var PDO */
    private $db;

    private $funcionario_id;
    private $usuario_id;
    private $cargo_id;
    private $status_funcionario_id;
    private $salario;

    public function __construct($db){
        if (!$db instanceof PDO) {
            throw new InvalidArgumentException("Instância de PDO inválida fornecida.");
        }
        $this->db = $db;
    }

    public function buscarFuncionarios(){
        $sql = "SELECT * FROM tbl_funcionarios WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdFuncionarios($id){
        $sql = "SELECT * FROM tbl_funcionarios WHERE funcionario_id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirFuncionarios($usuario_id, $cargo_id, $status_funcionario_id, $salario){
        $sql = "INSERT INTO tbl_funcionarios (usuario_id, cargo_id, status_funcionario_id, salario)
                VALUES (:usuario, :cargo, :status, :salario)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':usuario', $usuario_id, PDO::PARAM_INT);
        $stmt->bindValue(':cargo', $cargo_id, PDO::PARAM_INT);
        $stmt->bindValue(':status', $status_funcionario_id, PDO::PARAM_INT);
        $stmt->bindValue(':salario', $salario);
        return $stmt->execute();
    }

    public function atualizarFuncionarios($id, $cargo_id, $status_funcionario_id, $salario){
        $sql = "UPDATE tbl_funcionarios
                SET cargo_id = :cargo, status_funcionario_id = :status, salario = :salario
                WHERE funcionario_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':cargo', $cargo_id, PDO::PARAM_INT);
        $stmt->bindValue(':status', $status_funcionario_id, PDO::PARAM_INT);
        $stmt->bindValue(':salario', $salario);
        return $stmt->execute();
    }

    public function excluirLogicamenteFuncionarios($id){
        $sql = "UPDATE tbl_funcionarios SET excluido_em = NOW() WHERE funcionario_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function reativarFuncionarios($id){
        $sql = 'UPDATE tbl_funcionarios SET excluido_em = NULL WHERE funcionario_id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt -> bindParam(':id', $id);
        return $stmt->execute();
    }

    public function totalFuncionarios(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_funcionarios';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function totalFuncionariosAtivos(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_funcionarios WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
    public function totalFuncionariosInativos(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_funcionarios WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
    public function paginacaoFuncionarios(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_funcionarios`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * FROM `tbl_funcionarios` LIMIT :limit OFFSET :offset";
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
?>
