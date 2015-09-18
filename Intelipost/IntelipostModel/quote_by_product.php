<?php

namespace Intelipost\IntelipostModel;

/**
 * @author Leonardo Volpatto <leovolpatto@gmail.com>
 */
final class quote_by_product {

    public $id;
    public $created;
    /**
     * @arrayOf Intelipost\IntelipostModel\delivery_option
     * @var delivery_option[]
     */
    public $delivery_options;
     /**
     * @var string
     */
    public $origin_zip_code;
     /**
     * @var string
     */
    public $destination_zip_code;

    /**
     * @var identification
     * @objectType Intelipost\IntelipostModel\identification
     */
    public $identification;
    
    /**
     * @var product[]
     * @arrayOf Intelipost\IntelipostModel\product
     */
    public $products;

    /**
     * @var additional_information
     * @objectType Intelipost\IntelipostModel\additional_information
     */
    public $additional_information;
    
    public function __construct() {
        $this->products = array();
        $this->additional_information = new additional_information();
        $this->delivery_options = new delivery_option();
    }
    
    public function AddProduct(product $product)
    {
        array_push($this->products, $product);
    }

}
