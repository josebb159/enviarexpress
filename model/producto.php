<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class producto {
	public $conexion;
	private $nombre;
	private $descripcion;
	private $cantidad;
	private $imagen;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_producto($id='204',$id_comercios,$nombre,$descripcion,$cantidad,$imagen,$estado,$valor){
	$estado_defaul = 1;
	$sql = "INSERT INTO `producto`(`estado`,`nombre`,`descripcion`,`cantidad`,`imagen`,`id_comercios`, `valor`) VALUES (:estado,:nombre,:descripcion,:cantidad,:imagen,:id_comercios,:valor)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':descripcion' => $descripcion,':cantidad' => $cantidad,':imagen' => $imagen,':id_comercios' => $id_comercios, ':valor' => $valor));
	return 1;
	}
	
	public function buscar_producto(){$sql = "SELECT  * FROM producto ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function buscar_producto_tienda($id){$sql = "SELECT  producto.* FROM producto,comercios where producto.id_comercios=comercios.id_comercios and comercios.id_user='".$id."'";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} }
	public function cambiar_estado_producto($id, $estado){$sql = "UPDATE `producto` SET `estado`=:estado WHERE id_producto=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_producto($id){$sql = "DELETE FROM `producto`  WHERE id_producto=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_producto($id,$nombre,$descripcion,$cantidad,$imagen,$valor){
	$sql = "UPDATE `producto` SET  `nombre`=:nombre,`descripcion`=:descripcion,`cantidad`=:cantidad,`imagen`=:imagen,`valor`=:valor WHERE id_producto=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':nombre' => $nombre,':descripcion' => $descripcion,':cantidad' => $cantidad,':imagen' => $imagen,':valor' => $valor));
	}
	public function modificar_producto_comercio($id,$id_comercios,$nombre,$descripcion,$cantidad,$imagen,$valor){
		$sql = "UPDATE `producto` SET  `nombre`=:nombre,`descripcion`=:descripcion,`cantidad`=:cantidad,`imagen`=:imagen,`id_comercios`=:id_comercios,`valor`=:valor WHERE id_producto=:id";
		$reg = $this->conexion->prepare($sql);
		$reg->execute(array(':id' => $id, ':nombre' => $nombre,':descripcion' => $descripcion,':cantidad' => $cantidad,':imagen' => $imagen,':id_comercios' => $id_comercios,':valor' => $valor));
		}
	public function buscar_json_producto($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function rango() {
		// C�digo del m�todo aqu�
	}

}
?>