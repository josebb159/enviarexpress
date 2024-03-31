<?php
include '../model/publicidad.php';

if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['tiempo'])){
	$tiempo =  $_POST['tiempo'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $tiempo)) { die('error tiempo');}
}

if(isset($_POST['img'])){
	$img =  $_POST['img'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $img)) { die('error img');}
}

if(isset($_POST['url_public'])){
	$url_public =  $_POST['url_public'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $url_public)) { die('error url_public');}
}

if(isset($_POST['click'])){
	$click =  $_POST['click'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $click)) { die('error click');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_publicidad  = new publicidad();
		$resultado = $n_publicidad  -> registrar_publicidad('',$tiempo,$img,$url_public,$click,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_publicidad  = new publicidad();
		$resultado = $n_publicidad  -> buscar_publicidad();
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
			<td><?= $key['id_publicidad']; ?></td>
			<td><?= $key['tiempo']; ?></td>
			<td><?= $key['img']; ?></td>
			<td><?= $key['url_public']; ?></td>
			<td><?= $key['click']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_publicidad']."','".$key['tiempo']."','".$key['img']."','".$key['url_public']."','".$key['click']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_publicidad']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_publicidad  = new publicidad();
		$resultado = $n_publicidad  -> cambiar_estado_publicidad($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_publicidad  = new publicidad();
		$resultado = $n_publicidad  -> eliminar_publicidad($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_publicidad  = new publicidad();
		$resultado = $n_publicidad  -> buscar_publicidad();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_publicidad  = new publicidad();
		$resultado = $n_publicidad  -> buscar_json_publicidad($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_publicidad  = new publicidad();
		$resultado = $n_publicidad  -> modificar_publicidad($id,$tiempo,$img,$url_public,$click);
		echo 1;
	break;
	case 'estadistic':
		$n_publicidad  = new publicidad();
		$resultado = $n_publicidad  -> estadistic($id,$tiempo,$img,$url_public,$click,$estado);
	break;
	default:
	break;
}
