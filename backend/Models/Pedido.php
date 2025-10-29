<?php
namespace App\Tadala\Models;
use PDO;
class Pedido 
{
    private $db;
    private $pedido_id;
    private $usuario_id;
    private $status_pedido_id;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;
    public function __construct($db){
        $this->db = $db;
    }

    public function buscarTodosPedido(){
        $sql = "select * from tbl_pedidos as pe INNER JOIN tbl_usuario as us ON pe.usuario_id = us.usuario_id INNER JOIN dom_status_pedido as sp ON pe.status_pedido_id = sp.id INNER JOIN dom_tipo_pedido as tp ON pe.tipo_pedido = tp.id INNER JOIN tbl_endereco as en ON pe.usuario_id = en.usuario_id;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdPedido($id){
        $sql = "SELECT * FROM tbl_pedidos WHERE pedido_id = :id and excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inserirPedido($usuario_id, $status_pedido_id){
        $sql = "INSERT INTO tbl_pedidos (usuario_id, status_pedido_id, criado_em) 
                VALUES (:usuario, :status, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':usuario', $usuario_id);
        $stmt->bindParam(':status', $status_pedido_id);
        return $stmt->execute();
    }

    public function atualizarPedido($id, $status_pedido_id){
        $sql = "UPDATE tbl_pedidos 
                SET status_pedido_id = :status, atualizado_em = NOW()
                WHERE pedido_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status_pedido_id);
        return $stmt->execute();
    }
    public function deletarPedido($id){
        $sql = "UPDATE tbl_pedidos
        SET excluido_em = :excluido_em NOW()
        WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt -> bindParam(':id', $id);
        return $stmt->execute();

    }
    public function reativarPedido($id){
        $sql = 'UPDATE tbl_pedidos set excluido_em = NULL WHERE pedido_id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt -> bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function totalPedido()
    {   
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_pedidos';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return $stmt->fetch();
    }

    public function totalPedidoAtivos()
    {   
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_pedidos WHERE excluido_em IS NULL AND status_pedido_id != 4 and status_pedido_id != 5';
        $stmt = $this->db->prepare($sql);   
        $stmt->execute();
        return $stmt->fetch();
    }
    public function totalPedidoInativos()
    {
        $sql = 'SELECT COUNT(*)as "total" FROM tbl_pedidos WHERE excluido_em IS NULL AND (status_pedido_id = 4 or status_pedido_id = 5)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function paginacaoPedidoNovo(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_pedidos`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "select * from tbl_pedidos as pe INNER JOIN tbl_usuario as us ON pe.usuario_id = us.usuario_id INNER JOIN dom_status_pedido as sp ON pe.status_pedido_id = sp.id INNER JOIN dom_tipo_pedido as tp ON pe.tipo_pedido = tp.id INNER JOIN tbl_endereco as en ON pe.usuario_id = en.usuario_id WHERE sp.id = 1 LIMIT :limit OFFSET :offset";
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
    public function paginacaoPedidoEmPreparo(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_pedidos`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "select * from tbl_pedidos as pe INNER JOIN tbl_usuario as us ON pe.usuario_id = us.usuario_id INNER JOIN dom_status_pedido as sp ON pe.status_pedido_id = sp.id INNER JOIN dom_tipo_pedido as tp ON pe.tipo_pedido = tp.id INNER JOIN tbl_endereco as en ON pe.usuario_id = en.usuario_id WHERE sp.id = 2 LIMIT :limit OFFSET :offset";
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
    public function paginacaoPedidoEmEntrega(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_pedidos`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "select * from tbl_pedidos as pe INNER JOIN tbl_usuario as us ON pe.usuario_id = us.usuario_id INNER JOIN dom_status_pedido as sp ON pe.status_pedido_id = sp.id INNER JOIN dom_tipo_pedido as tp ON pe.tipo_pedido = tp.id INNER JOIN tbl_endereco as en ON pe.usuario_id = en.usuario_id WHERE sp.id = 3 LIMIT :limit OFFSET :offset";
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
    
    public function paginacaoPedidoComcluido(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_pedidos`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "select * from tbl_pedidos as pe INNER JOIN tbl_usuario as us ON pe.usuario_id = us.usuario_id INNER JOIN dom_status_pedido as sp ON pe.status_pedido_id = sp.id INNER JOIN dom_tipo_pedido as tp ON pe.tipo_pedido = tp.id INNER JOIN tbl_endereco as en ON pe.usuario_id = en.usuario_id WHERE sp.id = 4 LIMIT :limit OFFSET :offset";
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
    public function paginacaoPedidoCancelados(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_pedidos`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "select * from tbl_pedidos as pe INNER JOIN tbl_usuario as us ON pe.usuario_id = us.usuario_id INNER JOIN dom_status_pedido as sp ON pe.status_pedido_id = sp.id INNER JOIN dom_tipo_pedido as tp ON pe.tipo_pedido = tp.id INNER JOIN tbl_endereco as en ON pe.usuario_id = en.usuario_id WHERE sp.id = 5 LIMIT :limit OFFSET :offset";
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
    public function BuscarItemsPedidosId($id)
    {
        $sql = "SELECT * FROM tbl_itens_pedido WHERE pedido_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
