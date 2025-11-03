<?php
namespace App\Tadala\Models;
use PDO;

class TipoPedido {
    private $db;


    public function __construct($db){
        $this->db = $db;
    }

    public function buscarTodosTipoPedido(){
        $sql = "SELECT * FROM dom_tipo_pedido";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdTipoPedido($id){
        $sql = "SELECT * FROM dom_tipo_pedido WHERE id = :id and excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirTipoPedido($descricao){
        $sql = "INSERT INTO dom_tipo_pedido (descricao) VALUES (:descricao)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    public function atualizarTipoPedido($id, $descricao){
        $sql = "UPDATE dom_tipo_pedido SET descricao = :descricao WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function excluirTipoPedido($id){
        $sql = "UPDATE dom_tipo_pedido SET excluido_em = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function reativarTipoPedido($id){
        $sql = 'UPDATE dom_tipo_pedido SET excluido_em = NULL WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

            public function totalTipoPedido()
    {   
        $sql = 'SELECT COUNT(*) as "total" FROM dom_tipo_pedido';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return  $stmt->fetch();
    }
    
    public function totalTipoPedidoAtivos()
    {   
        $sql = 'SELECT COUNT(*) as "total" FROM dom_tipo_pedido WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return $stmt->fetch();
    }
    public function totalTipoPedidoInativos()
    {
        $sql = 'SELECT COUNT(*)as "total" FROM dom_tipo_pedido WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function paginacaoTipoPedido(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `dom_tipo_pedido`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * FROM `dom_tipo_pedido` LIMIT :limit OFFSET :offset";
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
