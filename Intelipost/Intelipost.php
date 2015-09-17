<?php

namespace Intelipost;

/**
 * @author Leonardo Volpatto <leovolpatto@gmail.com>
 */
final class Intelipost {
    /**
     * @var Proxy\ICEP
     */
    private $cepProxy;
    /**
     * @var Proxy\ICotacao
     */
    private $cotacaoProxy;
    /**
     * @var Proxy\IPedidoDeEnvio
     */
    private $pedidoProxy;
    /**
     * @var Proxy\IRastreamento
     */
    private $rastreamentoProxy;    
    /**
     * @var Proxy\IGetLabel
     */
    private $labelProxy;
    
    public function __construct() {
        $this->InitializeProxies();
    }
    
    private function InitializeProxies()
    {
        $this->cepProxy = new Proxy\CepProxy();
        $this->cotacaoProxy = new Proxy\CotacaoProxy();
        $this->pedidoProxy = new Proxy\PedidoProxy();
        $this->rastreamentoProxy = new Proxy\RastreamentoProxy(); 
        $this->labelProxy = new Proxy\GetLabelProxy();
    }
    
    /**
     * @return Proxy\ICEP
     */
    public function GetCEP()
    {
        return $this->cepProxy;
    }
    
    /**
     * @return Proxy\ICotacao
     */
    public function GetCotacao()
    {
        return $this->cotacaoProxy;
    }
    
    /**
     * @return Proxy\IPedidoDeEnvio
     */
    public function GetPedido()
    {
        return $this->pedidoProxy;
    }
    
    /**
     * @return Proxy\IRastreamento
     */
    public function GetRastreamento()
    {
        return $this->rastreamentoProxy;
    }
    
    /**
     * @return Proxy\IGetLabel
     */
    public function GetLabel()
    {
    	return $this->labelProxy;
    }
    
}
