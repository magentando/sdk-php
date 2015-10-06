<?php

namespace Intelipost\Proxy\Arguments;

final class MarcarPedidosComoProntoParaEnvioArgs {
    
    /**
     * @var MarcarPedidoComoProntoParaEnvioArg[]
     */
    private $orders;
    
    public function __construct() {
        $this->orders = array();
    }
    
    public function Add($order_number, $event_date)
    {
        array_push($this->orders, new MarcarPedidoComoProntoParaEnvioArg($order_number, $event_date));
    }
    
    /**
     * @return MarcarPedidoComoProntoParaEnvioArg[]
     */
    public function GetOrders()
    {
        return $this->orders;
    }
    
}
