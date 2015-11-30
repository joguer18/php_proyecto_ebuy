<?php 

class indexController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
            
	public function index(){
            
            if(isset($_SESSION['usuario_id'])){
               $this->redireccionar('backend/index/panel'); 
            }
            else
		$this->_view->renderizar('login',TRUE);
            
             
	}
       
        
        public function login(){
         
	$user = trim($_POST['usuario']);
	$pass =trim($_POST['password']);
        
	
        $objuser = $this->loadModel('usuario');
		
		if ($objuser->existeUsuarioAdmin($user, $pass)){
                        
                        $usuario = $objuser->getUsuarioAdmin($user, $pass);
                        $_SESSION['usuario_id'] = $usuario->id;
                        $_SESSION['usuario_usuario'] = $usuario->usuario;
                        
			$this->redireccionar('backend/index/panel');
		}
		else 
			$this->redireccionar('backend/index');
	}
	
	public function panel(){
               
		$this->_view->renderizar('index');
                //unset($_SESSION['usuario_id']);
               
	}
        
        public function denis(){
               
		echo "Hola soy Denis :P";
               
	}
        
        
	
	
}


?>