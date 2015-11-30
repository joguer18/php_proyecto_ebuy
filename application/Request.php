<?php

/*
 * -------------------------------------
 * 
 * Request.php
 * -------------------------------------
 */


class Request
{
    private $_controlador;
    private $_metodo;
    private $_argumentos;
    private $_comodin;
    
    public function __construct() {
        if(isset($_GET['url'])){
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL); //  
            $url = explode('/', $url);
            $url = array_filter($url);  // elimina los elementos vacios
            
         
          
            //Condicional para cuando queremos que la palabra backend indique al administrador y no al controlador backend
            if($url[0]=='backend'){
              $comodin = $url[0];
               $url_comodin = array_shift($url);
            }elseif ($url[0]=='frontend') {
                $comodin = $url[0];
            $url_comodin = array_shift($url);
            
            }else {
              
                $comodin = $url[0];
            }
           
             
            $this->_controlador = strtolower(array_shift($url));
            $this->_metodo = strtolower(array_shift($url));
            $this->_argumentos = $url;
            $this->_comodin = $comodin;
            
              
        }       
        
        if(!$this->_controlador){
            $this->_controlador = DEFAULT_CONTROLLER;   // index
        }
        
        if(!$this->_metodo){
            $this->_metodo = 'index'; 
        }
        
        if(!isset($this->_argumentos)){
            $this->_argumentos = array();
        }
    }
    
    public function getControlador()
    {
        return $this->_controlador;
    }
    
    public function getMetodo()
    {
        return $this->_metodo;
    }
    
    public function getArgs()
    {
        return $this->_argumentos;
    }
    
     public function getComodin()
    {
        return $this->_comodin;
    }
}

?>