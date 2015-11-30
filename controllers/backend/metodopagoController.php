<?php 

class metodopagoController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
            
	public function index(){
           $objmetodo = $this->loadModel('metodopago');
		
           $this->_view->metodos = $objmetodo->getAllMetodos(); 
           $this->_view->renderizar('index');
             
	}
        
        public function agregar(){
           $objmetodo = $this->loadModel('metodopago');
           $this->_view->renderizar('agregar'); 
            
        }
        
        public function agregarMetodoPago(){
            
          // limpieza de data que viene del formulario
		$nombre = trim(strtolower($_POST['nombre']));
		$estado = trim(strtolower($_POST['estado']));
		
		//compara los password
		
		
			  $objmetodo = $this->loadModel('metodopago');
			  $objmetodo->agregarMetodoPago($nombre,$estado);
		
		$this->redireccionar('backend/metodopago/index');
                
            
        }
        
        public function editar($metodoId){
           $objmetodo = $this->loadModel('metodopago');  
           
           $this->_view->metodo = $objmetodo->getMetodo($metodoId);
           $this->_view->renderizar('editar');
            
        }
        
        public function guardarMetodo(){
	
                $id = trim($_POST['id']);
		$nombre = trim($_POST['nombre']);
		$estado = trim($_POST['estado']);
		
		$objmetodo = $this->loadModel('metodopago');
		
		$objmetodo->updateMetodo($id,$nombre,$estado);
		
		$this->redireccionar('backend/metodopago/index');
	
	}
        
        public function borrar($metodoId){
	
                $objmetodo = $this->loadModel('metodopago');
                $objmetodo->borrarMetodo($metodoId);
                $this->redireccionar('backend/metodopago/index');
	}
       
	
}


?>