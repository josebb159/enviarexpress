$(document).ready(function(){

	ver_registros();
	ver_roles();
	ver_comercios();
});


function is_enrutador(value){
	if(value==5){
		$("#tienda_data").show();
	}else{
		$("#tienda_data").hide();
	}
}
 

function updata_imagen(){

	var formData = new FormData();
		var imagenInput = document.getElementById('imagenagg');
		formData.append('imagen', imagenInput.files[0]);
		formData.append('op', 'update_imagen');
	 
		// Enviar la solicitud Ajax utilizando la función fetch
		fetch('../controller/usuarioController.php', {
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

	function updata_imagen2(){
		var imagenInput = document.getElementById('image');
		if (imagenInput.files.length === 0) {
			
			modificar( $("#img").val());
			return 1;
		}
	
		var formData = new FormData();
		
			formData.append('imagen', imagenInput.files[0]);
			formData.append('op', 'update_imagen');
		
			// Enviar la solicitud Ajax utilizando la función fetch
			fetch('../controller/usuarioController.php', {
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
				modificar(nombreImagen);
				// Hacer algo con la respuesta, como mostrar un mensaje de éxito o error
			})
			.catch(function(error) {
				// Manejar cualquier error de la solicitud
				console.error('Error:', error);
			});
		
		}
function registrar(nombreImagen){
	var result = function_ajax({
		'op':'registrar',
		'nombre': $("#nombreagg").val(),
		'correo': $("#correoagg").val(),
		'telefono': $("#telefonoagg").val(),
		'contrasena': $("#contrasenaagg").val(),
		'id_comercio_asociate': $("#tiendaagg").val(),
		'image':nombreImagen,
		'rol': $("#rolagg").val(),
		'estado':'1'
}	,'../controller/usuarioController.php').then(function(result){
	if(result=="1"){
	
		alert_success();
		ver_registros();
		$("#nombreagg").val("");
		$("#correoagg").val("");
		$("#telefonoagg").val("");
		$("#contrasenaagg").val("");
	}
	}).catch(function(error) {console.log('Error:', error);});
}




function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();
	var result = function_ajax({
		'op':'buscar'
}	,'../controller/usuarioController.php').then(function(result){
	$("#datos").html(result);
	$('#datatable-buttons').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	});
	}).catch(function(error) {console.log('Error:', error);});
}



function ver_roles(){

	var result = function_ajax({
		'op':'buscar_select'
}	,'../controller/rolController.php').then(function(result){
	$("#rol").html(result);
	$("#rolagg").html(result);

	}).catch(function(error) {console.log('Error:', error);});
}



function ver_comercios(){

	var result = function_ajax({
		'op':'buscar_select_from_user'
}	,'../controller/comerciosController.php').then(function(result){
	$("#tienda").html(result);
	$("#tiendaagg").html(result);

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
}	,'../controller/usuarioController.php');
	if(result=="1"){
		alert_success();
	}
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
				'op':'cambiar_estado',
				'id': id
}			,'../controller/usuarioController.php');
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
		}
	});
}

function cargar_datos(id,nombre,rol,telefono,correo,img){
	$("#id_usuario").val(id);
	$("#nombre").val(nombre);
	$("#rol").val(rol);
	$("#telefono").val(telefono);
	$("#correo").val(correo);
	$("#img").val(img);


	const imageURL = "https://enviarexpress.com/assets/upload/user/"+img;
	//const imageURL = "http://localhost/enviar/assets/upload/user/"+img;
	// Mostrar la imagen en el elemento de vista previa
	const previewImage = document.getElementById("preview-image");
	previewImage.src = imageURL;

}

function modificar(img){
	var id =  $("#id_usuario").val();
	var nombre =  $("#nombre").val();
	var rol =  $("#rol").val();
	var telefono =  $("#telefono").val();
	var correo =  $("#correo").val();
	var img =  img;
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
				'rol': rol,
				'telefono': telefono,
				'correo': correo,
				'image': img,
			},'../controller/usuarioController.php');
			
				ver_registros();
				Swal.fire("Modificado!", "El registro fue modificado.", "success");
				$('#myModal').modal('hide');
			
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

function alert_warning(){
	Swal.fire({
		title: 'Error al registrar la categoria!',
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
	updata_imagen2();
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
