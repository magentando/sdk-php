<?php

require_once '../intelipost.inc.php';


$req = new \Intelipost\IntelipostModel\quote();
$req->destination_zip_code = '95700-000';
$req->origin_zip_code = '95720-000';
$req->additional_information = new Intelipost\IntelipostModel\additional_information();

$volume = new \Intelipost\IntelipostModel\volume();
$volume->height = 10;
$volume->length = 10;
$volume->volume_type = "BOX";
$volume->weight = 1;
$volume->width = 10;



$req->AddVolume($volume);

$proxy = new \Intelipost\Intelipost();

$resEnvio = $proxy->GetCotacao()->CriarCotacaoPorVolume($req);
if ($resEnvio->isSuccess) {
    var_dump($resEnvio->GetResult());
} else {
    echo '<p>Falha</p>';
    echo "<p>$resEnvio->message</p>";
}