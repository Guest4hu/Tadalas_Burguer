<?php

namespace App\Tadala\Core;


class Loading
{
    private static $temporaryPath = __DIR__ . "/../Views/templates/temporary/load.html";
    private static $cssPath = __DIR__ . '/../../assets/css/loading.css';
    private static $jsPath = __DIR__ . '/../../assets/js/loading.js';

    public static function add($file)
    {
        $html = file_get_contents(__DIR__ . "/../Views/templates/{$file}.php");

        self::render(
                        self::addLoadingAssets($html)
                    );
    }

    private static function parseFiles()
    {
        $js = '<script>' . file_get_contents(self::$jsPath) . '</script>';

        $css = file_get_contents(self::$cssPath);

        return [$js, $css];
    }

    private static function addLoadingAssets($html)
    {
        [$js, $css] = self::parseFiles();

        $before = ['</head>', '</body>'];

        $cssPosition = strpos($html, $before[0]) - strlen(' </style> ');

        $withCss = substr_replace($html, $css, $cssPosition, 0);

        $jsPosition = strpos($withCss, $before[1]);

        return substr_replace($withCss, $js, $jsPosition, 0);
    }
    
    private static function render($page_content) {

        $handle = fopen(self::$temporaryPath, 'w');

        fwrite($handle, $page_content);

        fclose($handle);

        require_once self::$temporaryPath;
    }
}
