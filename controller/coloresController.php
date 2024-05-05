<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/colores.php';
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

if(isset($_POST['$codigo'])){
	$codigo =  $_POST['codigo'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $codigo)) { die('error codigo');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_colores  = new colores();
		$resultado = $n_colores  -> registrar_colores($id,$nombre,$descripcion,$codigo);
		echo $resultado;
	break;
	case 'buscar':
		$n_colores  = new colores();
		$resultado = $n_colores  -> buscar_colores();
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
			<td><?= $key['codigo']; ?></td>
			<td><?= $key['estado']; ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal2" onclick="modificar(<?php echo "'".$key['id']."','".$key['nombre']."','".$key['descripcion']."','".$key['codigo']."','".$key['estado']."'"; ?>)">Aprobar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_colores  = new colores();
		$resultado = $n_colores  -> cambiar_estado($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_colores  = new colores();
		$resultado = $n_colores  -> eliminar($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_colores  = new colores();
		$resultado = $n_colores  -> buscar_select();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_colores  = new colores();
		$resultado = $n_colores  -> buscar_json($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_colores  = new colores();
		$resultado = $n_colores  -> modificar($id,$nombre,$descripcion,$codigo,$estado);
		echo 1;
	break;
	case 'datos':
		$n_colores  = new colores();
		$resultado = $n_colores  -> datos($id,$nombre,$descripcion,$codigo,$estado);
	break;
	case 'estadistica':
		$n_colores  = new colores();
		$resultado = $n_colores  -> estadistica($id,$nombre,$descripcion,$codigo,$estado);
	break;
	default:
	break;
}
