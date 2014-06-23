<?php
/**
 * @author Intelipost (it@intelipost.com.br)
 *
 */

date_default_timezone_set('UTC');

if (!function_exists('curl_init')) {
    throw new Exception('Intelipost needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
    throw new Exception('Intelipost needs the JSON PHP extension.');
}

require_once('../../Intelipost/model/Intelipost_Model_Volume.php');
require_once('../../Intelipost/model/Intelipost_Model_Request.php');
require_once('../../Intelipost/model/Intelipost_Model_Response.php');
require_once('../../Intelipost/base/Intelipost_Settings.php');
require_once('../../Intelipost/base/Intelipost.php');
