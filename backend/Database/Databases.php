<?php
//documentação php
//https://www.php.net/manual/en/ref.pdo-mysql.connection.php
namespace Database;

$username = 'root';
$password = '';
$host = 'localhost';
$dbname = 'tadala';
            //teste puro "texto" preciso concatenar variaveis com .
try{
$db = new \PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8mb4', $username, $password, array(
 
    \PDO::ATTR_EMULATE_PREPARES => false,
 
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
 
));
}catch(\PDOEXxception $e){
    throw new  \PDOException($e->getMessage());
}