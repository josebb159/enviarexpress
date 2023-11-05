<?php
session_start();
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class categoria {
	public $conexion;

	private $descripcion;

	public function __construct()
    {
        $this->conexion = new Conexion();
    }


	public function registrar_categoria($descripcion){
	$estado_defaul = 1;
	$sql = "INSERT INTO `categoria`(`estado`,`descripcion`) VALUES (:estado,:descripcion)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':descripcion' => $descripcion));
	return 1;
	}
	public function buscar_categoria(){$sql = "SELECT  * FROM categoria ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_categoria($id, $estado){$sql = "UPDATE `categoria` SET `estado`=:estado WHERE id_categoria=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_categoria($id){$sql = "DELETE FROM `categoria`  WHERE id_categoria=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_categoria($id,$descripcion){
	$sql = "UPDATE `categoria` SET `descripcion`=:descripcion WHERE id_categoria=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':descripcion' => $descripcion));
	}
	public function buscar_json_categoria($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function datos() {
		// C�digo del m�todo aqu�
	}

}
?>