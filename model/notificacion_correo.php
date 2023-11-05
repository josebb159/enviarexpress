<?php
require "../framework/phpmailer/index.php";
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class notificacion_correo {
	public $conexion;
	private $correo;
	private $accion;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_notificacion_correo($id='204',$correo,$accion,$nombre,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `notificacion_correo`(`estado`,`correo`,`accion`,`nombre`) VALUES (:estado,:correo,:accion,:nombre)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':correo' => $correo,':accion' => $accion,':nombre' => $nombre));
	return 1;
	}
	public function buscar_notificacion_correo(){$sql = "SELECT  * FROM notificacion_correo ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function buscar_notificacion_correo_action($code){$sql = "SELECT  * FROM notificacion_correo where accion=".$code.";";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} }
	public function cambiar_estado_notificacion_correo($id, $estado){$sql = "UPDATE `notificacion_correo` SET `estado`=:estado WHERE id_notificacion_correo=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_notificacion_correo($id){$sql = "DELETE FROM `notificacion_correo`  WHERE id_notificacion_correo=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_notificacion_correo($id, $estado,$correo,$accion){
	$sql = "UPDATE `notificacion_correo` SET `estado`=:estado ,`correo`=:correo,`accion`=:accion WHERE id_notificacion_correo=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':correo' => $correo,':accion' => $accion));
	}
	public function buscar_json_notificacion_correo($id){$sql = "SELECT  * FROM rol where id=".$id."";
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