$(document).ready(function(){
	ver_registros();
});


function updata_imagen(){
	var formData = new FormData();
		var imagenInput = document.getElementById('imagenagg');
		formData.append('imagen', imagenInput.files[0]);
		formData.append('op', 'update_imagen');
	 
		// Enviar la solicitud Ajax utilizando la función fetch
		fetch('../controller/ordenController.php', {
			method: 'POST',
			body: formData
		})
		.then(function(response) {
			return response.json();
		})
		.then(function(data) {
			// Manejar la respuesta del servidor
			console.log(data);
			var nombreImagen = data.nombreImagen;
			registrar(nombreImagen);
			// Hacer algo con la respuesta, como mostrar un mensaje de éxito o error
		})
		.catch(function(error) {
			// Manejar cualquier error de la solicitud
			console.error('Error:', error);
		});
	
	} 

function registrar(img){
	var result = function_ajax({
		'op':'registrar_orden',
		'img' : img,
		'tipo_pago': $("#tipo_pagoaagg").val(),
		'cliente': $("#clienteagg").val(),
		'telefono': $("#telefonoagg").val(),
		'direccion': $("#direccionagg").val(),
		'descripcion': $("#descripcionagg").val(),
		'cantidad': $("#cantidadagg").val(),
		'valor': $("#valoragg").val(),
		'ordenExternal': $("#ordenagg").val(),
		'tiempo': $("#tiempoagg").val(),
		'estado':'1'
}	,'../controller/ordenController.php').then(function(result){

		alert_success();
		ver_registros();
		$("#descripcionagg").val("");
		$("#cantidadagg").val("");
		$("#valoragg").val("");

	}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();
	var result = function_ajax({
		'op':'buscar_orden_tienda'
}	,'../controller/ordenController.php').then(function(result){
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
}	,'../controller/ordenController.php').then(function(result){
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
}			,'../controller/ordenController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function cargar_datos(id_orden,descripcion,cantidad,valor){
	$("#id").val(id_orden);
	$("#descripcion").val(descripcion);
	$("#cantidad").val(cantidad);
	$("#valor").val(valor);
	$("#id_").val(id_);
}

function modificar(){
	var id =  $("#id_orden").val();
	var descripcion =  $("#descripcion").val();
	var cantidad =  $("#cantidad").val();
	var valor =  $("#valor").val();
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
				'descripcion': descripcion,
				'cantidad': cantidad,
				'valor': valor,
			},'../controller/ordenController.php').then(function(result){
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
