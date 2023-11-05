<?php
include '../model/configuracion.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
	$id =  $_POST['id'];
} 

if(isset($_POST['algo_radpio'])){
	$algo_radpio =  $_POST['algo_radpio'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $algo_radpio)) { die('error algo_radpio');}
}

if(isset($_POST['ar_km_adicional'])){
	$ar_km_adicional =  $_POST['ar_km_adicional'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $ar_km_adicional)) { die('error ar_km_adicional');}
}

if(isset($_POST['mejor_ir_con_tiempo'])){
	$mejor_ir_con_tiempo =  $_POST['mejor_ir_con_tiempo'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $mejor_ir_con_tiempo)) { die('error mejor_ir_con_tiempo');}
}

if(isset($_POST['mict_km_adicional'])){
	$mict_km_adicional =  $_POST['mict_km_adicional'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $mict_km_adicional)) { die('error mict_km_adicional');}
}

if(isset($_POST['viaja_en_carro'])){
	$viaja_en_carro =  $_POST['viaja_en_carro'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $viaja_en_carro)) { die('error viaja_en_carro');}
}

if(isset($_POST['vec_km_adicional'])){
	$vec_km_adicional =  $_POST['vec_km_adicional'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $vec_km_adicional)) { die('error vec_km_adicional');}
}

if(isset($_POST['whatsapp'])){
	$whatsapp =  $_POST['whatsapp'];
	if (!preg_match('/^[a-zA-Z0-9\s]{0,100}$/', $whatsapp)) { die('error whatsapp');}
}


if(isset($_POST['estado'])){
	$estado =  $_POST['estado'];
}

if(isset($_POST['op'])){
	$op =  $_POST['op'];
}

switch ($op) {
	case 'registrar':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> registrar_configuracion('',$algo_radpio,$ar_km_adicional,$mejor_ir_con_tiempo,$mict_km_adicional,$viaja_en_carro,$vec_km_adicional,$whatsapp,'');
		echo $resultado;
	break;
	case 'buscar':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> buscar_configuracion();
		if($resultado==0){
			exit();
		}
		foreach ($resultado as $key) {
			if($key['estado']=='1'){
				$st = 'checked';
			}else{
				$st = '';
			}
		$key['id']=$key['id_configuracion'];
		?>




<input type="hidden" value="<?= $key['id_configuracion']; ?>" id="id_configuracion">
				
						<div class="row">
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Algo radpio</label>
									<input type="text" class="form-control" id="algo_radpio" placeholder="algo_radpio" value="<?= $key['algo_radpio']; ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">AR km adicional</label>
									<input type="text" class="form-control" id="ar_km_adicional" placeholder="ar_km_adicional" value="<?= $key['ar_km_adicional']; ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Mejor ir con tiempo</label>
									<input type="text" class="form-control" id="mejor_ir_con_tiempo" placeholder="mejor_ir_con_tiempo" value="<?= $key['mejor_ir_con_tiempo']; ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">MICT km adicional</label>
									<input type="text" class="form-control" id="mict_km_adicional" placeholder="mict_km_adicional" value="<?= $key['mict_km_adicional']; ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">Viaja en carro</label>
									<input type="text" class="form-control" id="viaja_en_carro" placeholder="viaja_en_carro" value="<?= $key['viaja_en_carro']; ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">VEC km adicional</label>
									<input type="text" class="form-control" id="vec_km_adicional" placeholder="vec_km_adicional" value="<?= $key['vec_km_adicional']; ?>" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label">whatsapp</label>
									<input type="text" class="form-control" id="whatsapp" placeholder="whatsapp" value="<?= $key['whatsapp']; ?>" required>
								</div>
							</div>
						</div>
						

						<br>
						<button type="submit" class="btn btn-primary waves-effect waves-light" >Guardar</button>
					

		<?php
		}
	break;
	case 'cambiar_estado':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> cambiar_estado_configuracion($id, $estado);
		echo 1;
	break;
	case 'eliminar':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> eliminar_configuracion($id);
		echo 1;
	break;
	case 'buscar_select':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> buscar_configuracion();
		foreach ($resultado as $key) {
		?>
			<option value="<?php echo $key['id']; ?>"><?php echo $key['descripcion']; ?></option>;
		<?php
		}
	break;
	case 'buscar_json':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> buscar_json_configuracion($id);
		echo $resultado;
	break;
	case 'modificar':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> modificar_configuracion($id,$algo_radpio,$ar_km_adicional,$mejor_ir_con_tiempo,$mict_km_adicional,$viaja_en_carro,$vec_km_adicional,$whatsapp);
		echo 1;
	break;
	case 'rango':
		$n_configuracion  = new configuracion();
		$resultado = $n_configuracion  -> rango($id,$algo_radpio,$ar_km_adicional,$mejor_ir_con_tiempo,$mict_km_adicional,$viaja_en_carro,$vec_km_adicional,$whatsapp,$estado);
	break;
	default:
	break;
}
