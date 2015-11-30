<?php 

class pedidoController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
            
	public function index(){
            
             //Para el logo de la web   
            $objlogo = $this->loadModel('configuracion');
            //Trae las clasificaciones que serán parte el menú principal de la web
            $objclasificaciones = $this->loadModel('clasificacion');
            $objcategorias = $this->loadModel('categoria');
            
            $this->_view->logo = $objlogo->getConfiguracion(1);
            $this->_view->clasificaciones = $objclasificaciones->getAllClasificacionesFrontend();
            //$this->_view->categorias = $objcategorias->getCategoriaPorClasificacion($clasificacionId);
            $this->_view->categorias = $objcategorias;
            $this->_view->renderizar('index');
             
	}
        
         public function guardarPedido(){
            //Para el logo de la web   
            $objlogo = $this->loadModel('configuracion');
            $objclasificaciones = $this->loadModel('clasificacion');
            $objcategorias = $this->loadModel('categoria');
            $this->_view->logo = $objlogo->getConfiguracion(1);
            $this->_view->clasificaciones = $objclasificaciones->getAllClasificacionesFrontend();
            $this->_view->categorias = $objcategorias;
//             unset($_SESSION['carro']);
//		unset($_SESSION['cantidadTotal']);
//		unset($_SESSION['totalImporte']);die();
             var_dump($_SESSION['carro']);
             
             switch ($_POST['payment_type']) {
                 case 1:
                        $this->contraEntrega($_POST);
                     break;
                  case 2:
                        $this->payPal();
                     break;
                 default:
                     break;
             }     
             
         }
         
         public function contraEntrega($variables){
             
             $direccion = $_POST['address'];
             $referencia = $_POST['reference'];
             $dni = $_POST['dni'];
             $telefono = $_POST['phone'];
             $precio_delivery = $_POST['delivery_price'];
             $tipo_pago = $_POST['payment_type'];
             $subtotal = $_SESSION['totalImporte'];
             $total = $_SESSION['totalImporte'] + $precio_delivery;
             
             $objpedido = $this->loadModel('pedido');
             $objproducto = $this->loadModel('producto');
             $objpedidoitem = $this->loadModel('pedido_item');
              
             //Guarda en la tabla pedido
             //$objpedido->agregarPedido($direccion,$referencia,$dni,$telefono,$precio_delivery,$tipo_pago,$subtotal,$total);
             //Trae cada producto del carrito
             foreach ($_SESSION['carro'] as $productoId => $cantidad) {
                $productos[] = $objproducto->getProductoFrontend($productoId); 
             }
             
             //$objpedidoitem->agregarPedidoItem($pedidoId,$sku_producto,$descripcion,$cantidad,$precio_unit,$total,$source);
             
             $this->_view->productos = $productos;
             $this->_view->renderizar('index');
                          
         }
        
       
        
}




?>