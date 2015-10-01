<?php

namespace Intelipost\Proxy;

/**
 * @author Leonardo Volpatto <leovolpatto@gmail.com>
 */
interface IPedidoDeEnvio {
    
    /**
     * @param \Intelipost\IntelipostModel\shipment_order $shipment_order
     * @return \Intelipost\Response\IntelipostEnvioPedidoResponse
     * @throws \Intelipost\IntelipostEnvioPedidoException
     */    
    public function CriarPedidoDeEnvio(\Intelipost\IntelipostModel\shipment_order $shipment_order);
    
    /**
     * @param int $numeroDoPedido
     * @return \Intelipost\Response\IntelipostCancelamentoPedidoResponse
     */    
    public function ConsultarPedidoDeEnvio($numeroDoPedido);
    
    /**
     * @param int $numeroDoPedido
     * @return \Intelipost\Proxy\Response\IntelipostCancelamentoPedidoResponse
     */    
    public function CancelarPedidoDeEnvio($numeroDoPedido);

    /**
     * @return \Intelipost\Proxy\Response\IntelipostPedidoMarcadoComoProntoResponse
     * @param \Intelipost\Proxy\Arguments\MarcarPedidoComoProntoParaEnvioArg $arg
     */
    public function MarcarPedidoComoProntoParaEnvio(Arguments\MarcarPedidoComoProntoParaEnvioArg $arg);

    /**
     * @return \Intelipost\Proxy\Response\IntelipostPedidoMarcadoComoEnviadoResponse
     * @param \Intelipost\Proxy\Arguments\MarcarPedidoComoEnviadoArg $args
     */
    public function MarcarPedidoComoEnviado(Arguments\MarcarPedidoComoEnviadoArg $args);

    /**
     * @param Arguments\MarcarPedidosComoEnviadosArgs $args
     * @return \Intelipost\Proxy\Response\IntelipostPedidoMarcadoComoEnviadoResponse
     */    
    public function MarcarDiversosPedidosComoEnviado(Arguments\MarcarPedidosComoEnviadosArgs $args);
    
    /**
     * @param \Intelipost\Proxy\Arguments\MarcarPedidosComoProntoParaEnvioArgs $args
     * @return \Intelipost\Proxy\Response\IntelipostPedidoMarcadoComoProntoResponse[]
     */
    public function MarcarDiversosPedidosParaProntoParaEnvio(Arguments\MarcarPedidosComoProntoParaEnvioArgs $args);
        
    public function ImpressaoDasEtiquetas();
    
    public function ConsultarDadosDoDestinatario();
    
    public function ConsultarNotasFiscais();
    
    public function ConsultarEtiquetas();
    
    public function ConsultarVolumesCaixas();
    
    public function ConsultarStatus();
    
    public function AtualizarNotasFiscais();
    
    public function AtualizarDadosDeRastreamento();
    
    public function AtualizarVolumesDeUmPedido();    
    
    public function RecebimentoStatus($json);
}
