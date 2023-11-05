$(document).ready(function(){
	ver_registros();
});

function registrar(){
function_ajax({
		'op':'registrar',
		'descripcion': $("#descripciongg").val(),
		'estado':'1'
}	,'../controller/categoriaController.php').then(function(valor) {
	if(valor=="1"){
		alert_success();
		$("#descripcionagg").val("");
		ver_registros();
	
	}
}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();

function_ajax({
	'op':'buscar'
}	,'../controller/categoriaController.php')
  .then(function(valor) {
    $("#datos").html(valor);
	$('#datatable-buttons').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	});
  }).catch(function(error) { console.log('Error:', error); });

}

function cambiar_estado(id, estado){
	if(estado==1){
		estado=0
	}else{
		estado=1
	}
	 function_ajax({
		'op':'cambiar_estado',
		'id': id,
		'estado':estado
}	,'../controller/categoriaController.php').then(function(result) {
	if(result=="1"){
		alert_success_status();
	}
}).catch(function(error) { console.log('Error:', error); });
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
}			,'../controller/categoriaController.php').then(function(result) {
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
		}).catch(function(error) { console.log('Error:', error); });
		}
	});
}

function cargar_datos(id,descripcion){
	
	$("#id_categoria").val(id);
	$("#descripcion").val(descripcion);
	
}

function modificar(){
	var id =  $("#id_categoria").val();
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
				'descripcion': descripcion
			},'../controller/categoriaController.php').then(function(result) {
			if(result=="1"){
				ver_registros();
				Swal.fire("Modificado!", "El registro fue modificado.", "success");
				$('#myModal').modal('hide');
			}
		}).catch(function(error) { console.log('Error:', error); });
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
	registrar();
});

$("#form_2").on('submit', function(evt){
	evt.preventDefault();  
	modificar();
});

function function_ajax(data, url) {
	return new Promise(function(resolve, reject) {
	  $.post({
		type: 'POST',
		url: url,
		data: data,
		success: function(response) {
		  resolve(response);
		},
		error: function(error) {
		  reject(error);
		}
	  });
	});
  }
  