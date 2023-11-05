$(document).ready(function(){
	ver_registros();
});



function updata_imagen(){
	
	var formData = new FormData();
		var imagenInput = document.getElementById('logoagg');
		formData.append('img', imagenInput.files[0]);
		formData.append('op', 'update_imagen');
	
		// Enviar la solicitud Ajax utilizando la función fetch
		fetch('../controller/categoryController.php', {
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
		var imagenInput = document.getElementById('logo');
		if (imagenInput.files.length === 0) {
			alert("no existe");
			modificar( $("#img").val());
			return 1;
		}
	
		var formData = new FormData();
		
			formData.append('img', imagenInput.files[0]);
			formData.append('op', 'update_imagen');
		
			// Enviar la solicitud Ajax utilizando la función fetch
			fetch('../controller/categoryController.php', {
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
		'descripcion': $("#descripcionagg").val(),
		'img': nombreImagen,
		'estado':'1'
}	,'../controller/categoryController.php').then(function(result){
	if(result=="1"){
		alert_success();
		ver_registros();
		$("#nombreagg").val("");
		$("#descripcionagg").val("");
		$("#imgagg").val("");
	}
	}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();
	var result = function_ajax({
		'op':'buscar'
}	,'../controller/categoryController.php').then(function(result){
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
}	,'../controller/categoryController.php').then(function(result){
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
}			,'../controller/categoryController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function cargar_datos(id_category,nombre,descripcion,img){
	$("#id_category").val(id_category);
	$("#nombre").val(nombre);
	$("#descripcion").val(descripcion);
	$("#img").val(img);

			const imageURL = "http://localhost/enviar/assets/upload/category/"+img;

			// Mostrar la imagen en el elemento de vista previa
			const previewImage = document.getElementById("preview-image");
			previewImage.src = imageURL;
	

}

function modificar(img){
	var id =  $("#id_category").val();
	var nombre =  $("#nombre").val();
	var descripcion =  $("#descripcion").val();
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
				'descripcion': descripcion,
				'img': img,
			},'../controller/categoryController.php').then(function(result){
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
