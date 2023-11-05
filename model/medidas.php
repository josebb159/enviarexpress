<?php
class medidas {
	public $conexion;
	private $nombre;
	private $descripcion;

	public function registrar_medidas($id,$nombre,$descripcion,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `rol`(`estado`,`nombre`,`descripcion`) VALUES (:estado,:nombre,:descripcion)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':descripcion' => $descripcion));
	return 1;
	}
	public function buscar_medidas(){$sql = "SELECT  * FROM medidas ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_medidas($id, $estado){$sql = "UPDATE `medidas` SET `estado`=:estado WHERE id=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_medidas($id, $estado){$sql = "DELETE FROM `medidas`  WHERE id=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_medidas($id, $estado,$nombre,$descripcion){
	$sql = "UPDATE `medidas` SET `estado`=:estado ,`nombre`=:nombre,`descripcion`=:descripcion WHERE id=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':nombre' => $nombre,':descripcion' => $descripcion));
	}
	public function buscar_json_medidas($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function estadisticas() {
		// Código del método aquí
	}

	public function datos_json() {
		// Código del método aquí
	}

}
?>