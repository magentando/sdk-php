<?php

namespace Intelipost\IntelipostModel;

/**
 * @author Leonardo Volpatto <leovolpatto@gmail.com>
 */
final class additional_information {

    /**
     * @var boolean
     */    
    public $free_shipping = false;
    /**
     * @var float
     */    
    public $extra_cost_absolute;
    /**
     * @var float
     */    
    public $extra_cost_percentage;
    /**
     * @var int
     */    
    public $lead_time_business_days;
    /**
     * @var int
     */    
    public $tax_id;
    /**
     * @var int[]
     */    
    public $delivery_method_ids;
    /**
     * @var string
     */    
    public $client_type;
    /**
     * @var string
     */    
    public $sales_channel;
        
    public function __construct() {
        $this->delivery_method_ids = array();
    }

}
