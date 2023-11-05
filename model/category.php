<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class category {
	public $conexion;
	private $nombre;
	private $descripcion;
	private $img;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_category($id='204',$nombre,$descripcion,$img,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `category`(`estado`,`nombre`,`descripcion`,`img`) VALUES (:estado,:nombre,:descripcion,:img)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':descripcion' => $descripcion,':img' => $img));
	return 1;
	}
	public function buscar_category(){$sql = "SELECT  * FROM category ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_category($id, $estado){$sql = "UPDATE `category` SET `estado`=:estado WHERE id_category=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_category($id){$sql = "DELETE FROM `category`  WHERE id_category=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_category($id, $nombre,$descripcion,$img){
	$sql = "UPDATE `category` SET `nombre`=:nombre,`descripcion`=:descripcion,`img`=:img WHERE id_category=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':nombre' => $nombre,':descripcion' => $descripcion,':img' => $img));
	}
	public function buscar_json_category($id){$sql = "SELECT  * FROM rol where id=".$id."";
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