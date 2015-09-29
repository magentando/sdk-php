<?php

namespace Intelipost\Proxy\Arguments;

final class CalcularDataDeEntregaArgs {
    
    /**
     * cep de origem
     * @var string
     */
    public $cep_origem;

    /**
     * cep de destino
     * @var string
     */    
    public $cep_destino;
    
    /**
     * dias úteis que serão utilizados para calcular a data
     * @var int
     */    
    public $dias_uteis;
    
    /**
     * Data base para cálculo. Caso não for informada, a data base será considerada a data atual. (Y-m-d)
     * @var string
     */    
    public $date;
    
}
