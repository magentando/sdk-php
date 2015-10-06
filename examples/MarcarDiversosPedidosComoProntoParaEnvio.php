<?php

require_once '../intelipost.inc.php';

$proxy = new \Intelipost\Intelipost();

$args = new Intelipost\Proxy\Arguments\MarcarPedidosComoProntoParaEnvioArgs();
$args->Add(1212, '2012-01-12');
$args->Add(1213, '2012-01-12');

$r = $proxy->GetPedido()->MarcarDiversosPedidosParaProntoParaEnvio($args);
var_dump($r);