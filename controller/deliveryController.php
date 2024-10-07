<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/delivery.php';
include '../model/notificacion_correo.php';
include '../model/usuario.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}


if(isset($_POST['correo'])){
	$correo =  $_POST['correo'];
}

if(isset($_POST['contrasena'])){
	$contrasena =  $_POST['contrasena'];
}

if(isset($_POST['id_usuario'])){
	$id_usuario =  $_POST['id_usuario'];
}

if(isset($_POST['id_usuario'])){
	$id_usuario =  $_POST['id_usuario'];
}

if(isset($_POST['nombre'])){
	$nombre =  $_POST['nombre'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre)) { die('error nombre');}
}

if(isset($_POST['cedula'])){
	$cedula =  $_POST['cedula'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $cedula)) { die('error cedula');}
}

if(isset($_POST['foto_cedula'])){
	$foto_cedula =  $_POST['foto_cedula'];

}

if(isset($_POST['foto_licencia'])){
	$foto_licencia =  $_POST['foto_licencia'];

}

if(isset($_POST['foto_soat'])){
	$foto_soat =  $_POST['foto_soat'];

}

if(isset($_POST['foto_tecnomecanica'])){
	$foto_tecnomecanica =  $_POST['foto_tecnomecanica'];

}

if(isset($_POST['foto_tarjeta'])){
	$foto_tarjeta =  $_POST['foto_tarjeta'];

}

if(isset($_POST['propiedad'])){
	$propiedad =  $_POST['propiedad'];

}

if(isset($_POST['foto_facial'])){
	$foto_facial =  $_POST['foto_facial'];

}

if(isset($_POST['direccion'])){
	$direccion =  $_POST['direccion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $direccion)) { die('error direccion');}
}

if(isset($_POST['numero'])){
	$numero =  $_POST['numero'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $numero)) { die('error numero');}
}

