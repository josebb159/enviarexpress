<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class logs {
	public $conexion;

	public function __construct(){
		$this->conexion = new Conexion();
	}



	public function buscar_logs(){$sql = "SELECT  * FROM logs ";
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