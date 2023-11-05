<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class lista_orden {
	public $conexion;
	private $cantidad;
	private $valor_uni;
	private $valor_total;

 
	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_lista_orden($id='204',$id_producto,$cantidad,$valor_uni,$valor_total,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `lista_orden`(`estado`,`cantidad`,`valor_uni`,`valor_total`,`id_producto`) VALUES (:estado,:cantidad,:valor_uni,:valor_total,:id_producto)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':cantidad' => $cantidad,':valor_uni' => $valor_uni,':valor_total' => $valor_total,':id_producto' => $id_producto));
	return 1;
	}
	public function buscar_lista_orden(){$sql = "SELECT  * FROM lista_orden ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function buscar_orden($id){$sql = "SELECT  lista_orden.id_lista_orden, producto.nombre, lista_orden.valor_uni, lista_orden.cantidad, lista_orden.valor_total FROM lista_orden
	LEFT JOIN producto on producto.id_producto=lista_orden.id_producto where id_orden=".$id."";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} }
	public function cambiar_estado_lista_orden($id, $estado){$sql = "UPDATE `lista_orden` SET `estado`=:estado WHERE id_lista_orden=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_lista_orden($id){$sql = "DELETE FROM `lista_orden`  WHERE id_lista_orden=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_lista_orden($id, $estado,$id_producto,$cantidad,$valor_uni,$valor_total){
	$sql = "UPDATE `lista_orden` SET `estado`=:estado ,`cantidad`=:cantidad,`valor_uni`=:valor_uni,`valor_total`=:valor_total,`id_producto`=:id_producto WHERE id_lista_orden=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':cantidad' => $cantidad,':valor_uni' => $valor_uni,':valor_total' => $valor_total,':id_producto' => $id_producto));
	}
	public function buscar_json_lista_orden($id){$sql = "SELECT  * FROM rol where id=".$id."";
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