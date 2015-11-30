<?php 

class configuracionController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
            
	public function index(){
           $objconfiguracion = $this->loadModel('configuracion');
		
           $this->_view->configuraciones = $objconfiguracion->getAllConfiguraciones(); 
           $this->_view->renderizar('index');
             
	}
        
        public function editar($configuracionId){
           $objconfiguracion = $this->loadModel('configuracion');  
           
           $this->_view->configuracion = $objconfiguracion->getConfiguracion($configuracionId);
           $this->_view->renderizar('editar');
            
        }
        
        public function guardarConfiguracion(){
	
                $id = trim($_POST['id']);
		$nombre = trim($_POST['nombre']);
		$descripcion = trim($_POST['descripcion']);
                $titulo = trim($_POST['titulo']);
                $facebook = trim($_POST['facebook']);
                $twitter = trim($_POST['twitter']);
                $costo_envio = trim($_POST['costo_envio']);
		$objconfiguracion = $this->loadModel('configuracion');
		
		$objconfiguracion->updateConfiguracion($id,$nombre,$descripcion,$titulo,$facebook,$twitter,$costo_envio);
                
                //Subida de imagen
		if(isset($_FILES['logo'])){
			$nombrearchivo= basename($_FILES['logo']['name']);
			$destino_archivo = "temp/".$nombrearchivo;
			
			if(move_uploaded_file($_FILES['logo']['tmp_name'],$destino_archivo))
			{
                                $source = $nombrearchivo;
				/*array de tipos permitidos */	
				$mimes_permitidos = array('image/jpeg','image/jpg','image/png');
				$mime = $_FILES['logo']['type'];
				
				if(in_array($mime,$mimes_permitidos))
				{
					$fp = fopen($destino_archivo,"rb");
					$contenido = fread($fp,filesize($destino_archivo));
					$logo = addslashes($contenido);
					fclose($fp);
				}
				//unlink($destino_archivo);
				$objconfiguracion->grabaFotoLogo($id,$mime,$logo,$source);
			}
			
		}
		
		$this->redireccionar('backend/configuracion/index');
	
	}
        // Ver el logo de la web
        public function verlogo($id){
		
		$objconfiguracion = $this->loadModel('configuracion');
		$reg = $objconfiguracion->getConfiguracionLogo($id);
		header("Content-Type:$reg->mime");
		echo $reg->logo;	
                	
	
	}
        
        
}


?>