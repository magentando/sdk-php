<?php
/**
 * @author Intelipost (it@intelipost.com.br)
 *
 */

// $apiUrl = "https://api.intelipost.com.br/api/v1/";
// $apiKey = "d0a3b5f355e17333de5c9a15d665f3d7724b4246540012d5eb851a82db1b95a5";
// require_once ('vendor/autoload.php');

require_once ('spoon.php');

if (!isset($apiUrl)) {
    $apiUrl = Intelipost_Settings::API_URL;
}

if (!isset($apiKey)) {
    $apiKey = Intelipost_Settings::API_KEY;
}

$intelipost = new Intelipost($apiUrl, $apiKey);

$volume1 = new Intelipost_Model_Volume();
$volume1->weight = 10;
$volume1->volume_type = "BOX";
$volume1->cost_of_goods = "10";
$volume1->width = 10;
$volume1->height = 10;
$volume1->length = 10;

$volume2 = new Intelipost_Model_Volume();
$volume2->weight = 20;
$volume2->volume_type = "ENVELOPE";
$volume2->cost_of_goods = "100";
$volume2->width = 20;
$volume2->height = 20;
$volume2->length = 20;

$request = new Intelipost_Model_Request();
$request->origin_zip_code = '04030-002';
$request->destination_zip_code = '04037-002';
$request->volumes = array($volume1, $volume2);

// shipping cost
$cost = $intelipost->calculateShippingCost($request);
echo "COST: $cost\n";

// estimated days
$days = $intelipost->getEstimatedDaysForDelivery();
echo "DAYS: $days\n";

// insurance
$insurance = $intelipost->getShippingInsuranceAmount();
echo "INSURANCE: $insurance\n";
