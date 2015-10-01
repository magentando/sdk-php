<?php

namespace Intelipost\Proxy\Arguments;

final class MarcarPedidosComoEnviadosArgs {
    
    /**
     * @var MarcarPedidoComoEnviadoArg[]
     */
    private $orders;
    
    public function __construct() {
        $this->orders = array();
    }
    
    public function Add($order_number, $eventDate)
    {
        array_push($this->orders, new MarcarPedidoComoEnviadoArg($order_number, $eventDate));
    }
    
    /**
     * @return MarcarPedidoComoEnviadoArg[]
     */
    public function GetOrders()
    {
        return $this->orders;
    }
    
}