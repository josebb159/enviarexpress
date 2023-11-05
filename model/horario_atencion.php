<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class horario_atencion {
	public $conexion;
	private $lunes_am;
	private $lunes_pm;
	private $martes_am;
	private $mertes_pm;
	private $miercoles_am;
	private $miercoles_pm;
	private $jueves_am;
	private $jueves_pm;
	private $viernes_am;
	private $viernes_pm;
	private $sabado_am;
	private $sabado_pm;
	private $domingo_am;
	private $domingo_pm;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_horario_atencion($id='204',$id_comercios,$lunes_am,$lunes_pm,$martes_am,$mertes_pm,$miercoles_am,$miercoles_pm,$jueves_am,$jueves_pm,$viernes_am,$viernes_pm,$sabado_am,$sabado_pm,$domingo_am,$domingo_pm,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `horario_atencion`(`estado`,`lunes_am`,`lunes_pm`,`martes_am`,`mertes_pm`,`miercoles_am`,`miercoles_pm`,`jueves_am`,`jueves_pm`,`viernes_am`,`viernes_pm`,`sabado_am`,`sabado_pm`,`domingo_am`,`domingo_pm`,`id_comercios`) VALUES (:estado,:lunes_am,:lunes_pm,:martes_am,:mertes_pm,:miercoles_am,:miercoles_pm,:jueves_am,:jueves_pm,:viernes_am,:viernes_pm,:sabado_am,:sabado_pm,:domingo_am,:domingo_pm,:id_comercios)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':lunes_am' => $lunes_am,':lunes_pm' => $lunes_pm,':martes_am' => $martes_am,':mertes_pm' => $mertes_pm,':miercoles_am' => $miercoles_am,':miercoles_pm' => $miercoles_pm,':jueves_am' => $jueves_am,':jueves_pm' => $jueves_pm,':viernes_am' => $viernes_am,':viernes_pm' => $viernes_pm,':sabado_am' => $sabado_am,':sabado_pm' => $sabado_pm,':domingo_am' => $domingo_am,':domingo_pm' => $domingo_pm,':id_comercios' => $id_comercios));
	return 1;
	}
	public function buscar_horario_atencion(){$sql = "SELECT  * FROM horario_atencion ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function buscar_horario_atencion_tienda($id){
		$sql = "SELECT  * FROM horario_atencion where id_comercios='".$id."'";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} }
	public function cambiar_estado_horario_atencion($id, $estado){$sql = "UPDATE `horario_atencion` SET `estado`=:estado WHERE id_horario_atencion=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_horario_atencion($id){$sql = "DELETE FROM `horario_atencion`  WHERE id_horario_atencion=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_horario_atencion( $id_comercios,$lunes_am,$lunes_pm,$martes_am,$mertes_pm,$miercoles_am,$miercoles_pm,$jueves_am,$jueves_pm,$viernes_am,$viernes_pm,$sabado_am,$sabado_pm,$domingo_am,$domingo_pm){
	$sql = "UPDATE `horario_atencion` SET `lunes_am`=:lunes_am,`lunes_pm`=:lunes_pm,`martes_am`=:martes_am,`mertes_pm`=:mertes_pm,`miercoles_am`=:miercoles_am,`miercoles_pm`=:miercoles_pm,`jueves_am`=:jueves_am,`jueves_pm`=:jueves_pm,`viernes_am`=:viernes_am,`viernes_pm`=:viernes_pm,`sabado_am`=:sabado_am,`sabado_pm`=:sabado_pm,`domingo_am`=:domingo_am,`domingo_pm`=:domingo_pm WHERE id_comercios=:id_comercios";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':lunes_am' => $lunes_am,':lunes_pm' => $lunes_pm,':martes_am' => $martes_am,':mertes_pm' => $mertes_pm,':miercoles_am' => $miercoles_am,':miercoles_pm' => $miercoles_pm,':jueves_am' => $jueves_am,':jueves_pm' => $jueves_pm,':viernes_am' => $viernes_am,':viernes_pm' => $viernes_pm,':sabado_am' => $sabado_am,':sabado_pm' => $sabado_pm,':domingo_am' => $domingo_am,':domingo_pm' => $domingo_pm,':id_comercios' => $id_comercios));
	}
	public function buscar_json_horario_atencion($id){$sql = "SELECT  * FROM horario_atencion where id_comercios=".$id."";
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