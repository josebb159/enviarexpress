<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class rol {
	public $conexion;
	private $nombre;
	private $descripcion;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_rol($id='204',$nombre,$descripcion,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `rol`(`estado`,`nombre`,`descripcion`) VALUES (:estado,:nombre,:descripcion)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':descripcion' => $descripcion));
	return 1;
	}
	public function buscar_rol(){$sql = "SELECT  * FROM rol ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_rol($id, $estado){$sql = "UPDATE `rol` SET `estado`=:estado WHERE id_rol=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_rol($id){$sql = "DELETE FROM `rol`  WHERE id_rol=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_rol($id, $estado,$nombre,$descripcion){
	$sql = "UPDATE `rol` SET `estado`=:estado ,`nombre`=:nombre,`descripcion`=:descripcion WHERE id_rol=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':nombre' => $nombre,':descripcion' => $descripcion));
	}
	public function buscar_json_rol($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}


}
?>