<?php 
class Util  {
	
    public static function redirect($ruta){
        if($ruta){
			header('location:' . BASE_URL . $ruta);
			exit;
		}
		else{
			header('location:' . BASE_URL);
			exit;
		}
        
    }
    
    public static function render(){
        
        
    }
    
    //Me dice cual es el estado activo/ inactivo de una tabla y lo muestra en pantalla pintando de un color diferente de aucerdo al estado
    public static function getEstado($estado_id){
   
    if ($estado_id == 1) {
        ?>
        <span class="label label-success">Activo</span>
        <?php
    } else {
        ?>
        <span class="label label-danger ">Inactivo</span>
        <?php
        }
    }
    
    //Me indica si un elemento fué borrado (borrado lógico), de la base de datos
    public static function getIsDeleted($is_deleted_id){
   
    if ($is_deleted_id == 1) {
        ?>
        <span class="label label-danger">El elemento fue borrado</span>
        <?php
    } else {
        ?>
        <span class="label label-primary">El elemento no está borrado</span>
        <?php
        }
    }
    
    	

}

?>