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
            $body = json_encode($data);
            $s = curl_init();
            curl_setopt($s, CURLOPT_TIMEOUT, 5000);
            curl_setopt($s, CURLOPT_URL, "http://api-testing.e-sprinter.com.br/api/v1/quote");
            if ($this->username != null && $this->password != null) {
                curl_setopt($s, CURLOPT_USERPWD, $this->username . ":" . $this->password);
            }
            curl_setopt($s, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
            curl_setopt($s, CURLOPT_POST, true);
            curl_setopt($s, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($s, CURLOPT_POSTFIELDS, $body);
            $responseBody = curl_exec($s);

            $response = json_decode($responseBody);
            curl_close($s);

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

}