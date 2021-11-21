<?php

namespace Source\Http;

class Request 
{
    /**
     * Método da minha requisição para o server (GET,POST,PUT... etc)
     *
     * @var string
     */
    private $httpMethod;

    /**
     * URI da minha requisição
     *
     * @var string
     */
    private $URI;

    /**
     * Cabeçalho da requisição
     *
     * @var array
     */
    private $headers;

    /**
     * Construtor da classe
     */
    public function __construct()
    {        
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER["REQUEST_METHOD"];
        $this->URI = $_SERVER["REQUEST_URI"];
    }

    /**
     * Método responsável por retornar o método da requisição
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * Método responsável por retornar a URI da página
     *
     * @return string
     */
    public function getURI()
    {
        return $this->URI;
    }

    /**
     *  Método responsável por retornar o header da requisição
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

}