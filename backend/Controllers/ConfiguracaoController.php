<?php

namespace App\Tadala\Controllers;

use App\Tadala\Core\View;
use App\Tadala\Database\Database;
use App\Tadala\Models\Usuario;

class ConfiguracaoController
{
    // index
    public function index()
    {
        View::configuracao("configuracao/index");
        
    }
}
