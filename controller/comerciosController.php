<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/comercios.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['nombre'])){
	$nombre =  $_POST['nombre'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre)) { die('error nombre');}
}

if(isset($_POST['id_category'])){
	$id_category =  $_POST['id_category'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre)) { die('error nombre');}
}

if(isset($_POST['logo'])){
	$logo =  $_POST['logo'];

}

if(isset($_POST['direccion'])){
	$direccion =  $_POST['direccion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $direccion)) { die('error direccion');}
}

if(isset($_POST['latitude'])){
	$latitude =  $_POST['latitude'];

}

if(isset($_POST['longitude'])){
	$longitude =  $_POST['longitude'];

}

if(isset($_POST['telefono'])){
	$telefono =  $_POST['telefono'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $telefono)) { die('error telefono');}
}

if(isset($_POST['descripcion'])){
	$descripcion =  $_POST['descripcion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $descripcion)) { die('error descripcion');}
}
if(isset($_POST['propietario'])){
	$propietario =  $_POST['propietario'];

}

if(isset($_POST['porcentaje'])){
	$porcentaje =  $_POST['porcentaje'];
}

if(isset($_POST['tipo_pago'])){
	$tipo_pago =  $_POST['tipo_pago'];
}

if(isset($_POST['nombreusu'])){
	$nombreusu =  $_POST['nombreusu'];
}


if(isset($_POST['correo'])){
	$correo =  $_POST['correo'];
}


if(isset($_POST['telefono'])){
	$telefono =  $_POST['telefono'];
}


if(isset($_POST['contrasena'])){
	$contrasena =  $_POST['contrasena'];
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
		$archivoImagen = $_FILES['imagen']['tmp_name'];
		$destinoImagen = '../assets/upload/commerce/' . $nombreImagen.".jpg";

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


	
		$n_comercios  = new comercios();

		$id_user = $n_comercios -> registrar_usuario("4", $nombreusu,  $contrasena,$correo, $telefono,"");
		$resultado = $n_comercios  -> registrar_comercios('',$nombre,$logo,$direccion,$latitude,$longitude,$telefono,$descripcion,'', $id_category, $id_user, $porcentaje,$tipo_pago );
		
		
		
		echo $resultado;



	break;
	case 'buscar':
		$n_comercios  = new comercios();
		$resultado = $n_comercios  -> buscar_comercios();

		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}


		$key['id']=$key['id_comercios'];
		?>
		<tr>
			<td><?= $key['id_comercios']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['user'] ?: "No posee"  ; ?></td>
			<td><img class="img-thumbnail preview-image2" style="width: 100px; height:100px" src="../assets/upload/commerce/<?= $key['logo']; ?>" alt="Mi imagen" onclick="openModal('../assets/upload/commerce/<?= $key['logo']; ?>')"></td>
			<td><?= $key['direccion']; ?></td>
			<td><?= $key['telefono']; ?></td>
			<td><?= $key['descripcion']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos( <?php echo "'".$key['id_comercios']."','".$key['nombre']."','".$key['logo']."','".$key['direccion']."','".$key['latitude']."','".$key['longitude']."','".$key['telefono']."','".$key['descripcion']."','".$key['id_category']."','".$key['porcentaje']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_comercios']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_comercios  = new comercios();
		$resultado = $n_comercios  -> cambiar_estado_comercios($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_comercios  = new comercios();
		$resultado = $n_comercios  -> eliminar_comercios($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_comercios  = new comercios();
		$resultado = $n_comercios  -> buscar_comercios();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_select_from_user':
		$n_comercios  = new comercios();
		$resultado = $n_comercios  -> buscar_comercios();

		?>
			<option value="">Seleccione</option>;
		<?php 
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id_comercios']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_select_propietarios':
		$n_comercios  = new comercios();
		$resultado = $n_comercios  -> buscar_select_propietarios();
		if($resultado == 0){
			break;
		}
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['nombre']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_comercios  = new comercios();
		$resultado = $n_comercios  -> buscar_json_comercios($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_comercios  = new comercios();
		$resultado = $n_comercios  -> modificar_comercios($id,$nombre,$logo,$direccion,$latitude,$longitude,$telefono,$descripcion,$id_category, $porcentaje );
		echo 1;
	break;
	case 'modificar2':
		$n_comercios  = new comercios();
		$resultado = $n_comercios  -> modificar_comercios($id,$nombre,$logo,$direccion,$latitude,$longitude,$telefono,$descripcion);
		echo 1;
	break;
	case 'rango':
		$n_comercios  = new comercios();
		$resultado = $n_comercios  -> rango($id,$nombre,$logo,$direccion,$latitude,$longitude,$telefono,$descripcion,$estado);
	break;
	case 'cantidad':
		$n_comercios  = new comercios();
		$resultado = $n_comercios  -> cantidad();
		foreach ($resultado as $key) {
			echo $key['cantidad'];
		}
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
