<?php
include '../model/orden.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['descripcion'])){
	$descripcion =  $_POST['descripcion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $descripcion)) { die('error descripcion');}
}

if(isset($_POST['cantidad'])){
	$cantidad =  $_POST['cantidad'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $cantidad)) { die('error cantidad');}
}

if(isset($_POST['valor'])){
	$valor =  $_POST['valor'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $valor)) { die('error valor');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_orden  = new orden();
		$resultado = $n_orden  -> registrar_orden('',$descripcion,$cantidad,$valor,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_orden  = new orden();
		$resultado = $n_orden  -> buscar_orden();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}

			$status_envio="";
			if($key['status_orden_envio']=="1"){
				$status_envio="En espera de Domiciliario";
			}else if($key['status_orden_envio']=="2"){
				$status_envio="En camino";
			}else if($key['status_orden_envio']=="3"){
				$status_envio="Entregado";
			}else if($key['status_orden_envio']=="4"){
				$status_envio="Cancelado";
			}
		$key['id']=$key['id_orden'];
		?>
		<tr>
			<td><?= $key['id_orden']; ?></td>
			<td><?= $key['descripcion']; ?></td>
			<td><?= $status_envio; ?></td>
			<td><?= $key['metodo_pago']; ?></td>
			<td><?= $key['valor']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
														<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#vista_motal"  onclick="ver_lista(<?php echo $key['id_orden']; ?>)">Ver listado compra</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_orden']; ?>)">Cancelar</a>
						</div>
					</div>

			</td>
		</tr>
		<?php
		}
		
	break;
	case 'cambiar_estado':
		$n_orden  = new orden();
		$resultado = $n_orden  -> cambiar_estado_orden($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_orden  = new orden();
		$resultado = $n_orden  -> eliminar_orden($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_orden  = new orden();
		$resultado = $n_orden  -> buscar_orden();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_orden  = new orden();
		$resultado = $n_orden  -> buscar_json_orden($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_orden  = new orden();
		$resultado = $n_orden  -> modificar_orden($id,$descripcion,$cantidad,$valor);
		echo 1;
	break;
	case 'rango':
		$n_orden  = new orden();
		$resultado = $n_orden  -> rango($id,$descripcion,$cantidad,$valor,$estado);
	break;
	case 'cantidad':
		$n_orden  = new orden();
		$resultado = $n_orden  -> cantidad();
		foreach ($resultado as $key) {
			echo $key['cantidad'];
		}
	break;
	default:
	break;
}
