<?php 

class productoController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
            
	public function index(){
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
            $this->_view->sliders = $objsliders->getSlidersPorCategoria($categoriaId);
            $this->_view->categorias = $objcategorias;
            $this->_view->productos = $objproductos->getProductosPorCategoria($categoriaId);
            $this->_view->renderizar('index');
             
	}
        
        public function listar($categoriaId){
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
            $this->_view->slider = $objsliders->getSlidersPorCategoria($categoriaId);
            $this->_view->categorias = $objcategorias;
            $this->_view->productos = $objproductos->getProductosPorCategoria($categoriaId);
            $this->_view->renderizar('index');
             
	}
        
        public function detalle($productoId){
             
           //Sección para el header   
            $objlogo = $this->loadModel('configuracion');
            $objclasificaciones = $this->loadModel('clasificacion');
            $objcategorias = $this->loadModel('categoria');
            $objproducto = $this->loadModel('producto');
            
            $this->_view->logo = $objlogo->getConfiguracion(1);
            $this->_view->clasificaciones = $objclasificaciones->getAllClasificacionesFrontend();
            $this->_view->categorias = $objcategorias;
            //Fin sección para el header
            $this->_view->producto = $objproducto->getProductoFrontend($productoId);
            $this->_view->renderizar('index');
             
	}
        
        
        
}


?>