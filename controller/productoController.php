<?php
session_start();

print_r($_SESSION);
		die();


include '../model/producto.php';
include '../model/notificacion_correo.php';

		
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['id_comercios'])){
	$id_comercios =  $_POST['id_comercios'];
}

if(isset($_POST['nombre'])){
	$nombre =  $_POST['nombre'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $nombre)) { die('error nombre');}
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
	
}
if(isset($_POST['imagen'])){
	$imagen =  $_POST['imagen'];
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
		$destinoImagen = '../assets/upload/product/' . $nombreImagen.".jpg";

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
		// Guardar la imagen en la ubicación deseada con un nombre aleatorio de 20 caracteres
		
		
		$n_producto  = new producto();
		$resultado = $n_producto  -> registrar_producto('',$id_comercios,$nombre,$descripcion,$cantidad,$imagen,'',$valor);
		
		
		
		echo $resultado;

	break;
	case 'registrar_de_tienda':
		// Guardar la imagen en la ubicación deseada con un nombre aleatorio de 20 caracteres

		
		$n_producto  = new producto();
		$resultado = $n_producto  -> registrar_producto('',$_SESSION['id_tienda'],$nombre,$descripcion,$cantidad,$imagen,'',$valor);
		
		
		
		echo $resultado;

	break;
	case 'buscar_de_tienda':
		$n_producto  = new producto();
		$resultado = $n_producto  -> buscar_producto_tienda($_SESSION['id_usuario']);
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_producto'];
		?>
		<tr>
			<td><?= $key['id_producto']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['descripcion']; ?></td>
			<td><?= $key['cantidad']; ?></td>
			<td><?= $key['valor']; ?></td>
			<td><img width="100" height="200" class="img-thumbnail" src="../assets/upload/product/<?= $key['imagen']; ?>" alt="Mi imagen" onclick="openModal('../assets/upload/product/<?= $key['imagen']; ?>')"></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_producto']."','".$key['nombre']."','".$key['descripcion']."','".$key['cantidad']."','".$key['imagen']."','".$key['valor']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_producto']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'buscar':
		$n_producto  = new producto();
		$resultado = $n_producto  -> buscar_producto();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_producto'];
		?>
		<tr>
			<td><?= $key['id_producto']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['descripcion']; ?></td>
			<td><?= $key['cantidad']; ?></td>
			<td><?= $key['valor']; ?></td>
			<td><img class="img-thumbnail" src="../assets/upload/product/<?= $key['imagen']; ?>" alt="Mi imagen" onclick="openModal('../assets/upload/product/<?= $key['imagen']; ?>')"></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_producto']."','".$key['nombre']."','".$key['descripcion']."','".$key['cantidad']."','".$key['imagen']."','".$key['valor']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_producto']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_producto  = new producto();
		$resultado = $n_producto  -> cambiar_estado_producto($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_producto  = new producto();
		$resultado = $n_producto  -> eliminar_producto($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_producto  = new producto();
		$resultado = $n_producto  -> buscar_producto();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_producto  = new producto();
		$resultado = $n_producto  -> buscar_json_producto($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_producto  = new producto();
		$resultado = $n_producto  -> modificar_producto($id,$nombre,$descripcion,$cantidad,$imagen,$valor);
		echo 1;
	break;
	case 'modificar_comercio':
		$n_producto  = new producto();
		$resultado = $n_producto  -> modificar_producto_comercio($id,$id_comercios,$nombre,$descripcion,$cantidad,$imagen,$valor);
		echo 1;
	break;
	case 'rango':
		$n_producto  = new producto();
		$resultado = $n_producto  -> rango($id,$nombre,$descripcion,$cantidad,$imagen,$estado);
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
