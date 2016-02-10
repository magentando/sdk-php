<?php

namespace Intelipost\IntelipostModel;

/**
 * @author Leonardo Volpatto <leovolpatto@gmail.com>
 */
final class shipment_order {

    const SHIPMENT_ORDER_TYPE_NORMAL = "NORMAL";
    const SHIPMENT_ORDER_TYPE_RESEND = "RESEND";
    
    public $id;
    public $quote_id;
    public $delivery_method_id;
    /**
     * @var end_customer
     */
    public $end_customer;
    /**
     * @var shipment_order_volume_array
     */
    public $shipment_order_volume_array;
    public $order_number;
    public $estimated_delivery_date;
    public $provider_shipping_costs;
    public $customer_shipping_costs;    
    public $estimated_delivery_date_lp;
    public $shipped_date;
    public $created;
    public $modified;    
    public $shipment_order_volume_state;
    public $shipment_order_type;
    public $parent_shipment_order_number;
    public $delivered_date;
    public $event_date;
    public $sales_channel;
    public $origin_zip_code;
}
