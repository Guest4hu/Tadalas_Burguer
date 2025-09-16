<?php 


include_once __DIR__.'/../model/produtos.php';
include_once __DIR__.'/../Database/database.php';




$Produtos = new Produtos($db);
$resultado = $Produtos->buscaProdutos();
var_dump($resultado);