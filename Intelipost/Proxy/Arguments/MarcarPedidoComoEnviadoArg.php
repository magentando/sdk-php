<?php

namespace Intelipost\Proxy\Arguments;

/**
 * @author Leonardo Volpatto <leovolpatto@gmail.com>
 */
final class MarcarPedidoComoEnviadoArg {
    
    public $order_number;
    public $event_date;
    
    public function __construct($order_number, $eventDate) {
        $this->order_number = $order_number;
        $this->event_date = $eventDate;
    }
    
}
