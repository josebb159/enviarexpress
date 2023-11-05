<?php
include '../model/category.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['nombre'])){
	$nombre =  $_POST['nombre'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre)) { die('error nombre');}
}

if(isset($_POST['descripcion'])){
	$descripcion =  $_POST['descripcion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $descripcion)) { die('error descripcion');}
}

if(isset($_POST['img'])){
	$img =  $_POST['img'];

}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'update_imagen':
		$nombreImagen = generarNombreAleatorio(20);
		$archivoImagen = $_FILES['img']['tmp_name'];
		$destinoImagen = '../assets/upload/category/' . $nombreImagen.".jpg";

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
			

	break;
	case 'registrar':
	

		
		$n_category  = new category();
		$resultado = $n_category  -> registrar_category('',$nombre,$descripcion,$img,'');
		echo $resultado;

		$n_notification  = new notificacion_correo();
		$resultado2 = $n_notification  -> buscar_notificacion_correo_action(1);
		foreach($resultado2 as $re){
			emails($re['correo'], "1", $re['nombre'], "Se registro nuevo correo");
		}
	break;
	case 'buscar':
		$n_category  = new category();
		$resultado = $n_category  -> buscar_category();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_category'];
		?>
		<tr>
			<td><?= $key['id_category']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['descripcion']; ?></td>
			<td> <img class="img-thumbnail" src="../assets/upload/category/<?= $key['img']; ?>" alt="Mi imagen" onclick="openModal('../assets/upload/category/<?= $key['img']; ?>')"></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_category']."','".$key['nombre']."','".$key['descripcion']."','".$key['img']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_category']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_category  = new category();
		$resultado = $n_category  -> cambiar_estado_category($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_category  = new category();
		$resultado = $n_category  -> eliminar_category($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_category  = new category();
		$resultado = $n_category  -> buscar_category();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id_category']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_category  = new category();
		$resultado = $n_category  -> buscar_json_category($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_category  = new category();
		$resultado = $n_category  -> modificar_category($id,$nombre,$descripcion,$img);
		echo 1;
	break;
	case 'rango':
		$n_category  = new category();
		$resultado = $n_category  -> rango($id,$nombre,$descripcion,$img,$estado);
	break;
	default:
	break;
}


function generarNombreAleatorio($longitud) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $nombreAleatorio = '';

    for ($i = 0; $i < $longitud; $i++) {
        $indice = rand(0, strlen($caracteres) - 1);
        $nombreAleatorio .= $caracteres[$indice];
    }

    return $nombreAleatorio;
}
