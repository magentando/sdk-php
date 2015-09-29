<?php
namespace Intelipost\Response;
use Intelipost\Utils\JSONParser;

/**
 * @author Rogério Magalhães Spina <rogerio.spina@intelipost.com.br>
 */
final class IntelipostWebhook {	
    protected $resultObj;
    
    /**
     * @var boolean
     */
    public $isSuccess = false;
   
    public function __construct($apiResult) {
        $this->apiResult = $apiResult;
    }
     
    public function getStatus(){
    	$parse = new JSONParser();
    	$obj = json_decode($this->apiResult);
    	
    	if(!$obj || strlen($obj->order_number) <= 0){
    		http_response_code(400);
    		exit;
    	}
    	
    	$this->isSuccess = true;
    	$this->resultObj = $obj;
    	http_response_code(200);
    	return $parse->parseFromStdClass(null,$obj);    	
    }    
    
}