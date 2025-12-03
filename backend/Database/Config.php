<?php

namespace App\Tadala\Database;

class Config
{
    public static function get()
    {
        return [
            'database' => array (
  'driver' => 'mysql',
  'mysql' => 
  array (
    'host' => 'localhost',
    'db_name' => 'tadala_atualizado',
    'username' => 'root',
    'password' => NULL,
    'charset' => 'utf8',
    'port' => NULL,
  ),
)
        ];
    }
}
