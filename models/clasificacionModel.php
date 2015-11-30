<?php
class clasificacionModel extends Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getAllClasificaciones() {
		$sql = "SELECT * FROM clasificacion
				where is_deleted = 0;
				";
		
		$result = $this->_db->query ( $sql );
		
		return $result;
	}
	public function getClasificacion($clasificacionId) {
		$sql = "select * from clasificacion where id='$clasificacionId'";
		$result = $this->_db->query ( $sql );
		if ($result->num_rows) {
			$reg = $result->fetch_object ();
		}
		else 
			$reg=null;
		
		return $reg;
	}
        
        public function agregarClasificacion($nombre,$descripcion,$slug,$estado) {
		
                $sql = "insert into clasificacion set
					nombre='$nombre',
                                        descripcion='$descripcion',
                                        slug='$slug',
                                        fecha_creacion = now(),
					estado = '$estado'";
		$this->_db->query($sql) or die('Error:'.$sql);
	}
        
        public function updateClasificacion($id,$nombre,$descripcion,$slug,$estado){

		$sql = "update clasificacion set
				
					nombre = '$nombre',
                                        descripcion = '$descripcion',
                                        slug = '$slug',
					estado = '$estado'
				where id = '$id'";
		$this->_db->query($sql) or die('Error:'.$sql);
		
	}
        
        public function borrarClasificacion($clasificacionId){

		$sql = "update clasificacion set
					is_deleted = 1
				where id = '$clasificacionId'";
		$this->_db->query($sql) or die('Error:'.$sql);
		
	}
        
        //Métodos para el Frontend
        public function getAllClasificacionesFrontend() {
                
                $sql = "SELECT cla.*
                FROM clasificacion cla
                JOIN categoria_has_clasificacion cat_cla
                ON cla.id = cat_cla.clasificacion_id
                where cla.is_deleted = 0 and cla.estado = 1 group by cla.id;
				";
		
		$result = $this->_db->query ( $sql );
		
		return $result;
	}
           	
    }

?>
	