<?php


use App\Tadala\Models\Categoria;
$testeCategoria = new Categoria($db);

var_dump($testeCategoria->buscarCategoria());
