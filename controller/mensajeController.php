<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/mensaje.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['mensaje'])){
	$mensaje =  $_POST['mensaje'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $mensaje)) { die('error mensaje');}
}

if(isset($_POST['descripcion'])){
	$descripcion =  $_POST['descripcion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $descripcion)) { die('error descripcion');}
}

if(isset($_POST['tipo'])){
	$tipo =  $_POST['tipo'];
}

if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}



if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_mensaje  = new mensaje();
		$n_mensaje  ->send_notification($tipo, $mensaje);
		$resultado = $n_mensaje  -> registrar_mensaje('',$mensaje,$descripcion, $tipo,'');
		
		echo $resultado;
	break;
	case 'buscar':
		$n_mensaje  = new mensaje();
		$resultado = $n_mensaje  -> buscar_mensaje();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_mensaje'];
		?>
		<tr>
			<td><?= $key['id_mensaje']; ?></td>
			<td><?= $key['mensaje']; ?></td>
			<td><?= $key['descripcion']; ?></td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_mensaje  = new mensaje();
		$resultado = $n_mensaje  -> cambiar_estado_mensaje($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_mensaje  = new mensaje();
		$resultado = $n_mensaje  -> eliminar_mensaje($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_mensaje  = new mensaje();
		$resultado = $n_mensaje  -> buscar_mensaje();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_mensaje  = new mensaje();
		$resultado = $n_mensaje  -> buscar_json_mensaje($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_mensaje  = new mensaje();
		$resultado = $n_mensaje  -> modificar_mensaje($id,$mensaje,$descripcion);
		echo 1;
	break;
	case 'rango':
		$n_mensaje  = new mensaje();
		$resultado = $n_mensaje  -> rango($id,$mensaje,$descripcion,$estado);
	break;
	default:
	break;
}
