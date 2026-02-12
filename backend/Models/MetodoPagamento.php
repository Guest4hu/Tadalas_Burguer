<?php

namespace App\Tadala\Models;
use PDO;

class MetodoPagamento
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ativarSincronizacao(){
        $sql = "UPDATE dom_metodo_pagamento SET sincronizar = 1 WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }

    public function buscarTodosMetodosPagamento()
    {
        $sql = "SELECT * FROM dom_metodo_pagamento";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>