if(isset($_POST['numero_emergencia'])){
	$numero_emergencia =  $_POST['numero_emergencia'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $numero_emergencia)) { die('error numero_emergencia');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {

	case 'update_imagen':
		$foto_cedula = generarNombreAleatorio(20);
		$foto_licencia = generarNombreAleatorio(20);
		$foto_soat = generarNombreAleatorio(20);
		$foto_tecnomecanica = generarNombreAleatorio(20);
		$foto_tarjeta = generarNombreAleatorio(20);
		$propieda = generarNombreAleatorio(20);
		$foto_faciala = generarNombreAleatorio(20);

		$foto_cedulaagg = $_FILES['foto_cedulaagg']['tmp_name'];
		$foto_licenciaagg = $_FILES['foto_licenciaagg']['tmp_name'];
		$foto_soatagg = $_FILES['foto_soatagg']['tmp_name'];
		$foto_tecnomecanicaagg = $_FILES['foto_tecnomecanicaagg']['tmp_name'];
		$foto_tarjetaagg = $_FILES['foto_tarjetaagg']['tmp_name'];
		$propiedadagg = $_FILES['propiedadagg']['tmp_name'];
		$foto_facialagg = $_FILES['foto_facialagg']['tmp_name'];



		$destinofoto_cedula = '../assets/upload/delivery/' . $foto_cedula.".jpg";
		$destinofoto_licencia = '../assets/upload/delivery/' . $foto_licencia.".jpg";
		$destinofoto_soat = '../assets/upload/delivery/' . $foto_soat.".jpg";
		$destinofoto_tecnomecanica = '../assets/upload/delivery/' . $foto_tecnomecanica.".jpg";
		$destinofoto_tarjeta = '../assets/upload/delivery/' . $foto_tarjeta.".jpg";
		$destinopropiedada = '../assets/upload/delivery/' . $propieda.".jpg";
		$destinofoto_faciala = '../assets/upload/delivery/' . $foto_faciala.".jpg";

		if (move_uploaded_file($foto_cedulaagg, $destinofoto_cedula)) {
			move_uploaded_file($foto_licenciaagg, $destinofoto_licencia);
			move_uploaded_file($foto_soatagg, $destinofoto_soat);
			move_uploaded_file($foto_tecnomecanicaagg, $destinofoto_tecnomecanica);
			move_uploaded_file($foto_tarjetaagg, $destinofoto_tarjeta);
			move_uploaded_file($propiedadagg, $destinopropiedada);
			move_uploaded_file($foto_facialagg, $destinofoto_faciala);


			// La imagen se ha guardado correctamente
			// Puedes realizar otras operaciones aquí, como guardar los datos en una base de datos
			// o realizar alguna otra tarea adicional
	
			echo json_encode(array('status' => 'success', 'message' => 
			'Imagen guardada correctamente', 
			'foto_cedula' => $foto_cedula.".jpg",
			'foto_licencia' => $foto_licencia.".jpg",
			'foto_soat' => $foto_soat.".jpg",
			'foto_tecnomecanica' => $foto_tecnomecanica.".jpg",
			'foto_tarjeta' => $foto_tarjeta.".jpg",
			'propieda' => $propieda.".jpg",
			'foto_faciala' => $foto_faciala.".jpg"));
			// Envía una respuesta a Ajax indicando que todo ha ido bien
		///	echo json_encode(array('status' => 'success', 'message' => 'Imagen guardada correctamente'));
		} else {
			// Ocurrió un error al guardar la imagen
			//echo json_encode(array('status' => 'error', 'message' => 'Error al guardar la imagen'));
		}
			

	break;
	case 'registrar':
		$n_delivery  = new delivery();
		$n_usuario  = new usuario();
     
		$id_user = $n_usuario -> registrar_usuario_delivery(3, $nombre,  $contrasena, $correo, $numero,"");
		
		$resultado = $n_delivery  -> registrar_delivery('',$id_user,$nombre,$cedula,$foto_cedula,$foto_licencia,$foto_soat,$foto_tecnomecanica,$foto_tarjeta,$propiedad,$foto_facial,$direccion,$numero,$numero_emergencia,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_delivery  = new delivery();
		$resultado = $n_delivery  -> buscar_delivery();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		
		?>
		<tr>
			<td><?= $key['id']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['cedula']; ?></td>
			<td><img class="img-thumbnail preview-image2" style="max-width: 100px; max-height: 100px;" src="../assets/upload/delivery/<?= $key['foto_cedula']; ?>" alt="Mi imagen" onclick="openModal('../assets/upload/delivery/<?= $key['foto_cedula']; ?>')"></td>
			<td><img class="img-thumbnail preview-image20" style="max-width: 100px; max-height: 100px;" src="../assets/upload/delivery/<?= $key['foto_licencia']; ?>" alt="Mi imagen" onclick="openModal('../assets/upload/delivery/<?= $key['foto_licencia']; ?>')"></td>
			<td><img class="img-thumbnail preview-image2" style="max-width: 100px; max-height: 100px;" src="../assets/upload/delivery/<?= $key['foto_soat']; ?>" alt="Mi imagen" onclick="openModal('../assets/upload/delivery/<?= $key['foto_soat']; ?>')"></td>
			<td><img class="img-thumbnail preview-image2" style="max-width: 100px; max-height: 100px;" src="../assets/upload/delivery/<?= $key['foto_tecnomecanica']; ?>" alt="Mi imagen" onclick="openModal('../assets/upload/delivery/<?= $key['foto_tecnomecanica']; ?>')"></td>
			<td><img class="img-thumbnail preview-image2" style="max-width: 100px; max-height: 100px;" src="../assets/upload/delivery/<?= $key['foto_tarjeta']; ?>" alt="Mi imagen" onclick="openModal('../assets/upload/delivery/<?= $key['foto_tarjeta']; ?>')"></td>
			<td><img class="img-thumbnail preview-image2" style="max-width: 100px; max-height: 100px;" src="../assets/upload/delivery/<?= $key['propiedad']; ?>" alt="Mi imagen" onclick="openModal('../assets/upload/delivery/<?= $key['propiedad']; ?>')"></td>
			<td><img class="img-thumbnail preview-image2" style="max-width: 100px; max-height: 100px;" src="../assets/upload/delivery/<?= $key['foto_facial']; ?>" alt="Mi imagen" onclick="openModal('../assets/upload/delivery/<?= $key['foto_facial']; ?>')"></td>
			<td><?= $key['direccion']; ?></td>
			<td><?= $key['numero']; ?></td>
			<td><?= $key['numero_emergencia']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id']."','".$key['nombre']."','".$key['cedula']."','".$key['foto_cedula']."','".$key['foto_licencia']."','".$key['foto_soat']."','".$key['foto_tecnomecanica']."','".$key['foto_tarjeta']."','".$key['propiedad']."','".$key['foto_facial']."','".$key['direccion']."','".$key['numero']."','".$key['numero_emergencia']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_delivery  = new delivery();
		$resultado = $n_delivery  -> cambiar_estado_delivery($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_delivery  = new delivery();
		$resultado = $n_delivery  -> eliminar_delivery($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_delivery  = new delivery();
		$resultado = $n_delivery  -> buscar_delivery();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_delivery  = new delivery();
		$resultado = $n_delivery  -> buscar_json_delivery($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_delivery  = new delivery();
		$resultado = $n_delivery  -> modificar_delivery($id,$id_usuario,$nombre,$cedula,$foto_cedula,$foto_licencia,$foto_soat,$foto_tecnomecanica,$foto_tarjeta,$propiedad,$foto_facial,$direccion,$numero,$numero_emergencia);
		echo 1;
	break;
	case 'calculo':
		$n_delivery  = new delivery();
		$resultado = $n_delivery  -> calculo($id,$nombre,$cedula,$foto_cedula,$foto_licencia,$foto_soat,$foto_tecnomecanica,$foto_tarjeta,$propiedad,$foto_facial,$direccion,$numero,$numero_emergencia,$estado);
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
