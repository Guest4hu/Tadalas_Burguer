<?php

require_once  __DIR__.'/../Database/Databases.php';
require_once  __DIR__.'/../Models/Agendamentos.php';

$testeAgendamento = new Agendamentos($db);


// Selecionar todos os Agendamentos
// var_dump($testeAgendamento->BuscarAgendamento());

// Selecionar os Agendamentos por ID
var_dump($testeAgendamento->BuscarAgendamentoPorid(1));


// Adicionar um agendamento 
// var_dump($testeAgendamento->InserirAgendamento('2023-10-01 10:00:00', '2023-10-01 12:00:00', 1, 3));

// Excluir um Agendamento
// var_dump($testeAgendamento->DeletarAgendamento(4));