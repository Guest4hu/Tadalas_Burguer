<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;

class CarrinhoController {

    public function index() {
        View::render('carrinho/index');
    }
}