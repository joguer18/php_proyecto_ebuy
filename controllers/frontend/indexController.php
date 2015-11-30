<?php 

class indexController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
            
//        $_SESSION['carro'] =  "d";
//        $_SESSION['denis'] =  "Denis";
//        $carro['cantidad'] = 10;
//        echo 'datos de la cession fueron guardados';
//          var_dump($_SESSION); die();
          
             //Para el logo de la web   
            $objlogo = $this->loadModel('configuracion');
            
            //Trae las clasificaciones que serán parte el menú principal de la web
            $objclasificaciones = $this->loadModel('clasificacion');
            $objcategorias = $this->loadModel('categoria');
            $objsliders = $this->loadModel('imagenes_slider_categoria');
            $objproductos = $this->loadModel('producto');
            
            $this->_view->logo = $objlogo->getConfiguracion(1);
            $this->_view->clasificaciones = $objclasificaciones->getAllClasificacionesFrontend();
            //$this->_view->categorias = $objcategorias->getCategoriaPorClasificacion($clasificacionId);
            //$this->_view->sliders = $objsliders->getSlidersPorCategoria($categoriaId);
            $this->_view->slider = $objsliders->getSlidersPorCategoria(1);
            $this->_view->categorias = $objcategorias;
            //$this->_view->productos = $objproductos->getProductosPorCategoria($categoriaId);
            $this->_view->productos = $objproductos->getProductosPorCategoria(1);
            $this->_view->renderizar('index');
		
	}
        
        public function denis(){
                
                echo "Denis";
		echo $_SESSION['usuario_id'];
		
	}
        
        
	
	
}


?>