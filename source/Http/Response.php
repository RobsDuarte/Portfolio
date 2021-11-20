<?php

namespace Source\Http;

class Response 
{
    /**
     * Código  do STATUS da HTTP da response (200 é o OK, The request has succeeded)
     *
     * @var integer
     */
    private $httpCode = 200;

    /**
     * Cabeçalho do response
     *
     * @var array
     */
    private $headers = [];

    /**
     * Tipo de conteúdo que está sendo retornado pelo Response
     *
     * @var string
     */
    private $contentType = "text/html";

    /**
     * Contéudo que o Response retornará
     *
     * @var mixed
     */
    private $content;

    /**
     * Construtor da classe
     *
     * @param integer $httpCode
     * @param mixed $content
     * @param string $contentType
     */

    public function __construct($httpCode,$content,$contentType="text/html")
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);        
    }

    /**
     * Método responsável por alterar o content type
     *
     * @param string $contentType
     * 
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader("Content-Type",$contentType);
    }

    /**
     * Método responsável por  adicionar um registro no cabeçalho do response
     *
     * @param string $key
     * @param string $value
     * 
     */
    public function addHeader($key,$value)
    {
       
        $this->header[$key] = $value;
    }

    /**
     * Métodod responsável por enviar o header para o navegador
     *
    */
    private function sendHeaders()
    {
        http_response_code($this->httpCode);
        foreach($this->headers as $key => $value)
        {
            header($key.':'.$value);
        }
    }

    /**
     * Método resonsável por enviar a resposta da requisição
     *
     * @return mixed
     */
    public function sendResponse()
    {
        $this->sendHeaders();
        switch($this->contentType)
        {
            case 'text/html':
                    return $this->content;
        }
    }
}