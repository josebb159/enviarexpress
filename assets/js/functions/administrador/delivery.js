$(document).ready(function(){
	ver_registros();
});

function registrar(){
	var result = function_ajax({
		'op':'registrar',
		'id_usuario': $("#id_usuarioagg").val(),
		'nombre': $("#nombreagg").val(),
		'cedula': $("#cedulaagg").val(),
		'foto_cedula': $("#foto_cedulaagg").val(),
		'foto_licencia': $("#foto_licenciaagg").val(),
		'foto_soat': $("#foto_soatagg").val(),
		'foto_tecnomecanica': $("#foto_tecnomecanicaagg").val(),
		'foto_tarjeta': $("#foto_tarjetaagg").val(),
		'propiedad': $("#propiedadagg").val(),
		'foto_facial': $("#foto_facialagg").val(),
		'direccion': $("#direccionagg").val(),
		'numero': $("#numeroagg").val(),
		'numero_emergencia': $("#numero_emergenciaagg").val(),
		'estado':'1'
}	,'../controller/deliveryController.php').then(function(result){
	if(result=="1"){
		alert_success();
		ver_registros();
		$("#nombreagg").val("");
		$("#cedulaagg").val("");
		$("#foto_cedulaagg").val("");
		$("#foto_licenciaagg").val("");
		$("#foto_soatagg").val("");
		$("#foto_tecnomecanicaagg").val("");
		$("#foto_tarjetaagg").val("");
		$("#propiedadagg").val("");
		$("#foto_facialagg").val("");
		$("#direccionagg").val("");
		$("#numeroagg").val("");
		$("#numero_emergenciaagg").val("");
		$("#id_usuarioagg").val("");
	}
	}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();
	var result = function_ajax({
		'op':'buscar'
}	,'../controller/deliveryController.php').then(function(result){
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
}	,'../controller/deliveryController.php').then(function(result){
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
}			,'../controller/deliveryController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function cargar_datos(id_delivery,id_usuario,nombre,cedula,foto_cedula,foto_licencia,foto_soat,foto_tecnomecanica,foto_tarjeta,propiedad,foto_facial,direccion,numero,numero_emergencia){
	$("#id").val(id_delivery);
	$("#nombre").val(nombre);
	$("#cedula").val(cedula);
	$("#foto_cedula").val(foto_cedula);
	$("#foto_licencia").val(foto_licencia);
	$("#foto_soat").val(foto_soat);
	$("#foto_tecnomecanica").val(foto_tecnomecanica);
	$("#foto_tarjeta").val(foto_tarjeta);
	$("#propiedad").val(propiedad);
	$("#foto_facial").val(foto_facial);
	$("#direccion").val(direccion);
	$("#numero").val(numero);
	$("#numero_emergencia").val(numero_emergencia);
	$("#id_usuario").val(id_usuario);
}

function modificar(){
	var id =  $("#id_delivery").val();
	var usuario =  $("#id_usuario").val();
	var nombre =  $("#nombre").val();
	var cedula =  $("#cedula").val();
	var foto_cedula =  $("#foto_cedula").val();
	var foto_licencia =  $("#foto_licencia").val();
	var foto_soat =  $("#foto_soat").val();
	var foto_tecnomecanica =  $("#foto_tecnomecanica").val();
	var foto_tarjeta =  $("#foto_tarjeta").val();
	var propiedad =  $("#propiedad").val();
	var foto_facial =  $("#foto_facial").val();
	var direccion =  $("#direccion").val();
	var numero =  $("#numero").val();
	var numero_emergencia =  $("#numero_emergencia").val();
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
				'usuario': id_usuario,
				'nombre': nombre,
				'cedula': cedula,
				'foto_cedula': foto_cedula,
				'foto_licencia': foto_licencia,
				'foto_soat': foto_soat,
				'foto_tecnomecanica': foto_tecnomecanica,
				'foto_tarjeta': foto_tarjeta,
				'propiedad': propiedad,
				'foto_facial': foto_facial,
				'direccion': direccion,
				'numero': numero,
				'numero_emergencia': numero_emergencia,
			},'../controller/deliveryController.php').then(function(result){
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
