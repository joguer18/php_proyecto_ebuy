<?php 
class usuarioController extends Controller{
    
    
     public function __construct() {
         parent::__construct();
     }
     
     public function index() {
         $objusuario = $this->loadModel('usuario');
		
         $this->_view->usuarios = $objusuario->getAllUsuariosWeb(); 
         $this->_view->renderizar('index');
     }
     
     public function editar($usuarioaId){
           $objusuario = $this->loadModel('usuario');  
           
           $this->_view->usuario = $objusuario->getUsuario($usuarioaId);
           $this->_view->renderizar('editar');
            
        }
        
    public function guardarUsuario(){
	
                $id = trim($_POST['id']);
                $usuario = trim($_POST['usuario']);
		$nombres = trim($_POST['nombres']);
		$apellidos = trim($_POST['apellidos']);
                $email = trim($_POST['email']);
                $telefono = trim($_POST['telefono']);
                $estado = trim($_POST['estado']);
                
		$objusuario = $this->loadModel('usuario');
		
		$objusuario->updateUsuario($id,$usuario,$nombres,$apellidos,$email,$telefono,$estado);
                
		
		$this->redireccionar('backend/usuario/index');
	
	}
        
    public function borrar($usuarioId){
	
                $objusuario = $this->loadModel('usuario');
                $objusuario->borrarUsuario($usuarioId);
                $this->redireccionar('backend/usuario/index');
	}
    
    
}

?>