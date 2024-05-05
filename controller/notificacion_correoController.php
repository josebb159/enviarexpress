<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/notificacion_correo.php';

if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['correo'])){
	$correo =  $_POST['correo'];

}

if(isset($_POST['accion'])){
	$accion =  $_POST['accion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $accion)) { die('error accion');}
}

if(isset($_POST['nombre'])){
	$nombre =  $_POST['nombre'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre)) { die('error accion');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_notificacion_correo  = new notificacion_correo();
		$resultado = $n_notificacion_correo  -> registrar_notificacion_correo('',$correo,$accion,$nombre,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_notificacion_correo  = new notificacion_correo();
		$resultado = $n_notificacion_correo  -> buscar_notificacion_correo();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
			

		$acciones= ['Registro nuevo usuario',
		'Registro domiciliario'
		,'Se realizo una orgen',
		'Se realizo una recarga al monedero',
		'Registro comercio',
		'Se realizo un reclamo',
		'Se califico un domiciliario',
		'Se califico un comercio',
		'Se finalizo una orden',
		'Se realizo un mandado',
		'Se finalizo un mandado',
		'El comercio agrego un nuevo prodcuto',
		'Registro jefe de zona'];

		$key['id']=$key['id_notificacion_correo'];
		?> 
		<tr>
			<td><?= $key['id_notificacion_correo']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['correo']; ?></td>
			<td><?= $acciones[$key['accion']-1]; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_notificacion_correo']."','".$key['correo']."','".$key['accion']."','".$key['nombre']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_notificacion_correo']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_notificacion_correo  = new notificacion_correo();
		$resultado = $n_notificacion_correo  -> cambiar_estado_notificacion_correo($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_notificacion_correo  = new notificacion_correo();
		$resultado = $n_notificacion_correo  -> eliminar_notificacion_correo($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_notificacion_correo  = new notificacion_correo();
		$resultado = $n_notificacion_correo  -> buscar_notificacion_correo();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_notificacion_correo  = new notificacion_correo();
		$resultado = $n_notificacion_correo  -> buscar_json_notificacion_correo($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_notificacion_correo  = new notificacion_correo();
		$resultado = $n_notificacion_correo  -> modificar_notificacion_correo($id,$correo,$accion);
		echo 1;
	break;
	case 'rango':
		$n_notificacion_correo  = new notificacion_correo();
		$resultado = $n_notificacion_correo  -> rango($id,$correo,$accion,$estado);
	break;
	default:
	break;
}
