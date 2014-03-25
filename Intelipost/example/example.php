<?php
/**
 * @author Intelipost (it@intelipost.com.br)
 *
 */

require_once 'spoon.php';

$volume = new Intelipost_Model_Volume();
$volume->weight = 10;
$volume->volume_type = Intelipost_Settings::INTELIPOST_VOLUME_BOX;
$volume->cost_of_goods = "10";
$volume->width = Intelipost_Settings::INTELIPOST_DEFAULT_WIDTH;
$volume->height = Intelipost_Settings::INTELIPOST_DEFAULT_HEIGHT;
$volume->length = Intelipost_Settings::INTELIPOST_DEFAULT_LENGTH;

$request = new Intelipost_Model_Request();
$request->origin_zip_code = "01001-100";
$request->destination_zip_code = "04037-002";
array_push($request->volumes, $volume);

$intelipost = new Intelipost("inteli", "post");

echo "Result:\n";
var_dump($intelipost->calculateShippingCost($request));
