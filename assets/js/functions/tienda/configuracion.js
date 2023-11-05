$(document).ready(function(){
	ver_registros();
});

function registrar(){
	var result = function_ajax({
		'op':'registrar',
		'algo_radpio': $("#algo_radpioagg").val(),
		'ar_km_adicional': $("#ar_km_adicionalagg").val(),
		'mejor_ir_con_tiempo': $("#mejor_ir_con_tiempoagg").val(),
		'mict_km_adicional': $("#mict_km_adicionalagg").val(),
		'viaja_en_carro': $("#viaja_en_carroagg").val(),
		'vec_km_adicional': $("#vec_km_adicionalagg").val(),
		'whatsapp': $("#whatsappagg").val(),
		'estado':'1'
}	,'../controller/configuracionController.php').then(function(result){
	if(result=="1"){
		alert_success();
		ver_registros();
		$("#algo_radpioagg").val("");
		$("#ar_km_adicionalagg").val("");
		$("#mejor_ir_con_tiempoagg").val("");
		$("#mict_km_adicionalagg").val("");
		$("#viaja_en_carroagg").val("");
		$("#vec_km_adicionalagg").val("");
		$("#whatsappagg").val("");
	}
	}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();
	var result = function_ajax({
		'op':'buscar'
}	,'../controller/configuracionController.php').then(function(result){
	$("#datos").html(result);
	$('#datatable-buttons').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	});
	}).catch(function(error) {console.log('Error:', error);});
}

function cambiar_estado(id, estado){
	if(estado==1){
		estado=0
	}else{
		estado=1
	}
	var result = function_ajax({
		'op':'cambiar_estado',
		'id': id,
		'estado':estado
}	,'../controller/configuracionController.php').then(function(result){
	if(result=="1"){
		alert_success_status();
	}
	}).catch(function(error) {console.log('Error:', error);});
}

function eliminar( id ){
	Swal.fire({
		title: "Estas seguro de eliminar este registro?",
		text: "seleccione las siguentes opciones para continuar!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#1cbb8c",
		cancelButtonColor: "#ff3d60",
		confirmButtonText: "Si, deseo eliminar",
		cancelButtonText: "Cancelar"
	}).then(function (result) {
		if (result.value) {
			var result = function_ajax({
				'op':'eliminar',
				'id': id
}			,'../controller/configuracionController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function cargar_datos(id_configuracion,algo_radpio,ar_km_adicional,mejor_ir_con_tiempo,mict_km_adicional,viaja_en_carro,vec_km_adicional,whatsapp){
	$("#id").val(id_configuracion);
	$("#algo_radpio").val(algo_radpio);
	$("#ar_km_adicional").val(ar_km_adicional);
	$("#mejor_ir_con_tiempo").val(mejor_ir_con_tiempo);
	$("#mict_km_adicional").val(mict_km_adicional);
	$("#viaja_en_carro").val(viaja_en_carro);
	$("#vec_km_adicional").val(vec_km_adicional);
	$("#whatsapp").val(whatsapp);
	$("#id_").val(id_);
}

function modificar(){
	var id =  $("#id_configuracion").val();
	var algo_radpio =  $("#algo_radpio").val();
	var ar_km_adicional =  $("#ar_km_adicional").val();
	var mejor_ir_con_tiempo =  $("#mejor_ir_con_tiempo").val();
	var mict_km_adicional =  $("#mict_km_adicional").val();
	var viaja_en_carro =  $("#viaja_en_carro").val();
	var vec_km_adicional =  $("#vec_km_adicional").val();
	var whatsapp =  $("#whatsapp").val();
	Swal.fire({
		title: "Estas seguro de modificar este registro?",
		text: "seleccione las siguentes opciones para continuar!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#1cbb8c",
		cancelButtonColor: "#ff3d60",
		confirmButtonText: "Si, deseo modificar",
		cancelButtonText: "Cancelar"
	}).then(function (result) {
		if (result.value) {
			var result = function_ajax({
				'op':'modificar',
				'id': id,
				'algo_radpio': algo_radpio,
				'ar_km_adicional': ar_km_adicional,
				'mejor_ir_con_tiempo': mejor_ir_con_tiempo,
				'mict_km_adicional': mict_km_adicional,
				'viaja_en_carro': viaja_en_carro,
				'vec_km_adicional': vec_km_adicional,
				'whatsapp': whatsapp,
			},'../controller/configuracionController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Modificado!", "El registro fue modificado.", "success");
				$('#myModal').modal('hide');
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function alert_success(){
	Swal.fire({
		title: 'Listo, has agregado un registro!',
		text: 'Preciona el boton para aceptar!',
		icon: 'success',
		confirmButtonColor: '#5664d2'
	});
}

function alert_success_status(){
	Swal.fire({
		title: 'Listo, has cambiado el estado del registro!',
		text: 'Preciona el boton para aceptar!',
		icon: 'success',
		confirmButtonColor: '#5664d2'
	});
}

function alert_warning(){
	Swal.fire({
		title: 'Error al registrar!',
		text: 'Preciona el boton para aceptar!',
		icon: 'warning',
		confirmButtonColor: '#5664d2'
	});
}

$('#sa-warning').click(function () {
});

$("#form_1").on('submit', function(evt){
	evt.preventDefault();  
	registrar();
});

$("#form_2").on('submit', function(evt){
	evt.preventDefault();  
	modificar();
});

function function_ajax(data,url){
	return new Promise(function(resolve, reject) {
		$.post({
			type: 'POST',
			url: url,
			data: data,
			success: function(response){
				resolve(response);
			},
			error: function(error) {
				reject(error);
			}
		});
	});
}
