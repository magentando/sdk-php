<?php
/**
 * @author Intelipost (it@intelipost.com.br)
 *
 */

class Intelipost
{
    /**
     * @var int
     */
    protected $estimatedDaysForDelivery = null;

    private $apiUrl = null;
    private $apiKey = null;
    private $logging = false;

    /**
     * @param null $password
     * @param null $username
     */
    public function __construct($api_url, $api_key, $logging=false)
    {
        $this->apiUrl = $api_url;
        $this->apiKey = $api_key;
        $this->logging = $logging;
    }

    /**
     * @param Intelipost_Model_Request $data
     * @return float
     */
    public function calculateShippingCost(Intelipost_Model_Request $data)
    {
        $bestOption = null;

        try {
            $entityAction = "quote";
            $request = json_encode($data);

            if ($this->logging) {
                $this->localLog(date('Y-m-d H:i:s')." REQUEST\n".$request."\n");
            }

            $response = $this->intelipostRequest($this->apiUrl, $this->apiKey, $entityAction, $request);
            if ($this->logging) {
                $this->localLog(date('Y-m-d H:i:s')." RESPONSE\n".$response."\n");
            }

            $response = json_decode($response);

            if (isset($response->status)) {
                if ($response->status != 'ERROR') {
                    if (count($response->content->delivery_options) > 0)
                        $bestOption = array_shift($response->content->delivery_options);
                    foreach ($response->content->delivery_options as $option) {
                        if ($option->final_shipping_cost < $bestOption->final_shipping_cost)
                            $bestOption = $option;
                    }
                }
            }
        } catch (Exception $e) {
            $bestOption = null;
        }

        if (is_null($bestOption)) {
            $minPrice = null;
        } else {
            $minPrice = $bestOption->final_shipping_cost;
            $this->estimatedDaysForDelivery = $bestOption->delivery_estimate_business_days;
        }

        return $minPrice;
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