<?php

namespace Intelipost\IntelipostModel;

/**
 * @author Leonardo Volpatto <leovolpatto@gmail.com>
 */
final class quote {
    
    /**
     * @var int
     */      
    public $id;
    /**
     * @var int
     */
    public $client_id;
    /**
     * @var string
     */      
    public $origin_zip_code;
    /**
     * @var string
     */      
    public $destination_zip_code;
    /**
     * @var string
     */      
    public $created;
    /**
     * @var string
     */
    public $created_iso;
    /**
     * @var additional_information
     * @objectType Intelipost\IntelipostModel\additional_information
     */
    public $additional_information;
    /**
     * @var identification
     * @objectType Intelipost\IntelipostModel\identification
     */
    public $identification;    
    /**
     * @var DeliveryOption[]
     * @arrayOf Intelipost\IntelipostModel\DeliveryOption
     */
    public $delivery_options;
    /**
     * @var volumes[]
     * @arrayOf Intelipost\IntelipostModel\volume
     */
    public $volumes;
    public function __construct() {
    	$this->volumes = array();
    	$this->additional_information = new additional_information();
    	$this->identification = new identification();
    	$this->delivery_options[] = new delivery_option();
    }
    public function AddVolume(volume $volume)
    {
    	var_dump($volume);
    	array_push($this->volumes, $volume);
    }
}
