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
    private $username = null;
    private $password = null;

    /**
     * @param null $password
     * @param null $username
     */
    public function __construct($password = null, $username = null)
    {
        $this->password = $password;
        $this->username = $username;
    }

    /**
     * @param Intelipost_Model_Request $data
     * @return float
     */
    public function calculateShippingCost(Intelipost_Model_Request $data)
    {
        $bestOption = null;

        try {
            $apiUrl = "http://api.intelipost.com.br/api/v1/";
            $apiKey = "c13eff81b133865319635d77edd76713b0d8aea4c959d7b38397a28a6d222a67";
            $entityAction = "quote";
            $request = json_encode($data);

            $response = $this->intelipostRequest($apiUrl, $apiKey, $entityAction, $request);

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

}