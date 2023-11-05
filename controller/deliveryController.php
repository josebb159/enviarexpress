<?php
include '../model/delivery.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
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
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $foto_cedula)) { die('error foto_cedula');}
}

if(isset($_POST['foto_licencia'])){
	$foto_licencia =  $_POST['foto_licencia'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $foto_licencia)) { die('error foto_licencia');}
}

if(isset($_POST['foto_soat'])){
	$foto_soat =  $_POST['foto_soat'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $foto_soat)) { die('error foto_soat');}
}

if(isset($_POST['foto_tecnomecanica'])){
	$foto_tecnomecanica =  $_POST['foto_tecnomecanica'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $foto_tecnomecanica)) { die('error foto_tecnomecanica');}
}

if(isset($_POST['foto_tarjeta'])){
	$foto_tarjeta =  $_POST['foto_tarjeta'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $foto_tarjeta)) { die('error foto_tarjeta');}
}

if(isset($_POST['propiedad'])){
	$propiedad =  $_POST['propiedad'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $propiedad)) { die('error propiedad');}
}

if(isset($_POST['foto_facial'])){
	$foto_facial =  $_POST['foto_facial'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $foto_facial)) { die('error foto_facial');}
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
	case 'registrar':
		$n_delivery  = new delivery();
		$resultado = $n_delivery  -> registrar_delivery('',$id_usuario,$nombre,$cedula,$foto_cedula,$foto_licencia,$foto_soat,$foto_tecnomecanica,$foto_tarjeta,$propiedad,$foto_facial,$direccion,$numero,$numero_emergencia,'');
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
		$key['id']=$key['id_categoria'];
		?>
		<tr>
			<td><?= $key['id_delivery']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['cedula']; ?></td>
			<td><?= $key['foto_cedula']; ?></td>
			<td><?= $key['foto_licencia']; ?></td>
			<td><?= $key['foto_soat']; ?></td>
			<td><?= $key['foto_tecnomecanica']; ?></td>
			<td><?= $key['foto_tarjeta']; ?></td>
			<td><?= $key['propiedad']; ?></td>
			<td><?= $key['foto_facial']; ?></td>
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
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_delivery']."','".$key['nombre']."','".$key['cedula']."','".$key['foto_cedula']."','".$key['foto_licencia']."','".$key['foto_soat']."','".$key['foto_tecnomecanica']."','".$key['foto_tarjeta']."','".$key['propiedad']."','".$key['foto_facial']."','".$key['direccion']."','".$key['numero']."','".$key['numero_emergencia']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_delivery']; ?>)">Eliminar</a>
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
