<?php 

class pedidoController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
            
	public function index(){
           $objpedido = $this->loadModel('pedido');
		
           $this->_view->pedidos = $objpedido->getAllPedidos(); 
           $this->_view->renderizar('index');
             
	}
        
        public function editar($pedidoId){
           $objpedido = $this->loadModel('pedido');  
           
           $this->_view->pedido = $objpedido->getPedido($pedidoId);
           $this->_view->renderizar('editar');
            
        }
        
        public function detalle($pedidoId){
           $objpedido = $this->loadModel('pedido');
           $objusuario = $this->loadModel('usuario'); 
           
           $this->_view->pedido = $objpedido->getPedido($pedidoId);
           $this->_view->usuarios = $objusuario->getAllUsuariosWeb(); 
           $this->_view->items = $objpedido->getItemsPorPedido($pedidoId); 
           $this->_view->renderizar('detalle');
            
        }
       
	
}


?>