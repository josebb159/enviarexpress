$(document).ready(function(){
	ver_registros();
	ver_category();
	ver_propietarios();
}); 

function updata_imagen(){
	
	var formData = new FormData();
		var imagenInput = document.getElementById('logoagg');
		formData.append('imagen', imagenInput.files[0]);
		formData.append('op', 'update_imagen');
	
		// Enviar la solicitud Ajax utilizando la función fetch
		fetch('../controller/comerciosController.php', {
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
	

function ver_category(){

	var result = function_ajax({
		'op':'buscar_select'
}	,'../controller/categoryController.php').then(function(result){

	$("#category").html(result);
	$("#categoryagg").html(result);

	}).catch(function(error) {console.log('Error:', error);});
}


function ver_propietarios(){
	alert("a");
	var result = function_ajax({
		'op':'buscar_select_propietarios'
}	,'../controller/comerciosController.php').then(function(result){

	$("#propietary").html(result);
	$("#propietaryagg").html(result);

	}).catch(function(error) {console.log('Error:', error);});
}




function registrar(logo){
	var result = function_ajax({
		'op':'registrar',
		'nombre': $("#nombreagg").val(),
		'id_category': $("#categoryagg").val(),
		'logo': logo,
		'direccion': $("#direccionagg").val(),
		'latitude': $("#latitudeagg").val(),
		'longitude': $("#longitudeagg").val(),
		'telefono': $("#telefonoagg").val(),
		'descripcion': $("#descripcionagg").val(),
		'estado':'1'
}	,'../controller/comerciosController.php').then(function(result){
	if(result=="1"){
		alert_success();
		ver_registros();
		$("#nombreagg").val("");
		$("#categoryagg").val("");
		$("#logoagg").val("");
		$("#direccionagg").val("");
		$("#latitudeagg").val("");
		$("#longitudeagg").val("");
		$("#telefonoagg").val("");
		$("#descripcionagg").val("");
	}
	}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();
	var result = function_ajax({
		'op':'buscar'
}	,'../controller/comerciosController.php').then(function(result){
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
}	,'../controller/comerciosController.php').then(function(result){
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
}			,'../controller/comerciosController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function cargar_datos(id_comercios,nombre,logo,direccion,latitude,longitude,telefono,descripcion,$category){
	$("#id").val(id_comercios);
	$("#nombre").val(nombre);
	$("#category").val(category);
	$("#logo").val(logo);
	$("#direccion").val(direccion);
	$("#latitude").val(latitude);
	$("#longitude").val(longitude);
	$("#telefono").val(telefono);
	$("#descripcion").val(descripcion);
	$("#id_").val(id_);
}

function modificar(){
	var id =  $("#id_comercios").val();
	var nombre =  $("#nombre").val();
	var category =  $("#category").val();
	var logo =  $("#logo").val();
	var direccion =  $("#direccion").val();
	var latitude =  $("#latitude").val();
	var longitude =  $("#longitude").val();
	var telefono =  $("#telefono").val();
	var descripcion =  $("#descripcion").val();
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
				'nombre': nombre,
				'id_category': category,
				'logo': logo,
				'direccion': direccion,
				'latitude': latitude,
				'longitude': longitude,
				'telefono': telefono,
				'descripcion': descripcion,
			},'../controller/comerciosController.php').then(function(result){
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
