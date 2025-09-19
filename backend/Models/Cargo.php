<?php
class Cargo {
    private $db;
    private $descricao;

    public function __construct($db){
        $this->db = $db;
    }

    function buscarTodosCargo(){
        $sql = "SELECT * FROM dom_cargo WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarPorIdCargo($id){
        $sql = "SELECT * FROM dom_cargo WHERE id = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function inserirCargo($descricao){
        $sql = "INSERT INTO dom_cargo (descricao) VALUES (:descricao)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    function atualizarCargo($id, $descricao){
        $sql = "UPDATE dom_cargo SET descricao = :descricao WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    function deletarCargo($id){
        $sql = "DELETE FROM dom_cargo WHERE id = :id and excluido_em IS NULL"; 
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}
?>
