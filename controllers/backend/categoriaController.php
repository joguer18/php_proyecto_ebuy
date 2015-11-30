<?php 

class categoriaController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
            
	public function index(){
           $objcategoria = $this->loadModel('categoria');
		
           $this->_view->categorias = $objcategoria->getAllCategorias(); 
           $this->_view->renderizar('index');
             
	}
        
        public function agregar(){

            $objclasificacion = $this->loadModel('clasificacion');
           
           $this->_view->clasificaciones = $objclasificacion->getAllClasificaciones();
           $this->_view->renderizar('agregar'); 
            
        }
        
        public function agregarCategoria(){
            
          // limpieza de data que viene del formulario
		$nombre = trim(strtolower($_POST['nombre']));
		$descripcion = trim(strtolower($_POST['descripcion']));
                $slug = trim(strtolower($_POST['slug']));
                $clasificacion = trim(strtolower($_POST['clasificacion']));
                $estado = trim(strtolower($_POST['estado']));
		
		
                $objcategoria = $this->loadModel('categoria');
                $id = $objcategoria->agregarCategoria($nombre,$descripcion,$slug,$clasificacion,$estado);
		
                 //Subida de imagen
		if(isset($_FILES['imagen'])){
			$nombrearchivo= basename($_FILES['imagen']['name']);
			$destino_archivo = "temp/categorias/".$nombrearchivo;
			
			if(move_uploaded_file($_FILES['imagen']['tmp_name'],$destino_archivo))
			{
                                $source = $nombrearchivo;
				/*array de tipos permitidos */	
				$mimes_permitidos = array('image/jpeg','image/jpg','image/png');
				$mime = $_FILES['imagen']['type'];
				
				if(in_array($mime,$mimes_permitidos))
				{
					$fp = fopen($destino_archivo,"rb");
					$contenido = fread($fp,filesize($destino_archivo));
					$imagen = addslashes($contenido);
					fclose($fp);
				}
				//unlink($destino_archivo);
				$objcategoria->grabaFotoCategoria($id,$mime,$imagen,$source);
			}
			
		}
		$this->redireccionar('backend/categoria/index');
                
            
        }
        
        public function editar($categoriaId){
           $objcategoria = $this->loadModel('categoria');  
           $objclasificacion = $this->loadModel('clasificacion');
           $objcategoria_slider = $this->loadModel('imagenes_slider_categoria');
           
           $this->_view->categoria = $objcategoria->getCategoria($categoriaId);
           $this->_view->clasificaciones = $objclasificacion->getAllClasificaciones();
           $this->_view->slider = $objcategoria_slider->getAllSliders($categoriaId);
           $this->_view->renderizar('editar');
            
        }
        
        public function guardarCategoria(){
	
                $id = trim($_POST['id']);
		$nombre = trim($_POST['nombre']);
		$descripcion = trim($_POST['descripcion']);
                $slug = trim($_POST['slug']);
                $clasificacion_id = trim($_POST['clasificacion']);
                $estado = trim($_POST['estado']);
                
		$objcategoria = $this->loadModel('categoria');
		
		$objcategoria->updateCategoria($id,$nombre,$descripcion,$slug,$clasificacion_id,$estado);
                
                //Subida de imagen
		if(isset($_FILES['imagen'])){
			$nombrearchivo= basename($_FILES['imagen']['name']);
			$destino_archivo = "temp/categorias/".$nombrearchivo;
			
			if(move_uploaded_file($_FILES['imagen']['tmp_name'],$destino_archivo))
			{
                                $source = $nombrearchivo;
				/*array de tipos permitidos */	
				$mimes_permitidos = array('image/jpeg','image/jpg','image/png');
				$mime = $_FILES['imagen']['type'];
				
				if(in_array($mime,$mimes_permitidos))
				{
					$fp = fopen($destino_archivo,"rb");
					$contenido = fread($fp,filesize($destino_archivo));
					$imagen = addslashes($contenido);
					fclose($fp);
				}
				//unlink($destino_archivo);
				$objcategoria->grabaFotoCategoria($id,$mime,$imagen,$source);
			}
			
		}
		
		$this->redireccionar('backend/categoria/index');
	
	}
        // Ver el logo de la web
        public function verimagen($id){
		
		$objcategoria = $this->loadModel('categoria');
		$reg = $objcategoria->getCategoriaImagen($id);
		header("Content-Type:$reg->mime");
		echo $reg->imagen;	
                
	}
        
        public function borrar($categoriaId){
	
                $objcategoria = $this->loadModel('categoria');
                $objcategoria->borrarCategoria($categoriaId);
                $this->redireccionar('backend/categoria/index');
	}
        
        
}


?>