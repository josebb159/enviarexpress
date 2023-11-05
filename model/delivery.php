<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class delivery {
	public $conexion;
	private $nombre;
	private $cedula;
	private $foto_cedula;
	private $foto_licencia;
	private $foto_soat;
	private $foto_tecnomecanica;
	private $foto_tarjeta;
	private $propiedad;
	private $foto_facial;
	private $direccion;
	private $numero;
	private $numero_emergencia;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_delivery($id='204',$id_usuario,$nombre,$cedula,$foto_cedula,$foto_licencia,$foto_soat,$foto_tecnomecanica,$foto_tarjeta,$propiedad,$foto_facial,$direccion,$numero,$numero_emergencia,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `delivery`(`estado`,`nombre`,`cedula`,`foto_cedula`,`foto_licencia`,`foto_soat`,`foto_tecnomecanica`,`foto_tarjeta`,`propiedad`,`foto_facial`,`direccion`,`numero`,`numero_emergencia`,`id_usuario`) VALUES (:estado,:nombre,:cedula,:foto_cedula,:foto_licencia,:foto_soat,:foto_tecnomecanica,:foto_tarjeta,:propiedad,:foto_facial,:direccion,:numero,:numero_emergencia,:id_usuario)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':cedula' => $cedula,':foto_cedula' => $foto_cedula,':foto_licencia' => $foto_licencia,':foto_soat' => $foto_soat,':foto_tecnomecanica' => $foto_tecnomecanica,':foto_tarjeta' => $foto_tarjeta,':propiedad' => $propiedad,':foto_facial' => $foto_facial,':direccion' => $direccion,':numero' => $numero,':numero_emergencia' => $numero_emergencia,':id_usuario' => $id_usuario));
	return 1;
	}
	public function buscar_delivery(){$sql = "SELECT  * FROM delivery ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_delivery($id, $estado){$sql = "UPDATE `delivery` SET `estado`=:estado WHERE id_delivery=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_delivery($id){$sql = "DELETE FROM `delivery`  WHERE id_delivery=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_delivery($id, $estado,$id_usuario,$nombre,$cedula,$foto_cedula,$foto_licencia,$foto_soat,$foto_tecnomecanica,$foto_tarjeta,$propiedad,$foto_facial,$direccion,$numero,$numero_emergencia){
	$sql = "UPDATE `delivery` SET `estado`=:estado ,`nombre`=:nombre,`cedula`=:cedula,`foto_cedula`=:foto_cedula,`foto_licencia`=:foto_licencia,`foto_soat`=:foto_soat,`foto_tecnomecanica`=:foto_tecnomecanica,`foto_tarjeta`=:foto_tarjeta,`propiedad`=:propiedad,`foto_facial`=:foto_facial,`direccion`=:direccion,`numero`=:numero,`numero_emergencia`=:numero_emergencia,`id_usuario`=:id_usuario WHERE id_delivery=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':nombre' => $nombre,':cedula' => $cedula,':foto_cedula' => $foto_cedula,':foto_licencia' => $foto_licencia,':foto_soat' => $foto_soat,':foto_tecnomecanica' => $foto_tecnomecanica,':foto_tarjeta' => $foto_tarjeta,':propiedad' => $propiedad,':foto_facial' => $foto_facial,':direccion' => $direccion,':numero' => $numero,':numero_emergencia' => $numero_emergencia,':id_usuario' => $id_usuario));
	}
	public function buscar_json_delivery($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function calculo() {
		// Código del método aquí
	}

}
?>