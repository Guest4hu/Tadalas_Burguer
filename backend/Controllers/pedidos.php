<?php
// Include database connection
require_once "backend/Database/Databases.php"; 
require_once "backend/Models/pedidos.php";

// $pedido = new pedidos($db);

// $id_usuario = $_GET['id_usuario'] ?? null;

// $pedidos = $pedido->buscarPedidos($id_usuario);

// var_dump($pedidos);
$pedido = new pedidos($db);

$pedidos = $pedidos->inserirPedidos(22, 23, 1);
var_dump($pedidos);

?>

