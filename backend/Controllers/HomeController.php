<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Controllers\AuthenticatedController;

class HomeController extends AuthenticatedController
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        View::render('home/index', [], 'home');
    }
}