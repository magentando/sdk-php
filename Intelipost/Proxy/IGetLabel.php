<?php

namespace Intelipost\Proxy;

/**
 * @author Rogério Spina <rogerio.spina@intelipost.com>
 */
interface IGetLabel {
    
    /**
     * @param string $shipment_order
     * @param string $shipment_volume_number
     * @return \Intelipost\Response\IntelipostGetLabelResponse
     */
    public function GetLabel($shipmen_order,$shipment_volume_number);
    
}
