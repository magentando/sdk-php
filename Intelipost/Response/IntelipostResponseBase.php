<?php

namespace Intelipost\Response;

/**
 * @author Leonardo Volpatto <leovolpatto@gmail.com>
 */
abstract class IntelipostResponseBase {

    protected $apiResult;
    protected $resultObj;
    
    /**
     * @var boolean
     */
    public $isSuccess = false;
    /**
     * @var string
     */
    public $message = '';

    public function __construct($apiResult) {
        $this->apiResult = $apiResult;
        $this->ProcessResponse();
    }

    /**
     * @throws \Exception
     */
   protected function ProcessResponse() {

        $res = $this->apiResult;
        if (!$res) {
            $obj = json_decode($this->apiResult);
            
            $this->HandleResponseStatus($obj);
            if ($this->isSuccess)
                $this->resultObj = $obj->content;
            
        } else {

            $content = json_decode($res);
            if ($content == null)
                $content = json_decode($this->_curl->GetResult());

            $this->HandleResponseStatus($content);

            try {
                $c = $content->content;
            } catch (\Exception $exception) {
                throw new \Exception($exception->getMessage() . ' - Response: ' . $res);
            }
            if ($this->isSuccess)
                $this->resultObj = $c;
        }
    }
    
    /**
     * @param \stdClass $obj
     * @throws IntelipostResponseException
     */
    protected function HandleResponseStatus($obj)
    {
        if($obj == null)
            throw new IntelipostResponseException('A resposta não pode ser tratada', $this->apiResult);
        
        if(strtoupper($obj->status) == 'ERROR')
            $this->isSuccess = false;
        else if (strtoupper($obj->status) == 'OK')
            $this->isSuccess = true;
        else
            throw new IntelipostResponseException('O status da resposta não é reconhecido: ' . $obj->status, $this->apiResult);

        foreach ($obj->messages as $msg)
            $this->message .= " $msg->type - $msg->text - $msg->key ";
    }


    public function GetResult()
    {
        return $this->resultObj;
    }
    
}
