<?php

/*
 * -------------------------------------

 * View.php
 * -------------------------------------
 */


class View
{
	private $_controlador;
	private $_js;

	public function __construct(Request $peticion) {
		$this->_controlador = $peticion->getControlador();
                $this->_comodin = $peticion->getComodin();
		$this->_js = array();
	}


	/*
	 *  Esta funci�n vuelve a cargar la pagina
	 *
	 *
	 */
	public function renderizar($vista, $partial = false)
	{


		$js = array();

		if(count($this->_js)){
			$js = $this->_js;
		}

		$_layoutParams = array(
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/',
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/',
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',
            'js' => $js
		);
                
                if($this->_comodin == "backend"){
                    $rutaView = ROOT . 'views' . DS . 'backend' . DS . $this->_controlador . DS . $vista . '.phtml';
                    }elseif ($this->_comodin == "frontend") {
                        $rutaView = ROOT . 'views' . DS . 'frontend' . DS . $this->_controlador . DS . $vista . '.phtml';
                        } else{
                                $rutaView = ROOT . 'views' . DS . 'frontend' . DS . $this->_controlador . DS . $vista . '.phtml';
                              }
		//echo "Vista: ".$rutaView;
                
		if(is_readable($rutaView)){
			if (!$partial) {
                            if($this->_comodin == "backend"){
                               include_once ROOT . 'views'. DS .'backend'. DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
                               include_once $rutaView;
                               include_once ROOT . 'views'. DS .'backend'. DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php'; 
                            }elseif ($this->_comodin == "frontend") {
                               include_once ROOT . 'views'. DS .'frontend'. DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
                               include_once $rutaView;
                               include_once ROOT . 'views'. DS .'frontend'. DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';  
                            }else{
                               include_once ROOT . 'views'. DS .'frontend'. DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
                               include_once $rutaView;
                               include_once ROOT . 'views'. DS .'frontend'. DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';   
                            }
				
			}
			else
			include_once $rutaView;
		}
		else {
			throw new Exception('Error de vista');
		}
	}

	/*
	 *  carga los js  especificos del controlador
	 *
	 */

	public function setJs(array $js)
	{
		if(is_array($js) && count($js)){
			for($i=0; $i < count($js); $i++){
				$this->_js[] = BASE_URL . 'views/' . $this->_controlador . '/js/' . $js[$i] . '.js';
			}
		} else {
			throw new Exception('Error de js');
		}
	}

}

?>
