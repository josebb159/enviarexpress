<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class ordenExternal {
	public $conexion;
	public function __construct(){
		$this->conexion = new Conexion();
	}
 

	public function registrar_orden($id_tienda,	$id_cliente, $code){
		$estado_defaul = 1;
		$sql = "INSERT INTO `external_orden` ( `id_tienda`, `id_cliente`, `code`) VALUES (:id_tienda,:id_cliente, :code)";
		$reg = $this->conexion->prepare($sql);
		$reg->execute(array(':id_tienda' => $id_tienda,':id_cliente' => $id_cliente,':code' => $code));
		return $this->conexion->lastInsertId();
	}
	public function registrar_cliente($nombre,$apellido,$telefono,$correo,$direccion){
		$estado_defaul = 1;
		$sql = "INSERT INTO  `temporaluser`( `nombre`, `apellido`, `telefono`, `correo`, `direccion`) VALUES (:nombre,:apellido,:telefono,:correo,:direccion)";
		$reg = $this->conexion->prepare($sql);
		$reg->execute(array(':nombre' => $nombre,':apellido' => $apellido,':telefono' => $telefono,':correo' => $correo,':direccion' => $direccion));
		return $this->conexion->lastInsertId();
	}
	public function registrar_producto($id_orden,$nombre,$cantidad,$precio){
		$estado_defaul = 1;
		$sql = "INSERT `external_orden_list`(`id_orden`, `nombre`, `cantidad`, `precio`) VALUES (:id_orden,:nombre,:cantidad,:precio)";
		$reg = $this->conexion->prepare($sql);
		$reg->execute(array(':id_orden' => $id_orden,':nombre' => $nombre,':cantidad' => $cantidad,':precio' => $precio));
		return 1;
	}
	public function listo($id, $estado, $pago){$sql = "UPDATE `external_orden` SET `estatus`=:estado,  `pago`=:pago WHERE id=:id";
		$reg = $this->conexion->prepare($sql);
		$reg->execute(array(':id' => $id, ':estado' => $estado,':pago' => $pago));
		}
	public function buscar_orden(){$sql = "SELECT *, (SELECT nombre FROM usuarios WHERE orden.id_cliente = usuarios.id) as nombre_cliente, (SELECT nombre FROM usuarios WHERE orden.id_domiciliario = usuarios.id) as nombre_repartidor FROM `orden`;";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_orden($id, $estado){$sql = "UPDATE `orden` SET `estado`=:estado WHERE id_orden=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_orden($id){$sql = "DELETE FROM `orden`  WHERE id_orden=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_orden($id, $estado,$descripcion,$cantidad,$valor){
	$sql = "UPDATE `orden` SET `estado`=:estado ,`descripcion`=:descripcion,`cantidad`=:cantidad,`valor`=:valor WHERE id_orden=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':descripcion' => $descripcion,':cantidad' => $cantidad,':valor' => $valor));
	}
	public function buscar_json_orden($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function rango() {
		// C�digo del m�todo aqu�
	}

	public function cantidad(){
		$sql = "SELECT  count(*) as cantidad FROM orden ";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} 
	}

}
?>