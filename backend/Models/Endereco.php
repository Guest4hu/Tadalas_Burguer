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
        $this->db = $db;
    }

    function buscarTodos(){
        $sql = "SELECT * FROM tbl_endereco WHERE excluindo_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPorId($id){
        $sql = "SELECT * FROM tbl_endereco WHERE endereco_id = :id and excluindo_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function inserir($usuario_id, $rua, $numero, $bairro, $cidade, $estado, $cep){
        $sql = "INSERT INTO tbl_endereco (usuario_id, rua, numero, bairro, cidade, estado, cep) 
                VALUES (:usuario, :rua, :numero, :bairro, :cidade, :estado, :cep)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario', $usuario_id);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':cep', $cep);
        return $stmt->execute();
    }

    function atualizar($id, $rua, $numero, $bairro, $cidade, $estado, $cep){
        $sql = "UPDATE tbl_endereco 
                SET rua = :rua, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado, cep = :cep
                WHERE endereco_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':cep', $cep);
        return $stmt->execute();
    }
}
?>
