<?php

namespace Intelipost\Proxy;

/**
 * @author Leonardo Volpatto <leovolpatto@gmail.com>
 */
interface ICotacao {
    
    /**
     * @return \Intelipost\Response\IntelipostMetodosDeEnvioResponse
     */    
    public function ConsultarMetodosDeEnvio();
    
    /**
     * @param \Intelipost\IntelipostModel\quote_by_product $req
     * @return \Intelipost\Response\IntelipostCotacaoSemVolumeResponse
     * @throws \Intelipost\IntelipostCotacaoException
     */    
    public function CriarCotacaoPorProduto(\Intelipost\IntelipostModel\quote_by_product $req);
    
    /**
     * @param \Intelipost\IntelipostModel\quote $req
     * @return \Intelipost\Response\IntelipostCotacaoSemVolumeResponse
     * @throws \Intelipost\IntelipostCotacaoException
     */
    public function CriarCotacaoPorVolume(\Intelipost\IntelipostModel\quote $req);
    
    /**
     * @param int $idCotacaoIntelipost
     * @return \Intelipost\Response\IntelipostCotacaoSemVolumeResponse
     */    
    public function ConsultarUmaCotacao($idCotacaoIntelipost); 
    
    /**
     * @param Arguments\CalcularDataDeEntregaArgs $args
     * @return \Intelipost\Response\IntelipostCalcularDataEntregaResponse
     */
    public function CalcularDataDeEntrega(Arguments\CalcularDataDeEntregaArgs $args); 
    
    /**
     * @param Arguments\CalcularDataDeEntregaArgs $args
     * @return \Intelipost\Response\IntelipostCalcularDataEntregaResponse
     */
    public function CotacaoContingencia($cepDestino,$peso,$valorNotaFiscal);
    
}
