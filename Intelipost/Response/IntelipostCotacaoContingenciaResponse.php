<?php

namespace Intelipost\Response;
use Intelipost\Response\IntelipostResponseBase;
use Intelipost\IntelipostModel\business_days;
use Intelipost\IntelipostModel\CotacaoContingencia;
use Intelipost\IntelipostModel\cotacao_contingencia;
use Intelipost\IntelipostModel\delivery_method_fallback;

final class IntelipostCotacaoContingenciaResponse extends IntelipostResponseBase {
        
    private $json;
    private $cepDestino;
    private $peso;
    private $valorNotaFiscal;
    private $finalShippingCost;
    private $deliveryEstimateBusinessDays;
	    
    public function __construct($cepDestino, $peso, $valorNotaFiscal) {
    	$this->peso = $peso*1000;
    	$this->cepDestino = $cepDestino;
    	$this->valorNotaFiscal = $valorNotaFiscal;
    }
    
    
    private function CreateTypedResponse()
    {
        $p = new \Intelipost\Utils\JSONParser();
        $this->business_days = $p->parseFromStdClass(new business_days(), $this->resultObj);
    }
    
    protected function ProcessResponse() {
        parent::ProcessResponse();
        $this->CreateTypedResponse();
    }
    
    private function Quote(){
    	$p = new \Intelipost\Utils\JSONParser();
    	$this->json = file_get_contents("C:/xampp/htdocs/sdk-php/Intelipost/Utils/contingencia.json");
    	$obj = json_decode(preg_replace('/\\s+/', '',utf8_encode($this->json)));   	
    	$option = $this->binarySearchQuote($obj, $this->peso, $this->cepDestino);
    	$deliveryOption = new delivery_method_fallback();
    	$deliveryOption->finalShippingCost = ((($this->valorNotaFiscal - 50)*$option->pricePercent)+$option->shipping_cost);
    	$deliveryOption->deliveryEstimateBusinessDays = $option->delivery_estimate_business_days;
    	return $deliveryOption;
    }   
    
	private function binarySearchQuote($obj, $peso, $cepDestino ){    	
    	$baixo = 0;
    	$alto = sizeof($obj->Content) - 1;
    	$i = 0;
    	while ($baixo <= $alto) {
    		$meio = floor(($baixo + $alto) / 2);
    		if ((int)$obj->Content[$meio]->start_zip_code <= (int)$this->cepDestino && (int)$obj->Content[$meio]->end_zip_code >= (int)$this->cepDestino && (int)$obj->Content[$meio]->start_weight <= (int)$this->peso && (int)$obj->Content[$meio]->end_weight>= (int)$this->peso) {
    			return $obj->Content[$meio];
    		} else {
    			if ((int)$this->cepDestino < (int)$obj->Content[$meio]->start_zip_code) {
    				$alto = $meio - 1;
    			} else if((int)$this->cepDestino <= (int)$obj->Content[$meio]->end_zip_code){
    				if((int)$this->peso < (int)$obj->Content[$meio]->start_weight){
    					$alto = $meio -1;
    				}else{
    					$baixo = $meio +1;
    				}
    			}
    			else{
    				$baixo = $meio + 1;
    			}
    		}
    		$i = $i + 1;
    	}    	
    }
    
    
    /**
     * @return \Intelipost\IntelipostModel\business_days;
     */
    public function GetResult() {
        
        return $this->Quote();

    }
    
}
