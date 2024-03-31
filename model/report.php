<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class report {
	public $conexion;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function get_user($name, $sexo, $desde, $hasta){	
	$sql = "SELECT  * FROM usuarios where 1 ";
	
	if(!empty($name)){
		$sql =$sql." AND nombre = ". $name;
	}
	if(!empty($sexo)){
		$sql =$sql." AND sexo = ". $sexo;
	}
	if(!empty($edad)){
		$sql =$sql." AND edad = " . $edad;
	}
	if(!empty($desde)){
		$sql =$sql." AND fecha_registro >= '". $desde."'";
	}
	if(!empty($hasta)){
		$sql =$sql." AND fecha_registro <= '". $hasta."'";
	}

	$sql =$sql. " ORDER BY id ASC";

	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }



}
?>