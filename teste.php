<?php

class Cachorro {
    public $nome;
}

$cachorro1 = new Cachorro();
$cachorro2 = new Cachorro();

$cachorro1->nome = 'Toddy';
var_dump($cachorro1->nome);
var_dump($cachorro2->nome);
$cachorro2->nome = 'Laica';
var_dump($cachorro1->nome);
var_dump($cachorro2->nome);
