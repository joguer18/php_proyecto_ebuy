<?php
class pedido_itemModel extends Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getAllPedidos() {
            $sql = "SELECT ped.*,usu.nombres as usuario_nombre, usu.apellidos as usuario_apellido,mpago.nombre as metodo_nombre
                    FROM pedido ped
                    LEFT JOIN usuario usu
                    ON ped.usuario_id = usu.id
                    LEFT JOIN metodo_pago mpago
                    ON ped.metodo_pago_id = mpago.id
                    where ped.is_deleted = 0;
				";

        $result = $this->_db->query ( $sql );
		
		return $result;
	}
        
        public function getItemsPorPedido($pedidoId) {
            $sql = "SELECT ped.*,ped_item.sku_producto as item_sku, ped_item.nombre as item_nombre,
                    ped_item.cantidad as item_cantidad,ped_item.precio_unit as item_precio_unit,
                    ped_item.total as item_total,ped_item.source as item_source
                    FROM pedido ped
                    LEFT JOIN pedido_item ped_item
                    ON ped.id = ped_item.pedido_id
                    where ped.is_deleted = 0 and ped.id = '$pedidoId';
				";

        $result = $this->_db->query ( $sql );
		
		return $result;
	}
	public function getPedido($pedidoId) {
		$sql = "SELECT ped.*,usu.nombres as usuario_nombre, usu.apellidos as usuario_apellido,
                        usu.email as usuario_email,
                        usu_det.dni as usudet_dni,usu_det.telefono as usudet_telefono,
                        usu_det.direccion as usudet_direccion,usu_det.referencia as usudet_referencia,
                        mpago.nombre as metodo_nombre
                        FROM pedido ped 
                        LEFT JOIN usuario usu ON ped.usuario_id = usu.id
                        LEFT JOIN usuario_detalle usu_det ON usu_det.usuario_id = usu.id
                        LEFT JOIN metodo_pago mpago ON ped.metodo_pago_id = mpago.id where ped.id = '$pedidoId' and ped.is_deleted = 0";
                
                
		$result = $this->_db->query ( $sql );
		if ($result->num_rows) {
			$reg = $result->fetch_object ();
		}
		else 
			$reg=null;
		
		return $reg;
	}
        
        //Trae el detalle de los usuarios que realizan los pedidos
        public function getUsuarioDetallePedido($usuarioId) {
		$sql = "select * from pedido where usuario_id = '$usuarioId'";
                
                
		$result = $this->_db->query ( $sql );
		if ($result->num_rows) {
			$reg = $result->fetch_object ();
		}
		else 
			$reg=null;
		
		return $reg;
	}
        
        //Métodos para el frontend
        public function agregarPedido($direccion,$referencia,$dni,$telefono,$precio_delivery,$tipo_pago) {
		
                $sql = "insert into pedido set
					direccion='$direccion',
                                        referencia='$referencia',
                                        dni='$dni',
                                        telefono='$telefono',
                                        costo_envio='$precio_delivery',
                                        fecha_creacion = now(),
					metodo_pago_id = '$tipo_pago'";
		$this->_db->query($sql) or die('Error:'.$sql);
	}
        
	
    }

?>
	