$(document).ready(function(){
	ver_registros();
	buscar_domiciliarios_disponibles();
});
 



function Asignar(nombreImagen){
	var result = function_ajax({
		'op':'registrar',
		'nombre': $("#nombreagg").val(),
		'correo': $("#correoagg").val(),
		'telefono': $("#telefonoagg").val(),
		'contrasena': $("#contrasenaagg").val(),
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
		'op':'buscar_orden_tienda_general'
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


function buscar_domiciliarios_disponibles_gps(){

	var result = function_ajax({
		'op':'buscar_domiciliarios_disponibles_gps'
}	,'../controller/ordenController.php').then(function(response){
	
	var dataArray = JSON.parse(response);
    
    // Iterar sobre el array
    dataArray.forEach(function(domiciliario) {
		if(domiciliario.latitud !=null && domiciliario.longitud != null){
			agregarMarcador(domiciliario.latitud, domiciliario.longitud);
		}
    
    });

	}).catch(function(error) {console.log('Error:', error);});
}




function buscar_domiciliarios_disponibles(){

	var result = function_ajax({
		'op':'buscar_domiciliarios_disponibles'
}	,'../controller/ordenController.php').then(function(result){
	
	$("#rolagg").html(result);

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