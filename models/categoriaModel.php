<?php
class categoriaModel extends Model {
	public function __construct() {
		parent::__construct ();
	}
        
        public function getAllCategorias() {
		$sql = "SELECT cat.*,cla.id as clasificacion_id, cla.nombre as clasificacion_nombre
                FROM categoria cat
                LEFT JOIN categoria_has_clasificacion cat_cla
                ON cat.id = cat_cla.categoria_id
                LEFT JOIN clasificacion cla
                ON cat_cla.clasificacion_id = cla.id
                where cat.is_deleted = 0;
				";
                
		$result = $this->_db->query ( $sql );
		
		return $result;
	}
	public function getCategoriaPorClasificacion($clasificacionId) {
                
		$sql = "SELECT cat.*,cat_cla.clasificacion_id as clasificacion_id
                FROM categoria cat
                JOIN categoria_has_clasificacion cat_cla
                ON cat.id = cat_cla.categoria_id
                where cat_cla.clasificacion_id='$clasificacionId' and cat.is_deleted = 0 and cat.estado = 1;
                        ";
		$result = $this->_db->query ( $sql );
		if ($result->num_rows) {
			$reg = $result;
		}
		else 
			$reg=null;
		
		return $reg;
	}
        
        public function agregarCategoria($nombre,$descripcion,$slug,$clasificacion,$estado) {
		
                $sql = "insert into categoria set
					nombre='$nombre',
                                        descripcion='$descripcion',
                                        slug='$slug',
                                        fecha_creacion = now(),
					estado = '$estado'";
		$this->_db->query($sql) or die('Error:'.$sql);
                
                //Encontrando la última categoría insertada
                $sql1 = "select * from categoria ORDER BY id DESC";
		$this->_db->query($sql1) or die('Error:'.$sql1);
                $result = $this->_db->query($sql1);
                $reg = $result->fetch_object();
                $id = $reg->id;
                
                //Agregando la clasificación de la categoría en la tabla categoria_has_clasificacion
                $sql2 = "insert into categoria_has_clasificacion set
				
                                clasificacion_id = '$clasificacion',
				categoria_id = '$id'";
		$this->_db->query($sql2) or die('Error:'.$sql2);
                 
                //Trae el id de la última categoría ingresada
                return $id;
                
                
	}
        
        public function updateCategoria($id,$nombre,$descripcion,$slug,$clasificacion_id,$estado){

		$sql = "update categoria set
				
					nombre = '$nombre',
                                        descripcion = '$descripcion',
                                        slug = '$slug',
                                        estado = '$estado'
				where id = '$id'";
		$this->_db->query($sql) or die('Error:'.$sql);
                
                $sql1 = "update categoria_has_clasificacion set
				
                                        clasificacion_id = '$clasificacion_id'
				where categoria_id = '$id'";
		$this->_db->query($sql1) or die('Error:'.$sql1);
		
	}
        
        public function grabaFotoCategoria($id,$mime,$imagen,$source){
		
		$sql = "select * from categoria where id='$id'";
		$result = $this->_db->query($sql) or die('Error: '. $sql);
		
		if($result->num_rows){
			$sql = "update categoria set mime='$mime', source='$source',imagen='$imagen'
					where id = '$id'";
		}else
			$sql = "insert into categoria set id = '$id',
                                source = '$source',
                                mime = '$mime',
                                imagen = '$imagen'
			";
		$this->_db->query($sql) or die('Error: '. $sql);
		return;
	}
        
        public function getCategoriaImagen($id){
	
		$sql = "select * from categoria where id='$id'";
		$result = $this->_db->query($sql) or die('Error: '. $sql);
	
		if($result->num_rows){
			$reg = $result->fetch_object();
		}else
			$reg = null;
		
		return $reg;
	}
        
        public function borrarCategoria($categoriaId){

		$sql = "update categoria set
					is_deleted = 1
				where id = '$categoriaId'";
		$this->_db->query($sql) or die('Error:'.$sql);
		
	}
       
           	
    }

?>
	