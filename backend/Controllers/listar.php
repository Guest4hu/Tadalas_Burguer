<?php
require_once "../backend/Database/Database.php"; 
require_once "../backend/Models/pedidos.php";

$pedido = new pedidos($db);

$id_usuario = $_GET['id_usuario'] ?? null;

if($id_usuario){
    $sql = "SELECT * FROM tbl_pedidos WHERE id_usuario = :id_usuario AND excluido_em IS NULL ORDER BY criado_em DESC";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->execute();
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['success'=>true, 'pedidos'=>$pedidos]);
} else {
    echo json_encode(['success'=>false, 'msg'=>'ID do usuário não informado']);
}
?>
