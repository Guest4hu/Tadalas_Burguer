<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;

class CardapioController {

    public function index() {
        View::render('cardapio/index',[],'cardapio');
    }
}