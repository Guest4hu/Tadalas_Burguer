<?php

namespace App\Tadala\Http;

class Request {
    public static function body() {
        $json = json_decode(file_get_contents('php://input'), true) ?? [];

        return $json;
    }
}