<?php

namespace Intelipost\IntelipostModel;

/**
 * @author Leonardo Volpatto <leovolpatto@gmail.com>
 */
final class shipment_order_volume_array {
    
    public $shipment_order_volume_state;
    public $shipment_order_volume_number;
    public $weight;
    public $volume_type_code;
    public $width;
    public $height;
    public $length;
    public $products_nature;
    public $products_quantity;
    public $is_icms_exempt;
    public $tracking_code;
    public $created;
    public $modified;
    public $estimated_delivery_date_lp;
    public $pre_shipment_list_state;
    public $has_clarify_delivery_fail;
    public $delivered_late;
    public $delivered_late_lp;
    public $estimated_delivery_date;
    public $delivered;
    public $pre_shipment_list_id;
    public $logistic_provider_pre_shipment_list_id;
    public $name;
    public $shipped_date;
    public $delivered_date;
    public $shipment_order_volume_id;
    public $shipment_order_volume_state_history_array;        
    /**
     * @var shipment_order_volume_invoice
     */
    public $shipment_order_volume_invoice;

}
