<?php
// Conexão com o banco
require_once "backend/Database/Databases.php"; 
require_once "backend/Models/Pedido.php";

// Instancia o model
$pedido = new Pedido($db);

// ===== Exemplos de uso ===== //

// Buscar todos os pedidos
// $resultado = $pedido->buscarTodos();
// echo json_encode($resultado);

// Buscar pedido por ID
// $resultado = $pedido->buscarPorId(1);
// var_dump($resultado);

// Inserir pedido (usuario_id, status_pedido_id)
$resultado = $pedido->inserir(22, 1);
var_dump($resultado);

// Atualizar pedido (id, novo status_pedido_id)
// $resultado = $pedido->atualizar(3, 2);
// var;

?>
