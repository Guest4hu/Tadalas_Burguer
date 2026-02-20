<?php

namespace App\Tadala\Core;

class History
{
    public static function track() {
        $session = new Session();

        $currentUri = $_SERVER['REQUEST_URI'];

        $session->set('history', $currentUri);
    }

    public static function getLast() {
        $session = new Session();

        $last = $session->get('history');
        print_r($last);
        exit;

        unset($_SESSION['history']);

        return $last;
    }

}
