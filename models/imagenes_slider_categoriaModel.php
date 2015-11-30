<?php
class imagenes_slider_categoriaModel extends Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getAllSliders($categoriaId) {
		$sql = "SELECT * FROM imagenes_slider_categoria
				where is_deleted = 0 and categoria_id = '$categoriaId';
				";
		
		$result = $this->_db->query ( $sql );
		
		return $result;
	}
        
        public function grabaFotoSlider($categoria_id, $mime, $imagen, $source){
		
//		$sql = "select * from imagenes_slider_categoria where categoria_id ='$categoria_id'";
//		$result = $this->_db->query($sql) or die('Error: '. $sql);
//		
//		if($result->num_rows){
//			$sql = "update imagenes_slider_categoria set mime='$mime', source='$source',imagen='$imagen'
//					where categoria_id = '$categoria_id'";
//		}else
			$sql = "insert into imagenes_slider_categoria set categoria_id = '$categoria_id',
                                source = '$source',
                                fecha_creacion = now(),
                                mime = '$mime',
                                imagen = '$imagen'
			";
		$this->_db->query($sql) or die('Error: '. $sql);
		return;
	}
        
        public function updateFotoSlider($categoria_id,$slider_id, $mime, $imagen, $source){
		
		$sql = "select * from imagenes_slider_categoria where categoria_id ='$categoria_id'";
		$result = $this->_db->query($sql) or die('Error: '. $sql);
		
		if($result->num_rows){
			$sql = "update imagenes_slider_categoria set mime='$mime', source='$source',imagen='$imagen'
					where id = '$slider_id' and categoria_id = '$categoria_id'";
		}else
			$sql = "insert into imagenes_slider_categoria set categoria_id = '$categoria_id',
                                source = '$source',
                                fecha_creacion = now(),
                                mime = '$mime',
                                imagen = '$imagen'
			";
		$this->_db->query($sql) or die('Error: '. $sql);
		return;
	}
        
        //Para la edición de los sliders
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
        
        //Métodos para la parte frontend
        public function getSlidersPorCategoria($categoriaId) {
		$sql = "SELECT * FROM imagenes_slider_categoria
				where is_deleted = 0 and estado = 1 and categoria_id = '$categoriaId';
				";
		
		$result = $this->_db->query ( $sql );
		
		return $result;
	}
        
        
           	
    }

?>
	