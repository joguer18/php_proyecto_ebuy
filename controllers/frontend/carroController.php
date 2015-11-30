<?php 

class carroController extends Controller{
	
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
            //$this->_view->sliders = $objsliders->getSlidersPorCategoria($categoriaId);
            $this->_view->slider = $objsliders->getSlidersPorCategoria(1);
            $this->_view->categorias = $objcategorias;
            //$this->_view->productos = $objproductos->getProductosPorCategoria($categoriaId);
            $this->_view->productos = $objproductos->getProductosPorCategoria(1);
            $this->_view->renderizar('index');
		
	}
        
        public function carro($productCode=null,$action=''){
        //session_destroy(); die();
        //Para el logo de la web   
        $objlogo = $this->loadModel('configuracion');

        //Trae las clasificaciones que serán parte el menú principal de la web
        $objclasificaciones = $this->loadModel('clasificacion');
        $objcategorias = $this->loadModel('categoria');

        $this->_view->logo = $objlogo->getConfiguracion(1);
        $this->_view->clasificaciones = $objclasificaciones->getAllClasificacionesFrontend();
        $this->_view->categorias = $objcategorias;

        if ($productCode != null){

			switch($action){
				case 'add':
					if (isset($_SESSION['carro'][$productCode])) $_SESSION['carro'][$productCode]++;
					else
					$_SESSION['carro'][$productCode]=1;
					break;

				case 'remove':
					if ($_SESSION['carro'][$productCode]==1) unset($_SESSION['carro'][$productCode]);
					else $_SESSION['carro'][$productCode]--;
					break;

				case 'removeProd':  unset($_SESSION['carro'][$productCode]); break;
			}
		}
                
		$this->cargarCarro();
                //var_dump($_SESSION);
		$this->_view->renderizar('carro',TRUE);
	}
        
        public function cargarCarro(){
		$objProducto= $this->loadModel('producto');

		$this->_view->importetotal=0;
		$this->_view->cantidadtotal=0;

		foreach ($_SESSION['carro'] as $productCode =>$cantidad){
		
			$producto= $objProducto->getProductoFrontend($productCode);
                        $this->_view->arrayCarro[$productCode]['source']=$producto->source;
			$this->_view->arrayCarro[$productCode]['cantidad']=$cantidad;
			$this->_view->arrayCarro[$productCode]['precio']=$producto->precio_venta;
			$this->_view->arrayCarro[$productCode]['nombre']=$producto->nombre;
			$this->_view->arrayCarro[$productCode]['importe']=$producto->precio_venta*$cantidad;
			$this->_view->importetotal+= $this->_view->arrayCarro[$productCode]['importe'];
			$this->_view->cantidadtotal+=$cantidad;
                        $this->_view->producto=$productCode;
//                        echo $producto->nombre.": ".$this->_view->importetotal."<br>";
//                        echo $producto->nombre.": ".$this->_view->cantidadtotal."<br>";
                        
		}
                
		$_SESSION['totalImporte']=$this->_view->importetotal;
		$_SESSION['cantidadTotal']=$this->_view->cantidadtotal;
                //$_SESSION['productoId']=$productCode;
			
	}
        
        public function comprar(){
        
        //Para el logo de la web   
        $objlogo = $this->loadModel('configuracion');

        //Trae las clasificaciones que serán parte el menú principal de la web
        $objclasificaciones = $this->loadModel('clasificacion');
        $objcategorias = $this->loadModel('categoria');

        $this->_view->logo = $objlogo->getConfiguracion(1);
        $this->_view->clasificaciones = $objclasificaciones->getAllClasificacionesFrontend();
        $this->_view->categorias = $objcategorias;

        $this->cargarCarro();
        $this->_view->renderizar('compra');
    }
        
        
}


?>