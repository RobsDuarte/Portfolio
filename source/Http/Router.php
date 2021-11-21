<?php

namespace Source\Http;

use \Exception;
use \Closure;

class Router 
{
    /**
     * URL da página
     *
     * @var string
     */
    private $URL;

    /**
     * Prefixo  de todas as páginas. Todas rotas tem em comum, geralmente é o / , ex: www.dominio.com/
     *
     * @var string
     */
    private $prefix;

   /**
    * Instância da classe request
    *
    * @var Request
    */
    private $request;

    /**
     * Indice de rotas
     *
     * @var array
     */
    private $routes = [];

    /**
     * construtor da classe Router
     *
     * @param string $URL
     */
    public function __construct($URL)
    {
        $this->URL = $URL;
        $this->request = new Request();
        $this->setPrefix();
    }

    /**
     * Método responsável por definir o prefixo das rotas
     *     
     */

    private function setPrefix()
    {
        $this->prefix = parse_url($this->URL,PHP_URL_PATH);        
    }

    /**
     * Método responsável por  adicionar rotas a coleção 
     *
     * @param string $method
     * @param string $route
     * @param array $params
     * 
     */
    private function addRoute($method,$route,$params)
    {
        foreach($params as $key=>$callback)
        {   
            if($callback instanceof Closure)
            {
                $params['controller'] = $callback;
                unset($params[$key]);
            }            
        }
        $this->addPatternRoute($route,$method,$params);
    }

    /**
     * Método responsável por adicionar o padrão das rotas
     *
     * @param string $route
     * @param string $method
     * @param array $params
     * 
     */
    private function addPatternRoute($route,$method,$params)
    {
        $patternRoute = '/^'.str_replace('/','\/',$route).'$/';
        $this->routes[$patternRoute][$method] = $params;
    }

    /**
     * Método responsável por adicionar uma rota de get
     *
     * @param string $route
     * @param array $callback     
     */
    public function get($route,$callback)
    {
        $this->addRoute('GET',$route,$callback);
    }

    /**
     * Método responsável por recortar o prefixo único da URI. Ex: www.dominio.com/home irá retornar /home
     *
     * @return string
     */
    private function getPrefix()
    {        
        $URI = $this->request->getURI();
        $URI_prefix = explode($this->prefix,$URI);             
        return end($URI_prefix);
    }

    /**
     * Método responsável por retornar a rota pedida por request
     *
     * @return array
     */
    private function getRoute()
    {
        $prefix = $this->getPrefix();
        $http_method = $this->request->getHttpMethod();
        
        foreach($this->routes as $patternRoute=>$method)
        {                 
            if(preg_match($patternRoute,$prefix))
            {          
                if(isset($method[$http_method]))
                {                               
                    return $method[$http_method];                 
                }
                throw new Exception("Método não permitido",405);
            }
            throw new Exception("URL não encontrada",404);
        }
    }

    public function run()
    {
        try{
            $route = $this->getRoute();
            
            if(!isset($route['controller']))
            {
                throw new Exception("URL não pode ser processada!",500);
            }            
            return call_user_func($route["controller"]);
        }
        catch(Exception $e)
        {
            return new Response($e->getCode(),$e->getMessage());
        }
    }
}