<?php

require_once '../intelipost.inc.php';

$proxy = new \Intelipost\Intelipost();

$args = new Intelipost\Proxy\Arguments\MarcarPedidosComoEnviadosArgs();
$args->Add(1212, '2012-01-12');
$args->Add(1213, '2012-01-12');

$r = $proxy->GetPedido()->MarcarDiversosPedidosComoEnviado($args);
var_dump($r);