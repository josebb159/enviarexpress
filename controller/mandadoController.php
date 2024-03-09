<?php
include '../model/mandado.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['descripcion'])){
	$descripcion =  $_POST['descripcion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $descripcion)) { die('error descripcion');}
}

if(isset($_POST['telefono'])){
	$telefono =  $_POST['telefono'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $telefono)) { die('error telefono');}
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


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
	
		$n_mandado  = new mandado();
		$resultado = $n_mandado  -> registrar_mandado('',$descripcion,$telefono,$direccion,$latitude,$longitude,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_mandado  = new mandado();
		$resultado = $n_mandado  -> buscar_mandado();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_mandado'];
		?>
		<tr>
			<td><?= $key['id_mandado']; ?></td>
			<td><?= $key['descripcion']; ?></td>
			<td><?= $key['telefono']; ?></td>
			<td><?= $key['direccion']; ?></td>

			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<!--<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_mandado']."','".$key['descripcion']."','".$key['telefono']."','".$key['direccion']."','".$key['latitude']."','".$key['longitude']."'"; ?>)">Modificar</a> -->
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_mandado']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_mandado  = new mandado();
		$resultado = $n_mandado  -> cambiar_estado_mandado($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_mandado  = new mandado();
		$resultado = $n_mandado  -> eliminar_mandado($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_mandado  = new mandado();
		$resultado = $n_mandado  -> buscar_mandado();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_mandado  = new mandado();
		$resultado = $n_mandado  -> buscar_json_mandado($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_mandado  = new mandado();
	//	$resultado = $n_mandado  -> modificar_mandado($id,$descripcion,$telefono,$direccion,$latitude,$longitude);
		echo 1;
	break;
	case 'test':
		$n_mandado  = new mandado();
		//$resultado = $n_mandado  -> ($id,$descripcion,$telefono,$direccion,$latitude,$longitude,$estado);
	break;
	default:
	break;
}
