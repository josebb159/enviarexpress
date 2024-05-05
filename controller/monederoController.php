<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/monedero.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
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
		$n_monedero  = new monedero();
		$resultado = $n_monedero  -> registrar_monedero('',$valor,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_monedero  = new monedero();
		$resultado = $n_monedero  -> buscar_monedero();
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
			<td><?= $key['id_monedero']; ?></td>
			<td><?= $key['valor']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_monedero']."','".$key['valor']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_monedero']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_monedero  = new monedero();
		$resultado = $n_monedero  -> cambiar_estado_monedero($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_monedero  = new monedero();
		$resultado = $n_monedero  -> eliminar_monedero($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_monedero  = new monedero();
		$resultado = $n_monedero  -> buscar_monedero();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_monedero  = new monedero();
		$resultado = $n_monedero  -> buscar_json_monedero($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_monedero  = new monedero();
		$resultado = $n_monedero  -> modificar_monedero($id,$valor);
		echo 1;
	break;
	case 'rango':
		$n_monedero  = new monedero();
		$resultado = $n_monedero  -> rango($id,$valor,$estado);
	break;
	default:
	break;
}
