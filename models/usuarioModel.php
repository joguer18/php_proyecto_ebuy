<?php 
Class usuarioModel extends Model{
	
	public function __construct(){
		parent::__construct();
	}
        
        
        //Verifica si existe un usuario con los parámetros en base de datos y además verifica si es usuario web o usuario admin
        public function existeUsuarioAdmin($user, $pass){
            
            $sql="select * from usuario where usuario='$user' and password_admin=sha1('$pass')";
		$result = $this->_db->query($sql);
		
		if ($result->num_rows) return true;
		else
			 return false;
        }
        
        public function existeUsuarioWeb($user, $pass){
            
            $sql="select * from usuario where usuario='$user' and password=sha1('$pass')";
		$result = $this->_db->query($sql);
		
		if ($result->num_rows) return true;
		else
			 return false;
        }
        
        //Trae un objeto usuario sabiendo el usuario y el password
        public function getUsuarioAdmin($user, $pass){
            
            $reg='';
            $sql="select * from usuario where usuario='$user' and password_admin=sha1('$pass')";
            $result = $this->_db->query($sql);
            
            if ($result->num_rows) {
			
			$reg = $result->fetch_object();
		}
		
		return $reg;
            

        }
        
        //Lista los usuarios de la web (usuarios tipo web)
        public function getAllUsuariosWeb(){
            
            $sql = "SELECT * FROM usuario
				where is_deleted = 0 and (password is not null and length(password) != 0);
				";
		
		$result = $this->_db->query ( $sql );
		
		return $result;
        }
        
        //Trae un usuario cuyo Id se pasa por parámetro
        public function getUsuario($usuarioId) {
		$sql = "select * from usuario where id='$usuarioId'";
		$result = $this->_db->query ( $sql );
		if ($result->num_rows) {
			$reg = $result->fetch_object ();
		}
		else 
			$reg=null;
		
		return $reg;
	}
        
        public function updateUsuario($id,$usuario,$nombres,$apellidos,$email,$telefono,$estado){

		$sql = "update usuario set
				
					nombres = '$nombres',
                                        usuario = '$usuario',
                                        apellidos = '$apellidos',
                                        email = '$email',
                                        telefono = '$telefono',
                                        estado = '$estado'
				where id = '$id'";
		$this->_db->query($sql) or die('Error:'.$sql);
		
	}
        
        public function borrarUsuario($usuarioId){

		$sql = "update usuario set
					is_deleted = 1
				where id = '$usuarioId'";
		$this->_db->query($sql) or die('Error:'.$sql);
		
	}
        
        //Métodos para el frontend
         public function getUsuarioPorPedido(){
            
            $sql = "SELECT * FROM usuario
				where is_deleted = 0 and (password is not null and length(password) != 0);
				";
		
		$result = $this->_db->query ( $sql );
		
		return $result;
        }
	
	
}

?>