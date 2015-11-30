<?php

/*
 * -------------------------------------
 * 
 * Bootstrap.php
 * -------------------------------------
 */


class Bootstrap
{
    public static function run(Request $peticion)
    {
        $controllerFiltro = $peticion->getControlador();
        $controllerComodin = $peticion->getComodin();
        $controller = $peticion->getControlador() . 'Controller';   //  ejem:  indexController o postController
        if($controllerComodin == "frontend"){
            $rutaControlador = ROOT . 'controllers' . DS .'frontend'. DS .$controller . '.php';  // ejem:  .../controllers/frontend/indexController.php
            
            
        }elseif ($controllerComodin == "backend") {
            $rutaControlador = ROOT . 'controllers' . DS .'backend'. DS . $controller . '.php';  // ejem:  .../controllers/backend/indexController.php
            
            }else {
                $rutaControlador = ROOT . 'controllers' . DS .'frontend'. DS .$controller . '.php';  // ejem:  .../controllers/indexController.php
          
            }
        
        //$rutaControlador = ROOT . 'controllers' . DS . $controller . '.php';  // ejem:  .../controllers/indexController.php
        $metodo = $peticion->getMetodo();
        $args = $peticion->getArgs();
//         echo "controller comodín: ".$controllerComodin."<br>";
//        echo "ruta controlador: ".$rutaControlador."<br>";
//        echo "controlador: ".$controller."<br>";
//        echo "metodo: ".$metodo."<br>";
//        echo "arguentos: ".$args."<br>";

        
        if(is_readable($rutaControlador)){
            require_once $rutaControlador;
            $controller = new $controller;
            
            if(is_callable(array($controller, $metodo))){
                $metodo = $peticion->getMetodo();
            }
          	else{
                $metodo = 'index';
            }
            
            if(isset($args)){
                call_user_func_array(array($controller, $metodo), $args);
            }
            else{
                call_user_func(array($controller, $metodo));
            }
            
        } else {
            throw new Exception('no encontrado');
        }
    }
}

?>