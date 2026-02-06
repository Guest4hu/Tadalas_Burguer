<?php

namespace App\Tadala\Models;
use PDO;
use InvalidArgumentException;

/**
 * Classe responsável por gerenciar os itens de pedidos no banco de dados.
 */
class ItensPedido{
    /** @var PDO */
    private $db;

    private $item_id;
    private $pedido_id;
    private $produto_id;
    private $quantidade;
    private $valor_unitario;

    public function __construct($db){
        if (!$db instanceof PDO) {
            throw new InvalidArgumentException("Conexão PDO inválida fornecida.");
        }
        $this->db = $db;
    }

    public function buscarItensPedidoAtivos(){
        $sql = "SELECT * FROM tbl_itens_pedidos WHERE excluido_em IS NULL ORDER BY item_id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarTodosItemPedido(){
        $sql = "SELECT * FROM tbl_itens_pedidos WHERE excluido_em IS NULL ORDER BY item_id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorIdItemPedido($id){
        $sql = "SELECT 
    ip.item_id,
    ip.produto_id,
    ip.quantidade,
    ip.valor_unitario,
    pr.nome

FROM tbl_itens_pedidos AS ip
INNER JOIN tbl_produtos AS pr 
        ON ip.produto_id = pr.produto_id

WHERE ip.pedido_id = :id
  AND ip.excluido_em IS NULL;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserirItemPedido($pedido_id, $produto_id, $quantidade, $valor_unitario){
        try {
            $sql = "INSERT INTO tbl_itens_pedidos (pedido_id, produto_id, quantidade, valor_unitario)
                    VALUES (:pedido, :produto, :quantidade, :valor)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':pedido', $pedido_id, PDO::PARAM_INT);
            $stmt->bindValue(':produto', $produto_id, PDO::PARAM_INT);
            $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
            $stmt->bindValue(':valor', $valor_unitario);
            $stmt->execute();
            return $this->db->lastInsertId();
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            var_dump($th);
            exit;
        }
    }

    public function atualizarItemPedido($id, $quantidade){
        $sql = "UPDATE tbl_itens_pedidos
                SET quantidade = :quantidade
                WHERE item_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':quantidade', $quantidade, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function excluirItemPedido($id){
        $hoje = date("Y-m-d h:m:s");
        $sql = "UPDATE tbl_itens_pedidos SET excluido_em = :excluido_em 
        WHERE item_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt -> bindParam(':id', $id);
        $stmt -> bindParam(':excluido_em', $hoje);
        return $stmt->execute();

    }
    public function reativarItemPedido($id){
        $sql = 'UPDATE tbl_itens_pedidos SET excluido_em = NULL WHERE item_id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function totalItensPedidos()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_itens_pedidos';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function totalItensPedidosAtivos()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_itens_pedidos WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function totalItensPedidosInativos()
    {
        $sql = 'SELECT COUNT(*) as "total" FROM tbl_itens_pedidos WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function paginacaoItensPedido(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_itens_pedidos`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * FROM `tbl_itens_pedidos` LIMIT :limit OFFSET :offset";
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
