<?php
class configuracionModel extends Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getAllConfiguraciones() {
		$sql = "SELECT * FROM configuracion;";
		
		$result = $this->_db->query ( $sql );
		
		return $result;
	}
	public function getConfiguracion($configuracionId) {
		$sql = "select * from configuracion where id='$configuracionId'";
		$result = $this->_db->query ( $sql );
		if ($result->num_rows) {
			$reg = $result->fetch_object ();
		}
		else 
			$reg=null;
		
		return $reg;
	}
        
        public function updateConfiguracion($id,$nombre,$descripcion,$titulo,$facebook,$twitter,$costo_envio){

		$sql = "update configuracion set
				
					nombre = '$nombre',
                                        descripcion = '$descripcion',
                                        titulo = '$titulo',
                                        facebook = '$facebook',
                                        twitter = '$twitter',
                                        costo_envio = '$costo_envio'
				where id = '$id'";
		$this->_db->query($sql) or die('Error:'.$sql);
		
	}
        
        public function grabaFotoLogo($id,$mime,$logo,$source){
		
		$sql = "select * from configuracion where id='$id'";
		$result = $this->_db->query($sql) or die('Error: '. $sql);
		
		if($result->num_rows){
			$sql = "update configuracion set mime='$mime',source='$source',logo='$logo'
					where id = '$id'";
		}else
			$sql = "insert into configuracion set id = '$id',
                                mime = '$mime',
                                source = '$source',
                                logo = '$logo'
			";
		$this->_db->query($sql) or die('Error: '. $sql);
		return;
	}
        
        public function getConfiguracionLogo($id){
	
		$sql = "select * from configuracion where id='$id'";
		$result = $this->_db->query($sql) or die('Error: '. $sql);
	
		if($result->num_rows){
			$reg = $result->fetch_object();
		}else
			$reg = null;
		
		return $reg;
	}
       
           	
    }

?>
	