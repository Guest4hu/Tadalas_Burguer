<?php
namespace App\Tadala\Models;
use PDO;

class TipoUsuario {
    private $db;
    private $id;
    private $descricao;

    public function __construct($db){
        $this->db = $db;
    }

    public function buscarTodos(){
        $sql = "SELECT * FROM dom_tipo_usuario where excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id){
        $sql = "SELECT * FROM dom_tipo_usuario WHERE id = :id and excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserir($descricao){
        $sql = "INSERT INTO dom_tipo_usuario (descricao) VALUES (:descricao)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    public function atualizar($id, $descricao){
        $sql = "UPDATE dom_tipo_usuario SET descricao = :descricao WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function excluirTipoUsuario($id){
        $sql = "UPDATE dom_tipo_usuario SET excluido_em = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function reativarTipoUsuario($id){
        $sql = 'UPDATE dom_tipo_usuario SET excluido_em = NULL WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>
