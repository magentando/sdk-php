<?php

require_once '../intelipost.inc.php';

$intelipost = new Intelipost\Intelipost();

$args = new \Intelipost\Proxy\Arguments\CalcularDataDeEntregaArgs();
$args->cep_destino = '95700000';
$args->cep_origem = '95720000';
$args->dias_uteis = 3;

$result  = $intelipost->GetCotacao()->CalcularDataDeEntrega($args);

var_dump($result->GetResult());