<?php
include '../model/horario_atencion.php';
include '../model/notificacion_correo.php';
session_start();
if(isset($_POST['id'])){
	$id =  $_POST['id'];
}

if(isset($_POST['id_comercios'])){
	$id_comercios =  $_POST['id_comercios'];
}

if(isset($_POST['lunes_am'])){
	$lunes_am =  $_POST['lunes_am'];

}

if(isset($_POST['lunes_pm'])){
	$lunes_pm =  $_POST['lunes_pm'];

}

if(isset($_POST['martes_am'])){
	$martes_am =  $_POST['martes_am'];

}

if(isset($_POST['mertes_pm'])){
	$mertes_pm =  $_POST['mertes_pm'];

}

if(isset($_POST['miercoles_am'])){
	$miercoles_am =  $_POST['miercoles_am'];

}

if(isset($_POST['miercoles_pm'])){
	$miercoles_pm =  $_POST['miercoles_pm'];

}

if(isset($_POST['jueves_am'])){
	$jueves_am =  $_POST['jueves_am'];

}

if(isset($_POST['jueves_pm'])){
	$jueves_pm =  $_POST['jueves_pm'];

}

if(isset($_POST['viernes_am'])){
	$viernes_am =  $_POST['viernes_am'];

}

if(isset($_POST['viernes_pm'])){
	$viernes_pm =  $_POST['viernes_pm'];

}

if(isset($_POST['sabado_am'])){
	$sabado_am =  $_POST['sabado_am'];

}

if(isset($_POST['sabado_pm'])){
	$sabado_pm =  $_POST['sabado_pm'];

}

if(isset($_POST['domingo_am'])){
	$domingo_am =  $_POST['domingo_am'];

}

if(isset($_POST['domingo_pm'])){
	$domingo_pm =  $_POST['domingo_pm'];

}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_horario_atencion  = new horario_atencion();
		$resultado = $n_horario_atencion  -> buscar_horario_atencion_tienda($_SESSION['id_tienda']);
		if($resultado==0){
		
		$resultado = $n_horario_atencion  -> registrar_horario_atencion('',$_SESSION['id_tienda'],$lunes_am,$lunes_pm,$martes_am,$mertes_pm,$miercoles_am,$miercoles_pm,$jueves_am,$jueves_pm,$viernes_am,$viernes_pm,$sabado_am,$sabado_pm,$domingo_am,$domingo_pm,'');
		}else{
		
			$resultado = $n_horario_atencion  -> modificar_horario_atencion($_SESSION['id_tienda'],$lunes_am,$lunes_pm,$martes_am,$mertes_pm,$miercoles_am,$miercoles_pm,$jueves_am,$jueves_pm,$viernes_am,$viernes_pm,$sabado_am,$sabado_pm,$domingo_am,$domingo_pm);
		}
		echo "1";
	break;
	case 'buscar':
		$n_horario_atencion  = new horario_atencion();
		$resultado = $n_horario_atencion  -> buscar_horario_atencion();
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
			<td><?= $key['id_horario_atencion']; ?></td>
			<td><?= $key['lunes_am']; ?></td>
			<td><?= $key['lunes_pm']; ?></td>
			<td><?= $key['martes_am']; ?></td>
			<td><?= $key['mertes_pm']; ?></td>
			<td><?= $key['miercoles_am']; ?></td>
			<td><?= $key['miercoles_pm']; ?></td>
			<td><?= $key['jueves_am']; ?></td>
			<td><?= $key['jueves_pm']; ?></td>
			<td><?= $key['viernes_am']; ?></td>
			<td><?= $key['viernes_pm']; ?></td>
			<td><?= $key['sabado_am']; ?></td>
			<td><?= $key['sabado_pm']; ?></td>
			<td><?= $key['domingo_am']; ?></td>
			<td><?= $key['domingo_pm']; ?></td>
			<td><?php include '../view/static/bt_estado.php';  ?></td>
			<td>
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Acciones
						<i class="mdi mdi-chevron-down"></i>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
							<a class="dropdown-item" href="#"  data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos(<?php echo "'".$key['id_horario_atencion']."','".$key['lunes_am']."','".$key['lunes_pm']."','".$key['martes_am']."','".$key['mertes_pm']."','".$key['miercoles_am']."','".$key['miercoles_pm']."','".$key['jueves_am']."','".$key['jueves_pm']."','".$key['viernes_am']."','".$key['viernes_pm']."','".$key['sabado_am']."','".$key['sabado_pm']."','".$key['domingo_am']."','".$key['domingo_pm']."'"; ?>)">Modificar</a>
							<a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id_horario_atencion']; ?>)">Eliminar</a>
						</div>
					</div>
			</td>
		</tr>
		<?php
		}
	break;
	case 'cambiar_estado':
		$n_horario_atencion  = new horario_atencion();
		$resultado = $n_horario_atencion  -> cambiar_estado_horario_atencion($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_horario_atencion  = new horario_atencion();
		$resultado = $n_horario_atencion  -> eliminar_horario_atencion($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_horario_atencion  = new horario_atencion();
		$resultado = $n_horario_atencion  -> buscar_horario_atencion();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_horario_atencion  = new horario_atencion();
		$resultado = $n_horario_atencion  -> buscar_json_horario_atencion($_SESSION['id_tienda']);
		echo $resultado;
	break;
	case 'modificar':
		$n_horario_atencion  = new horario_atencion();
		$resultado = $n_horario_atencion  -> modificar_horario_atencion($id,$id_comercios,$lunes_am,$lunes_pm,$martes_am,$mertes_pm,$miercoles_am,$miercoles_pm,$jueves_am,$jueves_pm,$viernes_am,$viernes_pm,$sabado_am,$sabado_pm,$domingo_am,$domingo_pm);
		echo 1;
	break;
	case 'rango':
		$n_horario_atencion  = new horario_atencion();
		$resultado = $n_horario_atencion  -> rango($id,$lunes_am,$lunes_pm,$martes_am,$mertes_pm,$miercoles_am,$miercoles_pm,$jueves_am,$jueves_pm,$viernes_am,$viernes_pm,$sabado_am,$sabado_pm,$domingo_am,$domingo_pm,$estado);
	break;
	default:
	break;
}
