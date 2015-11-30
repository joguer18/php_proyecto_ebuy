<?php 

class productoController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
            
	public function index(){
           $objproducto = $this->loadModel('producto');
           
           $this->_view->productos = $objproducto->getAllProductos(); 
           $this->_view->renderizar('index');
             
	}
        
        public function agregar(){

           $objproducto = $this->loadModel('producto');
           $objcategoria = $this->loadModel('categoria');
           
           $this->_view->categorias = $objcategoria->getAllCategorias(); 
           $this->_view->renderizar('agregar'); 
            
        }
        
        public function agregarProducto(){
            
          // limpieza de data que viene del formulario
		$nombre = trim($_POST['nombre']);
		$descripcion = trim($_POST['descripcion']);
                $resumen = trim($_POST['resumen']);
                $slug = trim($_POST['slug']);
                $sku = trim($_POST['sku']);
                $stock = trim($_POST['stock']);
                $precio_costo = trim($_POST['precio_costo']);
                $precio_venta = trim($_POST['precio_venta']);
                $categoria_id = trim($_POST['categoria']);
                $estado = trim($_POST['estado']);
		
		
                $objproducto = $this->loadModel('producto');
                $id = $objproducto->agregarProducto($nombre,$descripcion,$resumen,$slug,$sku,$stock,$precio_costo,$precio_venta,$categoria_id,$estado);
		
                 //Subida de imagen
		if(isset($_FILES['imagen'])){
			$nombrearchivo= basename($_FILES['imagen']['name']);
			$destino_archivo = "temp/productos/".$nombrearchivo;
			
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
				$objproducto->grabaFotoProducto($id,$mime,$imagen,$source);
			}
			
		}
		$this->redireccionar('backend/producto/index');
                
            
        }
        
        public function editar($productoId){
           $objproducto = $this->loadModel('producto');
           $objcategoria = $this->loadModel('categoria');
           
           $this->_view->producto = $objproducto->getProducto($productoId);
           $this->_view->categorias = $objcategoria->getAllCategorias(); 
           $this->_view->renderizar('editar');
            
        }
        
        public function guardarProducto(){
                
                $id = trim($_POST['id']);
		$nombre = trim($_POST['nombre']);
		$descripcion = trim($_POST['descripcion']);
                $resumen = trim($_POST['resumen']);
                $slug = trim($_POST['slug']);
                $sku = trim($_POST['sku']);
                $stock = trim($_POST['stock']);
                $precio_costo = trim($_POST['precio_costo']);
                $precio_venta = trim($_POST['precio_venta']);
                $categoria_id = trim($_POST['categoria']);
                $imagen = trim($_POST['imagen']);
                $estado = trim($_POST['estado']);
                
		$objproducto = $this->loadModel('producto');
		
		$objproducto->updateProducto($id,$nombre,$descripcion,$resumen,$slug,$sku,$stock,$precio_costo,$precio_venta,$categoria_id,$imagen,$estado);
                
                //Subida de imagen
		if(isset($_FILES['imagen'])){
			$nombrearchivo= basename($_FILES['imagen']['name']);
			$destino_archivo = "temp/productos/".$nombrearchivo;
			
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
				$objproducto->grabaFotoProducto($id,$mime,$imagen,$source);
			}
			
		}
		
		$this->redireccionar('backend/producto/index');
	
	}
        // Ver el logo de la web
        public function verimagen($id){
		
		$objcategoria = $this->loadModel('categoria');
		$reg = $objcategoria->getCategoriaImagen($id);
		header("Content-Type:$reg->mime");
		echo $reg->imagen;	
                
	}
        
        public function detalle($productoId){
            
           $objproducto = $this->loadModel('producto');
           $objcategoria = $this->loadModel('categoria');
           
           $this->_view->producto = $objproducto->getProducto($productoId);
           $this->_view->categorias = $objcategoria->getAllCategorias(); 
           $this->_view->renderizar('detalle');
            
        }
        
        public function borrar($productoId){
	
                $objproducto = $this->loadModel('producto');
                $objproducto->borrarProducto($productoId);
                $this->redireccionar('backend/producto/index');
	}
        
        
}


?>