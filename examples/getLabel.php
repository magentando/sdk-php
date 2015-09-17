<?php

require_once '../intelipost.inc.php';

$c = new \Intelipost\Intelipost();
$x = $c->GetLabel()->GetLabel("pd00100", "1");

var_dump($x->GetResult());