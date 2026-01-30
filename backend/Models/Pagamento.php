<?php

namespace App\Tadala\Models;

use PDO;
use PDOException;

class Pagamento
{

    private $db;
    private $pagamento_id;
    private $pedido_id;
    private $metodo;
    private $status_pagamento_id;
    private $valor_total;
    public function __construct($db)
    {
        $this->db = $db;
    }


    public function buscarTodosPagamento()
    {
        try {
            $sql = "SELECT * FROM tbl_pagamento WHERE excluindo_em IS NULL";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar todos os pagamentos: ' . $e->getMessage());
            return [];
        }
    }
    public function buscarPorIdPagamento($id)
    {
        $sql = "SELECT metodo,status_pagamento_id FROM tbl_pagamento 
                    WHERE pedido_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }
    public function inserirPagamento($pedido_id, $metodo, $status_pagamento_id, $valor_total)
    {
        try {
            $sql = "INSERT INTO tbl_pagamento (pedido_id, metodo, status_pagamento_id, valor_total) 
                    VALUES (:pedido, :metodo, :status, :valor)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':pedido', $pedido_id, PDO::PARAM_INT);
            $stmt->bindParam(':metodo', $metodo, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status_pagamento_id, PDO::PARAM_INT);
            $stmt->bindParam(':valor', $valor_total);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao inserir pagamento: ' . $e->getMessage());
            return false;
        }
    }
    public function excluirPagamento($id)
    {
        $sql = "UPDATE tbl_pagamento SET excluido_em = NOW() WHERE item_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function atualizarMetodoPagamento($id, $metodo, $valor_total)
    {
        try {
            $sql = "UPDATE tbl_pagamento 
                    SET metodo = :metodo,
                        valor_total = :valor
                    WHERE pedido_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':metodo', $metodo, PDO::PARAM_STR);
            $stmt->bindParam(':valor', $valor_total);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar pagamento: ' . $e->getMessage());
            return false;
        }
    }

     public function atualizarStatusPagamento($id,  $status_pagamento_id, $valor_total)
    {
        try {
            $sql = "UPDATE tbl_pagamento 
                    SET 
                        status_pagamento_id = :status, 
                        valor_total = :valor
                    WHERE pedido_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status_pagamento_id, PDO::PARAM_INT);
            $stmt->bindParam(':valor', $valor_total);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar pagamento: ' . $e->getMessage());
            return false;
        }
    }


    public function reativarPagamento($id)
    {
        $sql = 'UPDATE tbl_pagamento SET excluido_em = NULL WHERE pagamento_id = :id';
        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }

    public function totalPagamento(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_pagamento';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function totalPagamentoAtivos(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_pagamento WHERE excluido_em IS NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
    public function totalPagamentoInativos(): int
    {
        $sql = 'SELECT COUNT(*) FROM tbl_pagamento WHERE excluido_em IS NOT NULL';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }
    public function paginacaoPagamento(int $pagina = 1, int $por_pagina = 10): array
    {
        $totalQuery = "SELECT COUNT(*) FROM `tbl_pagamento`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * FROM `tbl_pagamento` LIMIT :limit OFFSET :offset";
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

    // public function TotalVendas(): int
    // {
    //     $sql = 'SELECT SUM(valor_total) FROM tbl_pagamento WHERE status_pagamento_id = 2;';
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->execute();
    //     $total = $stmt->fetchColumn();
    //     return (int)$total;
    // }

        public function calculaValorTotal($pedidoID){
            $sql = 'SELECT SUM(ip.valor_unitario * ip.quantidade)
            FROM tbl_itens_pedidos ip
            WHERE pedido_id = :pedidoID;';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':pedidoID', $pedidoID, PDO::PARAM_INT);
            $stmt->execute();
            return (float)$stmt->fetchColumn();
        }


    public function TotalVendasCanceladas()
    {
        $sql = 'SELECT SUM(valor_total) FROM tbl_pagamento
                WHERE status_pagamento_id = 3;';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function TicketMedio(){
        $sql = 'SELECT AVG(valor_total) FROM tbl_pagamento
WHERE status_pagamento_id = 2;';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
       public function TotalVendas(): array {
            $totalVendas = $this->db->query("SELECT SUM(valor_total) FROM tbl_pagamento WHERE status_pagamento_id = 2;")->fetchColumn();
            $tipoDePagamentoPix = $this->db->query("SELECT SUM(valor_total) FROM tbl_pagamento WHERE status_pagamento_id = 2 AND metodo = 1;")->fetchColumn();
            $tipoDePagamentoCC = $this->db->query("SELECT SUM(valor_total) FROM tbl_pagamento WHERE status_pagamento_id = 2 AND metodo = 2;")->fetchColumn();
            $tipoDePagamentoCD = $this->db->query("SELECT SUM(valor_total) FROM tbl_pagamento WHERE status_pagamento_id = 2 AND metodo = 3;")->fetchColumn();
            $tipoDePagamentoBN = $this->db->query("SELECT SUM(valor_total) FROM tbl_pagamento WHERE status_pagamento_id = 2 AND metodo = 4;")->fetchColumn();
            $logsLast14Days = $this->db->query(
                "SELECT DATE(criado_em) AS log_date, DAYOFWEEK(criado_em) AS dia_senana, COUNT(pedido_id) AS count
                 FROM tbl_pagamento
                 WHERE  criado_em >= DATE_SUB(CURDATE(), INTERVAL 14 DAY);"
            )->fetchAll(PDO::FETCH_ASSOC);
            $dowLabels = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb']; 
            $lastWeekData = array_fill(0, 7, 0); 
            $currentWeekData = array_fill(0, 7, 0); 
            $today = new \DateTime('today');
            $startOfCurrentWeek = (clone $today)->modify('tomorrow -1 week');
            foreach ($logsLast14Days as $log) {
                $logDate = new \DateTime($log['log_date']);
                // O format('w') do PHP retorna 0=Dom, 6=Sáb
                $dayOfWeekIndex = (int)$logDate->format('w'); 
                $count = (int)$log['count'];
                if ($logDate >= $startOfCurrentWeek) {
                    $currentWeekData[$dayOfWeekIndex] = $count;
                } else {
                    $lastWeekData[$dayOfWeekIndex] = $count;
                }
            }
            return [
                'totalVendas' => (int)$totalVendas,
                'tipoDePagamentoPix' => (int)$tipoDePagamentoPix,
                'tipoDePagamentoCC' => (int)$tipoDePagamentoCC,
                'tipoDePagamentoCD' => (int)$tipoDePagamentoCD,
                'tipoDePagamentoBN' => (int)$tipoDePagamentoBN,
                'logsComparison' => [
                    'labels' => $dowLabels,
                    'lastWeek' => $lastWeekData,
                    'currentWeek' => $currentWeekData,
                ],
            ];
        }
     
}
