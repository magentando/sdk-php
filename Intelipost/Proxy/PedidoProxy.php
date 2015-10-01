<?php

namespace Intelipost\Proxy;

use Intelipost\Response;
use Intelipost\IntelipostModel;

/**
 * @author Leonardo Volpatto <leovolpatto@gmail.com>
 */
final class PedidoProxy extends ProxyBase implements IPedidoDeEnvio {
    
    public function __construct() {
        $this->InitializeDefaultCurl();
    }
    
    /**
     * @param int $numeroDoPedido
     * @return \Intelipost\Response\IntelipostCancelamentoPedidoResponse
     */
    public function CancelarPedidoDeEnvio($numeroDoPedido) {
        $this->_curl->SetIncludeHeader(false);
        $this->_curl->SetCustomRequest("POST");
        
        $rq = array();
        $rq['order_number'] = $numeroDoPedido;
        $this->_curl->SetPost(json_encode($rq));
        $this->_curl->CreateCurl($this->_baseURL . "/shipment_order/cancel_shipment_order");
        
        $res = $this->_curl->GetResult();
        return new Response\IntelipostCancelamentoPedidoResponse($res);        
    }

    /**
     * @param int $numeroDoPedido
     * @return \Intelipost\Response\IntelipostCancelamentoPedidoResponse
     */
    public function ConsultarPedidoDeEnvio($numeroDoPedido) {
        $this->_curl->SetIncludeHeader(false);
        $this->_curl->SetCustomRequest("GET");        
        $this->_curl->CreateCurl($this->_baseURL . "/shipment_order/$numeroDoPedido");
        
        return new Response\IntelipostConsultaPedidoResponse($this->_curl->GetResult());        
    }

    /**
     * @param \Intelipost\IntelipostModel\shipment_order $shipment_order
     * @return \Intelipost\Response\IntelipostEnvioPedidoResponse
     * @throws \Intelipost\IntelipostEnvioPedidoException
     */
    public function CriarPedidoDeEnvio(IntelipostModel\shipment_order $shipment_order) {
        $this->_curl->SetIncludeHeader(false);
        $this->_curl->SetCustomRequest("POST");
        
        $json = json_encode($shipment_order);
        
        if(json_last_error() > 0)
            throw new \Intelipost\IntelipostEnvioPedidoException("json encode error", $shipment_order);
        
        $this->_curl->SetPost($json);
        $this->_curl->CreateCurl($this->_baseURL . "/shipment_order");
        $res = $this->_curl->GetResult();
        return new Response\IntelipostEnvioPedidoResponse($res);        
    }

    /**
     * @param \Intelipost\Proxy\Arguments\MarcarPedidoComoEnviadoArg $arg
     * @return \Intelipost\Response\IntelipostPedidoMarcadoComoEnviadoResponse
     */
    public function MarcarPedidoComoEnviado(Arguments\MarcarPedidoComoEnviadoArg $arg) {
        $this->_curl->SetIncludeHeader(false);
        $this->_curl->SetCustomRequest("POST");
        
        $this->_curl->SetPost(json_encode($arg));
        $this->_curl->CreateCurl($this->_baseURL . "/shipment_order/shipped");
        
        $res = $this->_curl->GetResult();
        return new Response\IntelipostPedidoMarcadoComoEnviadoResponse($res);        
    }

    /**
     * @param \Intelipost\Proxy\Arguments\MarcarPedidosComoEnviadosArgs $args
     * @return \Intelipost\Response\IntelipostPedidoMarcadoComoEnviadoResponse
     */
    public function MarcarDiversosPedidosComoEnviado(Arguments\MarcarPedidosComoEnviadosArgs $args) {
        $this->_curl->SetIncludeHeader(false);
        $this->_curl->SetCustomRequest("POST");
        
        $this->_curl->SetPost(json_encode($args->GetOrders()));
        $this->_curl->CreateCurl($this->_baseURL . "/shipment_order/multi/shipped/with_date");
                
        $res = $this->_curl->GetResult();
        return new Response\IntelipostPedidoMarcadoComoEnviadoResponse($res);        
    }

    /**
     * @param \Intelipost\Proxy\Arguments\MarcarPedidoComoProntoParaEnvioArg $arg
     * @return \Intelipost\Response\IntelipostPedidoMarcadoComoProntoResponse
     */
    public function MarcarPedidoComoProntoParaEnvio(Arguments\MarcarPedidoComoProntoParaEnvioArg $arg) {        
        $this->_curl->SetIncludeHeader(false);
        $this->_curl->SetCustomRequest("POST");
        
        $this->_curl->SetPost(json_encode($arg));
        $this->_curl->CreateCurl($this->_baseURL . "/shipment_order/ready_for_shipment");
        
        $res = $this->_curl->GetResult();
        return new Response\IntelipostPedidoMarcadoComoProntoResponse($res);        
    }

    /**
     * @param \Intelipost\Proxy\Arguments\MarcarPedidosComoProntoParaEnvioArgs $args
     * @return \Intelipost\Response\IntelipostPedidoMarcadoComoProntoResponse
     */
    public function MarcarDiversosPedidosParaProntoParaEnvio(Arguments\MarcarPedidosComoProntoParaEnvioArgs $args) {
        $this->_curl->SetIncludeHeader(false);
        $this->_curl->SetCustomRequest("POST");
        
        $payload = json_encode($args->GetOrders());
        $this->_curl->SetPost($payload);
        $this->_curl->CreateCurl($this->_baseURL . "/shipment_order/multi/ready_for_shipment/with_date");
        
        $res = $this->_curl->GetResult();
        return new Response\IntelipostPedidoMarcadoComoProntoResponse($res);
    }    
    
    public function AtualizarDadosDeRastreamento() {
        throw new \Exception('Not implemented yet');
    }

    public function AtualizarNotasFiscais() {
        throw new \Exception('Not implemented yet');        
    }

    public function AtualizarVolumesDeUmPedido() {
        throw new \Exception('Not implemented yet');
    }    
    
    public function ConsultarDadosDoDestinatario() {
        throw new \Exception('Not implemented yet');
    }

    public function ConsultarEtiquetas() {
        throw new \Exception('Not implemented yet');
    }

    public function ConsultarNotasFiscais() {
        throw new \Exception('Not implemented yet');
    }    
    
    public function ImpressaoDasEtiquetas() {
        throw new \Exception('Not implemented yet');
    }
    
    public function ConsultarStatus() {
        throw new \Exception('Not implemented yet');
    }

    public function ConsultarVolumesCaixas() {
        throw new \Exception('Not implemented yet');
    }
    public function RecebimentoStatus($json) {
		$obj = new \Intelipost\Response\IntelipostWebhook($json);
		return $obj->getStatus();
    }
}
