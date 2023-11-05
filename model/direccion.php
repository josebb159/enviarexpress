<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class direccion {
	public $conexion;
	private $nombre;
	private $direccion;
	private $telefono;
	private $latitude;
	private $longitude;
	private $seleccionado;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_direccion($id='204',$id_usuarios,$nombre,$direccion,$telefono,$latitude,$longitude,$seleccionado,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `direccion`(`estado`,`nombre`,`direccion`,`telefono`,`latitude`,`longitude`,`seleccionado`,`id_usuarios`) VALUES (:estado,:nombre,:direccion,:telefono,:latitude,:longitude,:seleccionado,:id_usuarios)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':direccion' => $direccion,':telefono' => $telefono,':latitude' => $latitude,':longitude' => $longitude,':seleccionado' => $seleccionado,':id_usuarios' => $id_usuarios));
	return 1;
	}
	public function buscar_direccion(){$sql = "SELECT  * FROM direccion ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_direccion($id, $estado){$sql = "UPDATE `direccion` SET `estado`=:estado WHERE id_direccion=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_direccion($id){$sql = "DELETE FROM `direccion`  WHERE id_direccion=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_direccion($id, $estado,$id_usuarios,$nombre,$direccion,$telefono,$latitude,$longitude,$seleccionado){
	$sql = "UPDATE `direccion` SET `estado`=:estado ,`nombre`=:nombre,`direccion`=:direccion,`telefono`=:telefono,`latitude`=:latitude,`longitude`=:longitude,`seleccionado`=:seleccionado,`id_usuarios`=:id_usuarios WHERE id_direccion=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':nombre' => $nombre,':direccion' => $direccion,':telefono' => $telefono,':latitude' => $latitude,':longitude' => $longitude,':seleccionado' => $seleccionado,':id_usuarios' => $id_usuarios));
	}
	public function buscar_json_direccion($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function rango() {
		// Código del método aquí
	}

}
?>