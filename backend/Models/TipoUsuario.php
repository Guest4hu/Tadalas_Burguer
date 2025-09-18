<?php
class TipoUsuario {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    function buscarTodos(){
        $sql = "SELECT * FROM dom_tipo_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPorId($id){
        $sql = "SELECT * FROM dom_tipo_usuario WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function inserir($descricao){
        $sql = "INSERT INTO dom_tipo_usuario (descricao) VALUES (:descricao)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    function atualizar($id, $descricao){
        $sql = "UPDATE dom_tipo_usuario SET descricao = :descricao WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
