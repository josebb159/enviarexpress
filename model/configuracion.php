<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class configuracion {
	public $conexion;
	private $algo_radpio;
	private $ar_km_adicional;
	private $mejor_ir_con_tiempo;
	private $mict_km_adicional;
	private $viaja_en_carro;
	private $vec_km_adicional;
	private $whatsapp;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_configuracion($id='204',$algo_radpio,$ar_km_adicional,$mejor_ir_con_tiempo,$mict_km_adicional,$viaja_en_carro,$vec_km_adicional,$whatsapp,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `configuracion`(`estado`,`algo_radpio`,`ar_km_adicional`,`mejor_ir_con_tiempo`,`mict_km_adicional`,`viaja_en_carro`,`vec_km_adicional`,`whatsapp`) VALUES (:estado,:algo_radpio,:ar_km_adicional,:mejor_ir_con_tiempo,:mict_km_adicional,:viaja_en_carro,:vec_km_adicional,:whatsapp)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':algo_radpio' => $algo_radpio,':ar_km_adicional' => $ar_km_adicional,':mejor_ir_con_tiempo' => $mejor_ir_con_tiempo,':mict_km_adicional' => $mict_km_adicional,':viaja_en_carro' => $viaja_en_carro,':vec_km_adicional' => $vec_km_adicional,':whatsapp' => $whatsapp));
	return 1;
	}
	public function buscar_configuracion(){$sql = "SELECT  * FROM configuracion ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_configuracion($id, $estado){$sql = "UPDATE `configuracion` SET `estado`=:estado WHERE id_configuracion=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_configuracion($id){$sql = "DELETE FROM `configuracion`  WHERE id_configuracion=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_configuracion($id, $algo_radpio,$ar_km_adicional,$mejor_ir_con_tiempo,$mict_km_adicional,$viaja_en_carro,$vec_km_adicional,$whatsapp){
	$sql = "UPDATE `configuracion` SET `algo_radpio`=:algo_radpio,`ar_km_adicional`=:ar_km_adicional,`mejor_ir_con_tiempo`=:mejor_ir_con_tiempo,`mict_km_adicional`=:mict_km_adicional,`viaja_en_carro`=:viaja_en_carro,`vec_km_adicional`=:vec_km_adicional,`whatsapp`=:whatsapp WHERE id_configuracion=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':algo_radpio' => $algo_radpio,':ar_km_adicional' => $ar_km_adicional,':mejor_ir_con_tiempo' => $mejor_ir_con_tiempo,':mict_km_adicional' => $mict_km_adicional,':viaja_en_carro' => $viaja_en_carro,':vec_km_adicional' => $vec_km_adicional,':whatsapp' => $whatsapp));
	}
	public function buscar_json_configuracion($id){$sql = "SELECT  * FROM rol where id=".$id."";
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