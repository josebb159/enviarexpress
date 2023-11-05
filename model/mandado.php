<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class mandado {
	public $conexion;
	private $descripcion;
	private $telefono;
	private $direccion;
	private $latitude;
	private $longitude;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_mandado($id='204',$descripcion,$telefono,$direccion,$latitude,$longitude,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `mandado`(`estado`,`descripcion`,`telefono`,`direccion`,`latitude`,`longitude`) VALUES (:estado,:descripcion,:telefono,:direccion,:latitude,:longitude)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':descripcion' => $descripcion,':telefono' => $telefono,':direccion' => $direccion,':latitude' => $latitude,':longitude' => $longitude));
	return 1;
	}
	public function buscar_mandado(){$sql = "SELECT  * FROM mandado ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_mandado($id, $estado){$sql = "UPDATE `mandado` SET `estado`=:estado WHERE id_mandado=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_mandado($id){$sql = "DELETE FROM `mandado`  WHERE id_mandado=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_mandado($id, $estado,$descripcion,$telefono,$direccion,$latitude,$longitude){
	$sql = "UPDATE `mandado` SET `estado`=:estado ,`descripcion`=:descripcion,`telefono`=:telefono,`direccion`=:direccion,`latitude`=:latitude,`longitude`=:longitude WHERE id_mandado=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':descripcion' => $descripcion,':telefono' => $telefono,':direccion' => $direccion,':latitude' => $latitude,':longitude' => $longitude));
	}
	public function buscar_json_mandado($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function () {
		// Código del método aquí
	}

}
?>