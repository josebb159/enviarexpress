<?php
include '../model/medidas.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['$nombre'])){
	$nombre =  $_POST['nombre'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre)) { die('error nombre');}
}

if(isset($_POST['$descripcion'])){
	$descripcion =  $_POST['descripcion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $descripcion)) { die('error descripcion');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_medidas  = new medidas();
		$resultado = $n_medidas  -> registrar_medidas($id,$nombre,$descripcion);
		echo $resultado;
	break;
	case 'buscar':
		$n_medidas  = new medidas();
		$resultado = $n_medidas  -> buscar_medidas();
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
			<td><?= $key['descripcion']; ?></td>
			<td><?= $key['estado']; ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal2" onclick="modificar(<?php echo "'".$key['id']."','".$key['nombre']."','".$key['descripcion']."','".$key['estado']."'"; ?>)">Aprobar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_medidas  = new medidas();
		$resultado = $n_medidas  -> cambiar_estado($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_medidas  = new medidas();
		$resultado = $n_medidas  -> eliminar($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_medidas  = new medidas();
		$resultado = $n_medidas  -> buscar_select();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_medidas  = new medidas();
		$resultado = $n_medidas  -> buscar_json($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_medidas  = new medidas();
		$resultado = $n_medidas  -> modificar($id,$nombre,$descripcion,$estado);
		echo 1;
	break;
	case 'estadisticas':
		$n_medidas  = new medidas();
		$resultado = $n_medidas  -> estadisticas($id,$nombre,$descripcion,$estado);
	break;
	case 'datos_json':
		$n_medidas  = new medidas();
		$resultado = $n_medidas  -> datos_json($id,$nombre,$descripcion,$estado);
	break;
	default:
	break;
}
