<?php
namespace App\Tadala\Core;



class View{
    public static function render($nomeView, $dados = []){
        extract($dados);
        require_once __DIR__ . "/../Views/templates/partials/header.php";
        require_once __DIR__ . "/../Views/templates/{$nomeView}.php";
        require_once __DIR__ . "/../Views/templates/partials/footer.php";
    }

    public static function configuracao($nomeView, $dados = []){
        extract($dados);
        require_once __DIR__ . "/../Views/templates/partials/configuracao/header.php";
        require_once __DIR__ . "/../Views/templates/{$nomeView}.php";
        require_once __DIR__ . "/../Views/templates/partials/configuracao/footer.php";
    }
    
    public static function configuracaoIndex($nomeView, $dados = []){
        extract($dados);
        require_once __DIR__ . "/../Views/templates/partials/configuracao/header.php";
        require_once __DIR__ . "/../Views/templates/configuracao/{$nomeView}.php";
        require_once __DIR__ . "/../Views/templates/partials/configuracao/footer.php";
    }
}