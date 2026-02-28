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
                'host' => $_ENV['DB_HOST'],
                'db_name' => $_ENV['DB_NAME'],
                'username' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
                'charset' => 'utf8',
                'port' =>  $_ENV['DB_PORT'],
              ),
            )
        ];
    }
  }