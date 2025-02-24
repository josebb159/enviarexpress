$(document).ready(function(){
	ver_registros();
});

function updata_imagen(){

	var formData = new FormData();
		var foto_cedulaagg = document.getElementById('foto_cedulaagg');
		var foto_licenciaagg = document.getElementById('foto_licenciaagg');
		var foto_soatagg = document.getElementById('foto_soatagg');
		var foto_tecnomecanicaagg = document.getElementById('foto_tecnomecanicaagg');
		var foto_tarjetaagg = document.getElementById('foto_tarjetaagg');
		var propiedadagg = document.getElementById('propiedadagg');
		var foto_facialagg = document.getElementById('foto_facialagg');




		formData.append('foto_cedulaagg', foto_cedulaagg.files[0]);
		formData.append('foto_licenciaagg', foto_licenciaagg.files[0]);
		formData.append('foto_soatagg', foto_soatagg.files[0]);
		formData.append('foto_tecnomecanicaagg', foto_tecnomecanicaagg.files[0]);
		formData.append('foto_tarjetaagg', foto_tarjetaagg.files[0]);
		formData.append('propiedadagg', propiedadagg.files[0]);
		formData.append('foto_facialagg', foto_facialagg.files[0]);
		formData.append('op', 'update_imagen');
	 
		// Enviar la solicitud Ajax utilizando la función fetch
		fetch('../controller/deliveryController.php', {
			method: 'POST',
			body: formData
		})
		.then(function(response) {
			return response.json();
		})
		.then(function(data) {
			// Manejar la respuesta del servidor
			console.log(data);
			var foto_cedula = data.foto_cedula;
			var foto_licencia = data.foto_licencia;
			var foto_soat = data.foto_soat;
			var foto_tecnomecanica = data.foto_tecnomecanica;
			var propieda = data.propieda;
			var foto_faciala = data.foto_faciala;
			var foto_tarjeta = data.foto_tarjeta;

			registrar(foto_cedula, foto_licencia,foto_soat, foto_tecnomecanica,propieda, foto_faciala,foto_tarjeta);
			// Hacer algo con la respuesta, como mostrar un mensaje de éxito o error
		})
		.catch(function(error) {
			// Manejar cualquier error de la solicitud
			console.error('Error:', error);
		});
	
	} 

function registrar(foto_cedula, foto_licencia,foto_soat, foto_tecnomecanica,propieda, foto_faciala,foto_tarjeta){
	var result = function_ajax({
		'op':'registrar',
		'nombre': $("#nombreagg").val(),
		'cedula': $("#cedulaagg").val(),
		'correo': $("#correoagg").val(),
		'contrasena': $("#contrasenaagg").val(),
		'foto_cedula': foto_cedula,
		'foto_licencia': foto_licencia,
		'foto_soat': foto_soat,
		'foto_tecnomecanica': foto_tecnomecanica,
		'foto_tarjeta': foto_tarjeta,
		'propiedad': propieda,
		'foto_facial': foto_faciala,
		'direccion': $("#direccionagg").val(),
		'numero': $("#numeroagg").val(),
		'numero_emergencia': $("#numero_emergenciaagg").val(),
		'estado':'1'
}	,'../controller/deliveryController.php').then(function(result){
	if(result=="1"){
		alert_success();
		ver_registros();
		$("#nombreagg").val("");
		$("#correoagg").val("");
		$("#contrasenaagg").val("");
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

function validar( id ){
	Swal.fire({
		title: "Estas seguro que quiere validar este delivery?",
		text: "seleccione las siguentes opciones para continuar!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#1cbb8c",
		cancelButtonColor: "#ff3d60",
		confirmButtonText: "Si, deseo validar",
		cancelButtonText: "Cancelar"
	}).then(function (result) {
		if (result.value) {
			var result = function_ajax({
				'op':'validar',
				'id': id
}			,'../controller/deliveryController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Validado!", "El registro fue validado, sera enviado al delivery un correo con sus credenciales.", "success");
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
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
	updata_imagen();
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
