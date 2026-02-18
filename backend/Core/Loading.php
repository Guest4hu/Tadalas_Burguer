<?php

namespace App\Tadala\Core;


class Loading
{
    public static function add($file)
    {
        $html = file_get_contents(__DIR__ . "/../Views/templates/{$file}.php");
        // print_r(htmlspecialchars($html));

        $dom = new \DOMDocument();

        @$dom->loadHTML($html);

        $title = $dom->getElementById('titulo');

        echo $title->textContent;
        exit;
    }

    private static function getUrl()
    {
        $is_https = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');

        $scheme = $is_https ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $uri = $_SERVER['REQUEST_URI'] ?? '';

        return $scheme . '://' . $host . $uri;
    }
}
