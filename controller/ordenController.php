<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/orden.php';
include '../model/notificacion_correo.php';
session_start();
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['descripcion'])){
	$descripcion =  $_POST['descripcion'];

}


if(isset($_POST['tipo_pago'])){
	$tipo_pago =  $_POST['tipo_pago'];

}

if(isset($_POST['cantidad'])){
	$cantidad =  $_POST['cantidad'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $cantidad)) { die('error cantidad');}
}

if(isset($_POST['valor'])){
	$valor =  $_POST['valor'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $valor)) { die('error valor');}
}

if(isset($_POST['cliente'])){
	$cliente =  $_POST['cliente'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $valor)) { die('error valor');}
}

if(isset($_POST['img'])){
	$img =  $_POST['img'];
}

if(isset($_POST['telefono'])){
	$telefono =  $_POST['telefono'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $valor)) { die('error valor');}
}


if(isset($_POST['direccion'])){
	$direccion =  $_POST['direccion'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $valor)) { die('error valor');}
}



if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'update_imagen':
		$nombreImagen = generarNombreAleatorio(20);
		$archivoImagen = $_FILES['imagen']['tmp_name'];
		$destinoImagen = '../assets/upload/bill/' . $nombreImagen.".jpg";
		if (move_uploaded_file($archivoImagen, $destinoImagen)) {
			// La imagen se ha guardado correctamente
			// Puedes realizar otras operaciones aquí, como guardar los datos en una base de datos
			// o realizar alguna otra tarea adicional
	
			echo json_encode(array('status' => 'success', 'message' => 'Imagen guardada correctamente', 'nombreImagen' => $nombreImagen.".jpg"));
			// Envía una respuesta a Ajax indicando que todo ha ido bien
		///	echo json_encode(array('status' => 'success', 'message' => 'Imagen guardada correctamente'));
		} else {
			// Ocurrió un error al guardar la imagen
			//echo json_encode(array('status' => 'error', 'message' => 'Error al guardar la imagen'));
		}
	break;
	case 'registrar':
		$n_orden  = new orden();
		$resultado = $n_orden  -> registrar_orden('',$descripcion,$cantidad,$valor,'');
		echo $resultado;
	break;
	case 'registrar_orden':
		$n_orden  = new orden();
		$id_usuario =  $n_orden  ->registrar_temporal_user($cliente, $telefono, $direccion);
		$resultado = $n_orden  -> registrar_orden_tienda('',$descripcion,$cantidad,$valor,$_SESSION['id_usuario'],$id_usuario ,$img,$tipo_pago );
		//echo $resultado;
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
			$data_list = ",'".$key['nombre_cliente']."','".$key['nombre_repartidor']."'";
		$key['id']=$key['id_orden'];
		?>
		<tr>
			<td><?= $key['id_orden']; ?></td>
			<td><?= $key['nombre_cliente']; ?></td>
			<td><?= $key['nombre_repartidor']; ?></td>
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
														<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#vista_motal"  onclick="ver_lista(<?php echo $key['id_orden'].$data_list; ?>)">Ver listado compra</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_orden']; ?>)">Cancelar</a>
						</div>
					</div>

			</td>
		</tr>
		<?php
		}
		
	break;
	case 'buscar_orden_tienda_general':
		$n_orden  = new orden();
		$resultado = $n_orden  -> buscar_orden_tienda_general();
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
				$status_envio="Aceptado por repartidor";
			}else if($key['status_orden_envio']=="3"){
				$status_envio="En camino";
			}else if($key['status_orden_envio']=="4"){
				$status_envio="Entregado";
			}else if($key['status_orden_envio']=="5"){
				$status_envio="Cancelado";
			}
			$data_list = ",'".$key['nombre_cliente']."','".$key['nombre_repartidor']."'";
		$key['id']=$key['id_orden'];
		?>
		<tr>
			<td><?= $key['id_orden']; ?></td>
			<td><?= $key['nombre_cliente']; ?></td>
			<td><?= $key['direccion']; ?></td>
			<td><?= $key['telefono']; ?></td>
			<td><?= $key['tienda']; ?></td>
			<td><?= $status_envio; ?></td>
		
			<td>
				<button type="button"  class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_agregar">Enrutar</button>
			</td>
		</tr>
		<?php
		}
		
	break;
	case 'buscar_orden_tienda':
		$n_orden  = new orden();
		$resultado = $n_orden  -> buscar_orden_tienda($_SESSION['id_usuario']);
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
				$status_envio="Aceptado por repartidor";
			}else if($key['status_orden_envio']=="3"){
				$status_envio="En camino";
			}else if($key['status_orden_envio']=="4"){
				$status_envio="Entregado";
			}else if($key['status_orden_envio']=="5"){
				$status_envio="Cancelado";
			}
			$data_list = ",'".$key['nombre_cliente']."','".$key['nombre_repartidor']."'";
		$key['id']=$key['id_orden'];
		?>
		<tr>
			<td><?= $key['id_orden']; ?></td>
			<td><?= $key['descripcion']; ?></td>
			<td><?= $key['valor']; ?></td>
			<td><?= $status_envio; ?></td>
			<td><?= $key['nombre_cliente'] ?: $key['nombre_cliente_tienda']; ?></td>
			<td><?= $key['nombre_repartidor'] ?: "Sin domiciliario"; ?></td>
			<td><?= $key['metodo_pago'] ?: "Sin metodo de pago"; ?></td>
			
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
														<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#vista_motal"  onclick="ver_lista(<?php echo $key['id_orden'].$data_list; ?>)">Ver listado compra</a>
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
	case 'buscar_domiciliarios_disponibles':
		$n_orden  = new orden();
		$resultado = $n_orden  -> buscar_domiciliarios_disponibles();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['nombre']; ?></option>;
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


function generarNombreAleatorio($longitud) {
	$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$nombreAleatorio = '';
 
	for ($i = 0; $i < $longitud; $i++) {
		$indice = rand(0, strlen($caracteres) - 1);
		$nombreAleatorio .= $caracteres[$indice];
	}
 
	return $nombreAleatorio;
 }
 
 
