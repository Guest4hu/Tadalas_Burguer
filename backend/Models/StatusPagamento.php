<?php

namespace App\Tadala\Models;

use PDO;

class StatusPagamento
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function ativarSincronizacao(){
        $sql = "UPDATE dom_status_pagamento SET sincronizar = 1 WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }

    public function buscarTodosStatusPagamento()
    {
        $sql = "SELECT * FROM dom_status_pagamento";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdStatusPagamento($id)
    {
        $sql = "SELECT * FROM dom_status_pagamento WHERE id = :id and excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirStatusPagamento($descricao)
    {
        $sql = "INSERT INTO dom_status_pagamento (descricao) VALUES (:descricao)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    public function atualizarStatusPagamento($id, $descricao)
    {
        $sql = "UPDATE dom_status_pagamento SET descricao = :descricao WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function excluirStatusPagamentoStatusPagamento($id)
    {
        $sql = "UPDATE dom_status_pagamento SET excluido_em = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function reativarStatusPagamento($id)
    {
        $sql = 'UPDATE dom_status_pagamento SET excluido_em = NULL WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

        public function totalStatusPagamento()
    {   
        $sql = 'SELECT COUNT(*) as "total" FROM dom_status_pagamento';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return $stmt->fetch();
    }

    public function totalStatusPagamentoAtivos()
    {   
        $sql = 'SELECT COUNT(*) as "total" FROM dom_status_pagamento WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return $stmt->fetch();
    }
    public function totalStatusPagamentoInativos()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM dom_status_pagamento WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function paginacaoStatusPagamento(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `dom_status_pagamento`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * FROM `dom_status_pagamento` LIMIT :limit OFFSET :offset";
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
