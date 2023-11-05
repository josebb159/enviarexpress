<?php
include '../model/direccion.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['id_usuarios'])){
	$id_usuarios =  $_POST['id_usuarios'];
}

if(isset($_POST['nombre'])){
	$nombre =  $_POST['nombre'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre)) { die('error nombre');}
}

if(isset($_POST['direccion'])){
	$direccion =  $_POST['direccion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $direccion)) { die('error direccion');}
}

if(isset($_POST['telefono'])){
	$telefono =  $_POST['telefono'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $telefono)) { die('error telefono');}
}

if(isset($_POST['latitude'])){
	$latitude =  $_POST['latitude'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $latitude)) { die('error latitude');}
}

if(isset($_POST['longitude'])){
	$longitude =  $_POST['longitude'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $longitude)) { die('error longitude');}
}

if(isset($_POST['seleccionado'])){
	$seleccionado =  $_POST['seleccionado'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $seleccionado)) { die('error seleccionado');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_direccion  = new direccion();
		$resultado = $n_direccion  -> registrar_direccion('',$id_usuarios,$nombre,$direccion,$telefono,$latitude,$longitude,$seleccionado,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_direccion  = new direccion();
		$resultado = $n_direccion  -> buscar_direccion();
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
			<td><?= $key['id_direccion']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['direccion']; ?></td>
			<td><?= $key['telefono']; ?></td>
			<td><?= $key['latitude']; ?></td>
			<td><?= $key['longitude']; ?></td>
			<td><?= $key['seleccionado']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_direccion']."','".$key['nombre']."','".$key['direccion']."','".$key['telefono']."','".$key['latitude']."','".$key['longitude']."','".$key['seleccionado']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_direccion']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_direccion  = new direccion();
		$resultado = $n_direccion  -> cambiar_estado_direccion($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_direccion  = new direccion();
		$resultado = $n_direccion  -> eliminar_direccion($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_direccion  = new direccion();
		$resultado = $n_direccion  -> buscar_direccion();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_direccion  = new direccion();
		$resultado = $n_direccion  -> buscar_json_direccion($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_direccion  = new direccion();
		$resultado = $n_direccion  -> modificar_direccion($id,$id_usuarios,$nombre,$direccion,$telefono,$latitude,$longitude,$seleccionado);
		echo 1;
	break;
	case 'rango':
		$n_direccion  = new direccion();
		$resultado = $n_direccion  -> rango($id,$nombre,$direccion,$telefono,$latitude,$longitude,$seleccionado,$estado);
	break;
	default:
	break;
}
