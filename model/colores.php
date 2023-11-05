<?php
class colores {
	public $conexion;
	private $nombre;
	private $descripcion;
	private $codigo;

	public function registrar_colores($id,$nombre,$descripcion,$codigo,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `rol`(`estado`,`nombre`,`descripcion`,`codigo`) VALUES (:estado,:nombre,:descripcion,:codigo)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':descripcion' => $descripcion,':codigo' => $codigo));
	return 1;
	}
	public function buscar_colores(){$sql = "SELECT  * FROM colores ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_colores($id, $estado){$sql = "UPDATE `colores` SET `estado`=:estado WHERE id=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_colores($id, $estado){$sql = "DELETE FROM `colores`  WHERE id=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_colores($id, $estado,$nombre,$descripcion,$codigo){
	$sql = "UPDATE `colores` SET `estado`=:estado ,`nombre`=:nombre,`descripcion`=:descripcion,`codigo`=:codigo WHERE id=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':nombre' => $nombre,':descripcion' => $descripcion,':codigo' => $codigo));
	}
	public function buscar_json_colores($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function datos() {
		// Código del método aquí
	}

	public function estadistica() {
		// Código del método aquí
	}

}
?>