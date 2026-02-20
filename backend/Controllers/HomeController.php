<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;

class HomeController
{
    public function index() {
        View::render('home/index');
    }
}