<?php 
namespace App\Tadala;

require_once __DIR__ . '/../vendor/autoload.php';

use App\Tadala\Rotas\Rotas;
use Bramus\Router\Router;

$router = new Router();

if (!isset($_SESSION)) {
    session_start();
}

$rotas = Rotas::get(); 

$router->setNamespace("\App\Tadala\Controllers");

foreach ($rotas as $metodoHttp => $rota) {
    foreach ($rota as $uri => $acao) {
        $metodoBramus = strtolower($metodoHttp);
        $router->{$metodoBramus}($uri, $acao);
    }
}
$router->set404(function() {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, página não encontrada!';
});

$router->run();
    
