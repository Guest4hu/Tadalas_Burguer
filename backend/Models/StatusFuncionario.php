<?php


namespace App\Tadala\Models;
use PDO;
        class StatusFuncionario{
        private $id; 
        private $descricao;
        private $db;

        public function __construct($db){
            $this->db = $db;
    }

        public function BuscarTodosStatus(){
        $sql = "SELECT * FROM dom_status_funcionario WHERE excluido_em IS NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

