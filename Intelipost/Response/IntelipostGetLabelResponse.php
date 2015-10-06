<?php

namespace Intelipost\Response;

/**
 * @author Rogério Spina <rogerio.spina@intelipost.com.br>
 */
final class IntelipostGetLabelResponse extends IntelipostResponseBase {
    
    /**
     * @var \Intelipost\IntelipostModel\get_label
     */
    private $label;
    
    private function CreateTypedResponse()
    {
        $p = new \Intelipost\Utils\JSONParser();
        $this->label = $p->parseFromStdClass(new \Intelipost\IntelipostModel\get_label(), $this->resultObj);
    }
    
    protected function ProcessResponse() {
        parent::ProcessResponse();
        $this->CreateTypedResponse();
    }
    
    /**
     * @return \Intelipost\IntelipostModel\get_label
     */
    public function GetResult() {
        return $this->label;
    }    
}
