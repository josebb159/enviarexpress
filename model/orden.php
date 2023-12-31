<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class orden {
	public $conexion;
	private $descripcion;
	private $cantidad;
	private $valor;


	public function __construct(){
		$this->conexion = new Conexion();
	}
 

	public function registrar_orden($id='204',$descripcion,$cantidad,$valor,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `orden`(`estado`,`descripcion`,`cantidad`,`valor`) VALUES (:estado,:descripcion,:cantidad,:valor)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':descripcion' => $descripcion,':cantidad' => $cantidad,':valor' => $valor));
	return 1;
	}
	public function buscar_orden(){$sql = "SELECT  * FROM orden ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_orden($id, $estado){$sql = "UPDATE `orden` SET `estado`=:estado WHERE id_orden=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_orden($id){$sql = "DELETE FROM `orden`  WHERE id_orden=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_orden($id, $estado,$descripcion,$cantidad,$valor){
	$sql = "UPDATE `orden` SET `estado`=:estado ,`descripcion`=:descripcion,`cantidad`=:cantidad,`valor`=:valor WHERE id_orden=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':descripcion' => $descripcion,':cantidad' => $cantidad,':valor' => $valor));
	}
	public function buscar_json_orden($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function rango() {
		// C�digo del m�todo aqu�
	}

	public function cantidad(){
		$sql = "SELECT  count(*) as cantidad FROM orden ";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} 
	}

}
?>