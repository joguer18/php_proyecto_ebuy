<?php
class metodopagoModel extends Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getAllMetodos() {
		$sql = "SELECT * FROM metodo_pago
				where is_deleted = 0;
				";
		
		$result = $this->_db->query ( $sql );
		
		return $result;
	}
        
        public function getMetodo($metodoId) {
		$sql = "select * from metodo_pago where id='$metodoId'";
		$result = $this->_db->query ( $sql );
		if ($result->num_rows) {
			$reg = $result->fetch_object ();
		}
		else 
			$reg=null;
		
		return $reg;
	}
        
	public function agregarMetodoPago($nombre,$estado) {
		
                $sql = "insert into metodo_pago set
					nombre='$nombre',
					estado = '$estado'";
		$this->_db->query($sql) or die('Error:'.$sql);
	}
        
        public function updateMetodo($id,$nombre,$estado){

		$sql = "update metodo_pago set
					nombre = '$nombre',
					estado = '$estado'
				where id = '$id'";
		$this->_db->query($sql) or die('Error:'.$sql);
		
	}
        
        public function borrarMetodo($metodoId){

		$sql = "update metodo_pago set
					is_deleted = 1
				where id = '$metodoId'";
		$this->_db->query($sql) or die('Error:'.$sql);
		
	}
           	
    }

?>
	