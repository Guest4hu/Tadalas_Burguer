<?php 
namespace App\Tadala;
require_once __DIR__ . '/../vendor/autoload.php';

use App\Tadala\Rotas\Rotas;


$rotas = Rotas::get();



$metodoHttp = $_SERVER['REQUEST_METHOD'];
$rota = $_SERVER['REQUEST_URI'];
$partes = explode("@", $rotas[$metodoHttp][$rota]);
$nomeController = $partes[0];
$metodoController = $partes[1];
$nomeCompletoController = "App\\Tadala\\Controllers\\" . $nomeController;
$controller = new $nomeCompletoController();
$controller->$metodoController();

