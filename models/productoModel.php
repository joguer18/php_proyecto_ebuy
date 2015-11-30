<?php
class productoModel extends Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getAllProductos() {
            $sql = "SELECT p.*,c.id as categoria_id,c.nombre as categoria_nombre FROM producto p
                    JOIN categoria c
                    ON p.categoria_id = c.id
                    WHERE p.is_deleted = 0;
                                            ";

        $result = $this->_db->query ( $sql );
		
		return $result;
	}
	public function getProducto($productoId) {
                
		$sql = "SELECT p.*,c.id as categoria_id,c.nombre as categoria_nombre FROM producto p
                    JOIN categoria c
                    ON p.categoria_id = c.id
                    WHERE p.id ='$productoId' and p.is_deleted = 0;";
		$result = $this->_db->query ( $sql );
		if ($result->num_rows) {
			$reg = $result->fetch_object ();
		}
		else 
			$reg=null;
		
		return $reg;
	}
        
        public function agregarProducto($nombre,$descripcion,$resumen,$slug,$sku,$stock,$precio_costo,$precio_venta,$categoria_id,$estado) {
		
                $sql = "insert into producto set
					nombre = '$nombre',
                                        descripcion = '$descripcion',
                                        resumen = '$resumen',
                                        slug = '$slug',
                                        sku = '$sku',
                                        stock = '$stock',
                                        precio_costo = '$precio_costo',
                                        precio_venta = '$precio_venta',
                                        categoria_id = '$categoria_id',
                                        fecha_creacion = now(),
					estado = '$estado'";
		$this->_db->query($sql) or die('Error:'.$sql);
                
                //Encontrando el último producto insertado
                $sql1 = "select * from producto ORDER BY id DESC";
		$this->_db->query($sql1) or die('Error:'.$sql1);
                $result = $this->_db->query($sql1);
                $reg = $result->fetch_object();
                $id = $reg->id;
                
                //Trae el id de la última categoría ingresada
                return $id;
                
                
	}
        
        public function updateProducto($id,$nombre,$descripcion,$resumen,$slug,$sku,$stock,$precio_costo,$precio_venta,$categoria_id,$imagen,$estado){

		$sql = "update producto set
				
					nombre = '$nombre',
                                        descripcion = '$descripcion',
                                        resumen = '$resumen',
                                        slug = '$slug',
                                        sku = '$sku',
                                        stock = '$stock',
                                        precio_costo = '$precio_costo',
                                        precio_venta = '$precio_venta',
                                        categoria_id = '$categoria_id',
                                        imagen = '$imagen',
                                        fecha_modificacion = now(),
                                        estado = '$estado'
				where id = '$id'";
		$this->_db->query($sql) or die('Error:'.$sql);
		
	}
        
        public function grabaFotoProducto($id,$mime,$imagen,$source){
		
		$sql = "select * from producto where id='$id'";
		$result = $this->_db->query($sql) or die('Error: '. $sql);
		
		if($result->num_rows){
			$sql = "update producto set mime='$mime',source='$source',imagen='$imagen'
					where id = '$id'";
		}else
			$sql = "insert into producto set id = '$id',
                                mime = '$mime',
                                source = '$source',
                                imagen = '$imagen'
			";
		$this->_db->query($sql) or die('Error: '. $sql);
		return;
	}
        
        //Traer la imagen del producto por el id de producto
        public function getProductoImagen($id){
	
		$sql = "select * from producto where id='$id'";
		$result = $this->_db->query($sql) or die('Error: '. $sql);
	
		if($result->num_rows){
			$reg = $result->fetch_object();
		}else
			$reg = null;
		
		return $reg;
	}
        
        //Traer la imagen del producto por el sku del producto
        public function getProductoSku($sku){
	
		$sql = "select * from producto where id='$sku'";
		$result = $this->_db->query($sql) or die('Error: '. $sql);
	
		if($result->num_rows){
			$reg = $result->fetch_object();
		}else
			$reg = null;
		
		return $reg;
	}
        
        public function borrarProducto($productoId){

		$sql = "update producto set
					is_deleted = 1
				where id = '$productoId'";
		$this->_db->query($sql) or die('Error:'.$sql);
		
	}
        
        //Métodos para el Frontend
        public function getProductosPorCategoria($categoriaId) {
            $sql = "SELECT p.*,c.id as categoria_id,c.nombre as categoria_nombre FROM producto p
                    JOIN categoria c
                    ON p.categoria_id = c.id
                    WHERE p.is_deleted = 0 and p.estado = 1
                    and p.categoria_id = '$categoriaId' and c.is_deleted = 0 and c.estado = 1;
                                            ";

        $result = $this->_db->query ( $sql );
		
		return $result;
	}
        
        public function getProductoFrontend($productoId) {
                
		$sql = "SELECT p.*,c.id as categoria_id,c.nombre as categoria_nombre FROM producto p
                    JOIN categoria c
                    ON p.categoria_id = c.id
                    WHERE p.id ='$productoId' and p.is_deleted = 0 and p.estado;";
		$result = $this->_db->query ( $sql );
		if ($result->num_rows) {
			$reg = $result->fetch_object ();
		}
		else 
			$reg=null;
		
		return $reg;
	}
       
           	
    }

?>
	