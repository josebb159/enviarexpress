<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class comercios {
	public $conexion;
	private $nombre;
	private $logo;
	private $direccion;
	private $latitude;
	private $longitude;
	private $telefono;
	private $descripcion; 


	public function __construct(){
		$this->conexion = new Conexion();
	}

 
	public function registrar_comercios($id='204',$nombre,$logo,$direccion,$latitude,$longitude,$telefono,$descripcion,$estado,$category, $propietario, $porcentaje){
	$estado_defaul = 1;
	$sql = "INSERT INTO `comercios`(`estado`,`nombre`,`logo`,`direccion`,`latitude`,`longitude`,`telefono`,`descripcion`,`id_category`, `id_user`,`porcentaje` ) VALUES (:estado,:nombre,:logo,:direccion,:latitude,:longitude,:telefono,:descripcion, :category, :propietario, :porcentaje)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':nombre' => $nombre,':logo' => $logo,':direccion' => $direccion,':latitude' => $latitude,':longitude' => $longitude,':telefono' => $telefono,':descripcion' => $descripcion,':category' => $category, ':propietario' => $propietario, ':porcentaje' => $porcentaje));
	return 1;
	}
	public function buscar_comercios(){
	$sql = "SELECT  *, (select usuarios.nombre from usuarios where usuarios.id=comercios.id_user) as user FROM comercios ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function buscar_select_propietarios(){$sql = "SELECT id,nombre FROM usuarios WHERE id_rol=2 and id NOT IN (SELECT id_user FROM comercios);";
		$reg = $this->conexion->prepare($sql);
		$reg->execute();
		$consulta =$reg->fetchAll();
		if ($consulta) {
			return $consulta;
		}else{
			return 0;
		} }
	public function cambiar_estado_comercios($id, $estado){$sql = "UPDATE `comercios` SET `estado`=:estado WHERE id_comercios=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_comercios($id){$sql = "DELETE FROM `comercios`  WHERE id_comercios=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_comercios($id, $nombre,$logo,$direccion,$latitude,$longitude,$telefono,$descripcion,$category,$porcentaje){
	$sql = "UPDATE `comercios` SET `nombre`=:nombre,`logo`=:logo,`direccion`=:direccion,`latitude`=:latitude,`longitude`=:longitude,`telefono`=:telefono,`descripcion`=:descripcion,`id_category`=:category,`porcentaje`=:porcentaje WHERE id_comercios=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id,':nombre' => $nombre,':logo' => $logo,':direccion' => $direccion,':latitude' => $latitude,':longitude' => $longitude,':telefono' => $telefono,':descripcion' => $descripcion,':category' => $category, ':porcentaje' => $porcentaje));
	}
	public function buscar_json_comercios($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function rango() {
		// C�digo del m�todo aqu�
	}

	public function cantidad(){
		$sql = "SELECT  count(*) as cantidad FROM comercios ";
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