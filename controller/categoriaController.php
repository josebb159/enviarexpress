<?php
include '../model/categoria.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['descripcion'])){
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
		$n_categoria  = new categoria();
		$resultado = $n_categoria  -> registrar_categoria($descripcion);
		echo $resultado;
	break;
	case 'buscar':
		$n_categoria  = new categoria();
		$resultado = $n_categoria  -> buscar_categoria();
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
			<td><?= $key['id_categoria']; ?></td>
			<td><?= $key['descripcion']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_categoria']."','".$key['descripcion']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_categoria']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_categoria  = new categoria();
		$resultado = $n_categoria  -> cambiar_estado_categoria($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_categoria  = new categoria();
		$resultado = $n_categoria  -> eliminar_categoria($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_categoria  = new categoria();
		$resultado = $n_categoria  -> buscar_categoria();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_categoria  = new categoria();
		$resultado = $n_categoria  -> buscar_json_categoria($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_categoria  = new categoria();
		$resultado = $n_categoria  -> modificar_categoria($id,$descripcion);
		echo 1;
	break;
	case 'rango':
		$n_categoria  = new categoria();
		$resultado = $n_categoria  -> rango($id,$descripcion,$estado);
	break;
	default:
	break;
}
