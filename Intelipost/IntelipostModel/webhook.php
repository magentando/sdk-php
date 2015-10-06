<?php

namespace Intelipost\IntelipostModel;

/**
 * @author Rogério Spina <rogerio.spina@intelipost.com.br>
 */
final class webhook {    
    /**
     * @var string
     */      
    public $order_number;
    /**
     * @var string
     */
    public $tracking_code;
    /**
     * @var string
     */      
    public $volume_number;
    /**
     * @var shipment_order_volume_invoice
     */
    public $invoice;
    /**
     * @var history
     * @objectType Intelipost\IntelipostModel\webhook_history
     */
    public $history;
    
    public function __construct() {
    	//$this->invoice = new shipment_order_volume_invoice();
    	$this->history = new webhook_history();
    }
}
