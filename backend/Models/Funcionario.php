<?php

namespace App\Tadala\Models;
use PDO;
use InvalidArgumentException;

/**
 * Classe responsável por manipular dados de Funcionários no banco de dados.
 */
class Funcionario {
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

    public function buscarTodosFuncionario(){
        $sql = "SELECT * FROM tbl_funcionarios WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdFuncionario($id){
        $sql = "SELECT * FROM tbl_funcionarios WHERE funcionario_id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirFuncionario($usuario_id, $cargo_id, $status_funcionario_id, $salario){
        $sql = "INSERT INTO tbl_funcionarios (usuario_id, cargo_id, status_funcionario_id, salario)
                VALUES (:usuario, :cargo, :status, :salario)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':usuario', $usuario_id, PDO::PARAM_INT);
        $stmt->bindValue(':cargo', $cargo_id, PDO::PARAM_INT);
        $stmt->bindValue(':status', $status_funcionario_id, PDO::PARAM_INT);
        $stmt->bindValue(':salario', $salario);
        return $stmt->execute();
    }

    public function atualizarFuncionario($id, $cargo_id, $status_funcionario_id, $salario){
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

    public function excluirLogicamenteFuncionario($id){
        $sql = "UPDATE tbl_funcionarios SET excluido_em = NOW() WHERE funcionario_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function reativarFuncionario($id){
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
}
?>
