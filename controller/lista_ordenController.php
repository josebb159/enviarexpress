<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/lista_orden.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['id_producto'])){
	$id_producto =  $_POST['id_producto'];
}

if(isset($_POST['cantidad'])){
	$cantidad =  $_POST['cantidad'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $cantidad)) { die('error cantidad');}
}

if(isset($_POST['valor_uni'])){
	$valor_uni =  $_POST['valor_uni'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $valor_uni)) { die('error valor_uni');}
}

if(isset($_POST['valor_total'])){
	$valor_total =  $_POST['valor_total'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $valor_total)) { die('error valor_total');}
}

if(isset($_POST['id_orden'])){
	$id_orden =  $_POST['id_orden'];

}

if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_lista_orden  = new lista_orden();
		$resultado = $n_lista_orden  -> registrar_lista_orden('',$id_producto,$cantidad,$valor_uni,$valor_total,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_lista_orden  = new lista_orden();
		$resultado = $n_lista_orden  -> buscar_lista_orden();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_lista_orden'];
		?>
		<tr>
			<td><?= $key['id_lista_orden']; ?></td>
			<td><?= $key['cantidad']; ?></td>
			<td><?= $key['valor_uni']; ?></td>
			<td><?= $key['valor_total']; ?></td>
			<td><?= $key['fecha_registro']; ?></td>
		
			
		</tr>
		<?php
		}
	break;

	case 'buscar_list_orden':
		$n_lista_orden  = new lista_orden();
		$resultado = $n_lista_orden  -> buscar_orden($id_orden);
		if($resultado==0){
			exit();
		}
		$sum=0;
		foreach ($resultado as $key) {
		
		$key['id']=$key['id_lista_orden'];
		?>
		<tr>
			<td><?= $key['id_lista_orden']; ?></td>
			<td><?= $key['nombre']; ?></td>
			<td><?= $key['valor_uni']; ?></td>
			<td><?= $key['cantidad']; ?></td>
			<td><?= $key['valor_total']; ?></td>
		</tr>
		<?php
		$sum =$sum + $key['valor_total'];
		}
		?>

		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><b>TOTAL</b></td>
			<td><?= $sum; ?></td>
		</tr>
<?php 
	break;
	case 'cambiar_estado':
		$n_lista_orden  = new lista_orden();
		$resultado = $n_lista_orden  -> cambiar_estado_lista_orden($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_lista_orden  = new lista_orden();
		$resultado = $n_lista_orden  -> eliminar_lista_orden($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_lista_orden  = new lista_orden();
		$resultado = $n_lista_orden  -> buscar_lista_orden();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_lista_orden  = new lista_orden();
		$resultado = $n_lista_orden  -> buscar_json_lista_orden($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_lista_orden  = new lista_orden();
		$resultado = $n_lista_orden  -> modificar_lista_orden($id,$id_producto,$cantidad,$valor_uni,$valor_total);
		echo 1;
	break;
	case 'rango':
		$n_lista_orden  = new lista_orden();
		$resultado = $n_lista_orden  -> rango($id,$cantidad,$valor_uni,$valor_total,$estado);
	break;
	default:
	break;
}
