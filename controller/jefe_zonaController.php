<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/jefe_zona.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['id_delivery'])){
	$id_delivery =  $_POST['id_delivery'];
}

if(isset($_POST['nombre'])){
	$nombre =  $_POST['nombre'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre)) { die('error nombre');}
}

if(isset($_POST['sector'])){
	$sector =  $_POST['sector'];

}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_jefe_zona  = new jefe_zona();
		$resultado = $n_jefe_zona  -> registrar_jefe_zona($nombre,$sector);
		echo $resultado;
	break;
	case 'buscar':
		$n_jefe_zona  = new jefe_zona();
		$resultado = $n_jefe_zona  -> buscar_jefe_zona();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_jefe_zona'];
		?>
		<tr>
			<td><?= $key['id']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['sector']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['nombre']."','".$key[' sector']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_jefe_zona']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_jefe_zona  = new jefe_zona();
		$resultado = $n_jefe_zona  -> cambiar_estado_jefe_zona($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_jefe_zona  = new jefe_zona();
		$resultado = $n_jefe_zona  -> eliminar_jefe_zona($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_jefe_zona  = new jefe_zona();
		$resultado = $n_jefe_zona  -> buscar_jefe_zona();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_jefe_zona  = new jefe_zona();
		$resultado = $n_jefe_zona  -> buscar_json_jefe_zona($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_jefe_zona  = new jefe_zona();
		$resultado = $n_jefe_zona  -> modificar_jefe_zona($id,$nombre,$sector);
		echo 1;
	break;
	case 'rango':
		$n_jefe_zona  = new jefe_zona();
		$resultado = $n_jefe_zona  -> rango($id,$nombre,$sector,$estado);
	break;
	default:
	break;
}
