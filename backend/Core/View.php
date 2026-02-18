<?php

namespace App\Tadala\Core;

class View
{
    public static function render($nomeView, $dados = [], $type = 'none')
    {
        extract($dados);

        switch ($type) {
            case 'none':
                require_once __DIR__ . "/../Views/templates/{$nomeView}.php";
                break;

            case 'dashboard':
                require_once __DIR__ . "/../Views/templates/partials/dashboard/header.php";
                require_once __DIR__ . "/../Views/templates/{$nomeView}.php";
                require_once __DIR__ . "/../Views/templates/partials/dashboard/footer.php";
                break;

            case 'loading':
                Loading::add($nomeView);

        }
    }

    public static function configuracao($nomeView, $dados = [])
    {
        extract($dados);
        require_once __DIR__ . "/../Views/templates/partials/configuracao/header.php";
        require_once __DIR__ . "/../Views/templates/{$nomeView}.php";
        require_once __DIR__ . "/../Views/templates/partials/configuracao/footer.php";
    }

    public static function configuracaoIndex($nomeView, $dados = [])
    {
        extract($dados);
        require_once __DIR__ . "/../Views/templates/partials/configuracao/header.php";
        require_once __DIR__ . "/../Views/templates/configuracao/{$nomeView}.php";
        require_once __DIR__ . "/../Views/templates/partials/configuracao/footer.php";
    }
}
