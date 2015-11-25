<?php

require_once '../intelipost.inc.php';

$c = new \Intelipost\Intelipost();

$inicio2 = microtime(true);
var_dump($c->GetCotacao()->CotacaoContingencia('01433000',5,'100')->GetResult());
$total2 = microtime(true) - $inicio2;
echo 'Tempo: ' . ($total2);
