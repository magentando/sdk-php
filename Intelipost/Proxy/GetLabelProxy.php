<?php

namespace Intelipost\Proxy;

/**
 * @author Rogério Spina <rogerio.spina@intelipost.com.br>
 */
final class GetLabelProxy extends ProxyBase implements IGetLabel
{
    /**
     * @param string $shipment_order
     * @param string $shipment_volume_number
     * @return \Intelipost\Response\IntelipostGetLabelResponse
     */
    public function GetLabel($shipment_order, $shipment_volume_number) {
        $this->InitializeDefaultCurl();
        
        $this->_curl->SetCustomRequest("GET");
        $this->_curl->CreateCurl($this->_baseURL . "/shipment_order/get_label/$shipment_order/$shipment_volume_number");
        
        return new \Intelipost\Response\IntelipostCepAutoCompleteResponse($this->_curl->GetResult());                
    }

}
