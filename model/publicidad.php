<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class publicidad {
	public $conexion;
	private $tiempo;
	private $img;
	private $url_public;
	private $click;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_publicidad($id='204',$tiempo,$img,$url_public,$click,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `publicidad`(`estado`,`tiempo`,`img`,`url_public`,`click`) VALUES (:estado,:tiempo,:img,:url_public,:click)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':tiempo' => $tiempo,':img' => $img,':url_public' => $url_public,':click' => $click));
	return 1;
	}
	public function buscar_publicidad(){$sql = "SELECT  * FROM publicidad ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_publicidad($id, $estado){$sql = "UPDATE `publicidad` SET `estado`=:estado WHERE id_publicidad=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_publicidad($id){$sql = "DELETE FROM `publicidad`  WHERE id_publicidad=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_publicidad($data){
		$sql = "UPDATE `publicidad` SET  `tiempo`=:tiempo,`url_public`=:url_public, click=1 WHERE id_publicidad=:id";
		$reg = $this->conexion->prepare($sql);
		$reg->execute(array(':id' => $data['id'], ':tiempo' => $data['tiempo']  ,':url_public' => $data['url'] ));



		if(isset($_FILES['img']['tmp_name'])){
			$nombreImagen = $this->generarNombreAleatorio(20);
			$archivoImagen = $_FILES['img']['tmp_name'];
			$destinoImagen = '../assets/upload/publicidad/' . $nombreImagen.".jpg";
	
			if (move_uploaded_file($archivoImagen, $destinoImagen)) {
				// La imagen se ha guardado correctamente
				// Puedes realizar otras operaciones aquí, como guardar los datos en una base de datos
				// o realizar alguna otra tarea adicional
		
				echo json_encode(array('status' => 'success', 'message' => 'Imagen guardada correctamente', 'nombreImagen' => $nombreImagen.".jpg"));
				// Envía una respuesta a Ajax indicando que todo ha ido bien
			///	echo json_encode(array('status' => 'success', 'message' => 'Imagen guardada correctamente'));
			} else {
				// Ocurrió un error al guardar la imagen
				//echo json_encode(array('status' => 'error', 'message' => 'Error al guardar la imagen'));
			}
	
			$sql = "UPDATE `publicidad` SET `img`=:img WHERE id_publicidad=:id";
			$reg = $this->conexion->prepare($sql);
			$reg->execute(array(':id' => $data['id'],':img' =>$nombreImagen  ));
		}



	}
	public function buscar_json_publicidad($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function estadistic() {
		// C�digo del m�todo aqu�
	}

	public function generarNombreAleatorio($longitud) {
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$nombreAleatorio = '';
	
		for ($i = 0; $i < $longitud; $i++) {
			$indice = rand(0, strlen($caracteres) - 1);
			$nombreAleatorio .= $caracteres[$indice];
		}
	
		return $nombreAleatorio;
	}
	

}
?>