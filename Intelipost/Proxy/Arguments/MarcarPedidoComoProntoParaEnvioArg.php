<?php

namespace Intelipost\Proxy\Arguments;

final class MarcarPedidoComoProntoParaEnvioArg {
    
    public $order_number;
    public $event_date;
    
    public function __construct($order_number, $event_date) {
        $this->event_date = $event_date;
        $this->order_number = $order_number;
    }
    
}
