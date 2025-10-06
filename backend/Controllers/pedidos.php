<?php
// Include database connection
namespace App\Tadala\Controllers;

use App\Tadala\Models\Pedido;
use App\Tadala\Database\Database;
use App\Tadala\Core\View;


$pedido = new Pedido($db);

$pedidos = $pedido->inserirPedido(22, 23, 1);
var_dump($pedidos);

?>
