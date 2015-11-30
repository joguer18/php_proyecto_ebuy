<?php 

class clasificacionController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
            
	public function index(){
           $objclasificacion = $this->loadModel('clasificacion');
		
           $this->_view->clasificaciones = $objclasificacion->getAllClasificaciones(); 
           $this->_view->renderizar('index');
             
	}
        
        public function agregar(){
           $objclasificacion = $this->loadModel('clasificacion');
           $this->_view->renderizar('agregar'); 
            
        }
        
        public function agregarClasificacion(){
            
          // limpieza de data que viene del formulario
		$nombre = trim(strtolower($_POST['nombre']));
		$descripcion = trim(strtolower($_POST['descripcion']));
                $slug = trim(strtolower($_POST['slug']));
                $estado = trim(strtolower($_POST['estado']));
		
		
                $objclasificacion = $this->loadModel('clasificacion');
                $objclasificacion->agregarClasificacion($nombre,$descripcion,$slug,$estado);
		
		$this->redireccionar('backend/clasificacion/index');
                
            
        }
        
        public function editar($clasificacionId){
           $objclasificacion = $this->loadModel('clasificacion');  
           
           $this->_view->clasificacion = $objclasificacion->getClasificacion($clasificacionId);
           $this->_view->renderizar('editar');
            
        }
        
        public function guardarClasificacion(){
	
                $id = trim($_POST['id']);
		$nombre = trim($_POST['nombre']);
		$descripcion = trim($_POST['descripcion']);
                $slug = trim($_POST['slug']);
                $estado = trim($_POST['estado']);
		
		$objclasificacion = $this->loadModel('clasificacion');
		
		$objclasificacion->updateClasificacion($id,$nombre,$descripcion,$slug,$estado);
		
		$this->redireccionar('backend/clasificacion/index');
	
	}
        
        public function borrar($clasificacionId){
	
                $objmetodo = $this->loadModel('clasificacion');
                $objmetodo->borrarClasificacion($clasificacionId);
                $this->redireccionar('backend/clasificacion/index');
	}
       
	
}


?>