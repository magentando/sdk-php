<?php
/**
 * @author Intelipost (it@intelipost.com.br)
 *
 */

class Intelipost
{
    private $apiUrl = null;
    private $apiKey = null;
    private $logging = false;

    /**
     * @param $api_url
     * @param $api_key
     * @param bool $logging
     */
    public function __construct($api_url, $api_key, $logging=false)
    {
        $this->apiUrl = $api_url;
        $this->apiKey = $api_key;
        $this->logging = $logging;
    }

    /**
     * @param Intelipost_Model_Request $request
     * @return mixed|string
     */
    public function quote(Intelipost_Model_Request $request)
    {
        try {
            $entityAction = "quote";

            $request = json_encode($request);

            if ($this->logging) {
                $this->localLog(date('Y-m-d H:i:s')." REQUEST\n".$request."\n\n");
            }

            $response = $this->intelipostRequest($this->apiUrl, $this->apiKey, $entityAction, $request);

            if ($this->logging) {
                $this->localLog(date('Y-m-d H:i:s')." RESPONSE\n".$response."\n\n");
            }

        } catch (Exception $e) {
            $response = json_encode(array('status' => 'KO'));

        }

        return $response;

    }

    /**
     * @return int
     */
    public function getEstimatedDaysForDelivery()
    {
        if (is_null($this->estimatedDaysForDelivery)) {
            return Intelipost_Settings::INTELIPOST_DEFAULT_ESTIMATED_DELIVERY;
        } else {
            return $this->estimatedDaysForDelivery;
        }
    }

    /**
     * @return int
     */
    public function getShippingInsuranceAmount()
    {
        return Intelipost_Settings::INTELIPOST_DEFAULT_INSURANCE;
    }

    /**
     * @param $api_url
     * @param $api_key
     * @param bool $body
     * @return mixed
     */
    private function intelipostRequest($api_url, $api_key, $entity_action, $request=false)
    {
        $s = curl_init();

        curl_setopt($s, CURLOPT_TIMEOUT, 5000);
        curl_setopt($s, CURLOPT_URL, $api_url.$entity_action);
        curl_setopt($s, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json", "api_key: $api_key"));
        curl_setopt($s, CURLOPT_POST, true);
        curl_setopt($s, CURLOPT_ENCODING , "");
        curl_setopt($s, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($s, CURLOPT_POSTFIELDS, $request);

        $response = curl_exec($s);

        curl_close($s);

        return $response;
    }

    private function localLog($message)
    {
        // using the FILE_APPEND flag to append the content to the end of the file
        // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
        file_put_contents("intelipost.log", $message, FILE_APPEND | LOCK_EX);
    }
}