<?php 
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class jefe_zona {
	public $conexion;
	private $nombre;
	private $sector;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_jefe_zona($nombre,$sector){
	$estado_defaul = 1;
	$sql = "INSERT INTO `jefe_zona`(`estado`,`nombre`, `sector`) VALUES (:estado,:nombre,:sector)";

	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':sector' => $sector));
	return 1;
	}
	public function buscar_jefe_zona(){$sql = "SELECT  * FROM jefe_zona ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_jefe_zona($id, $estado){$sql = "UPDATE `jefe_zona` SET `estado`=:estado WHERE id_jefe_zona=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_jefe_zona($id){$sql = "DELETE FROM `jefe_zona`  WHERE id_jefe_zona=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_jefe_zona($id,$nombre,$sector){
	$sql = "UPDATE `jefe_zona` SET `estado`=:estado ,`nombre`=:nombre,` sector`=: sector,`id_delivery`=:id_delivery WHERE id_jefe_zona=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':nombre' => $nombre,': sector' => $sector,':id_delivery' => $id_delivery));
	}
	public function buscar_json_jefe_zona($id){$sql = "SELECT  * FROM rol where id=".$id."";
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