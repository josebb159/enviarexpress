$(document).ready(function(){
	ver_registros();
});

function registrar(){
	var result = function_ajax({
		'op':'registrar',
		'id_comercios': $("#id_comerciosagg").val(),
		'lunes_am': $("#lunes_amagg").val(),
		'lunes_pm': $("#lunes_pmagg").val(),
		'martes_am': $("#martes_amagg").val(),
		'mertes_pm': $("#mertes_pmagg").val(),
		'miercoles_am': $("#miercoles_amagg").val(),
		'miercoles_pm': $("#miercoles_pmagg").val(),
		'jueves_am': $("#jueves_amagg").val(),
		'jueves_pm': $("#jueves_pmagg").val(),
		'viernes_am': $("#viernes_amagg").val(),
		'viernes_pm': $("#viernes_pmagg").val(),
		'sabado_am': $("#sabado_amagg").val(),
		'sabado_pm': $("#sabado_pmagg").val(),
		'domingo_am': $("#domingo_amagg").val(),
		'domingo_pm': $("#domingo_pmagg").val(),
		'estado':'1'
}	,'../controller/horario_atencionController.php').then(function(result){
	if(result=="1"){
		alert_success();
		ver_registros();
		$("#lunes_amagg").val("");
		$("#lunes_pmagg").val("");
		$("#martes_amagg").val("");
		$("#mertes_pmagg").val("");
		$("#miercoles_amagg").val("");
		$("#miercoles_pmagg").val("");
		$("#jueves_amagg").val("");
		$("#jueves_pmagg").val("");
		$("#viernes_amagg").val("");
		$("#viernes_pmagg").val("");
		$("#sabado_amagg").val("");
		$("#sabado_pmagg").val("");
		$("#domingo_amagg").val("");
		$("#domingo_pmagg").val("");
		$("#id_comerciosagg").val("");
	}
	}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();
	var result = function_ajax({
		'op':'buscar'
}	,'../controller/horario_atencionController.php').then(function(result){
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
}	,'../controller/horario_atencionController.php').then(function(result){
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
}			,'../controller/horario_atencionController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			}
			}).catch(function(error) {console.log('Error:', error);});
		}
	});
}

function cargar_datos(id_horario_atencion,id_comercios,lunes_am,lunes_pm,martes_am,mertes_pm,miercoles_am,miercoles_pm,jueves_am,jueves_pm,viernes_am,viernes_pm,sabado_am,sabado_pm,domingo_am,domingo_pm){
	$("#id").val(id_horario_atencion);
	$("#lunes_am").val(lunes_am);
	$("#lunes_pm").val(lunes_pm);
	$("#martes_am").val(martes_am);
	$("#mertes_pm").val(mertes_pm);
	$("#miercoles_am").val(miercoles_am);
	$("#miercoles_pm").val(miercoles_pm);
	$("#jueves_am").val(jueves_am);
	$("#jueves_pm").val(jueves_pm);
	$("#viernes_am").val(viernes_am);
	$("#viernes_pm").val(viernes_pm);
	$("#sabado_am").val(sabado_am);
	$("#sabado_pm").val(sabado_pm);
	$("#domingo_am").val(domingo_am);
	$("#domingo_pm").val(domingo_pm);
	$("#id_comercios").val(id_comercios);
}

function modificar(){
	var id =  $("#id_horario_atencion").val();
	var comercios =  $("#id_comercios").val();
	var lunes_am =  $("#lunes_am").val();
	var lunes_pm =  $("#lunes_pm").val();
	var martes_am =  $("#martes_am").val();
	var mertes_pm =  $("#mertes_pm").val();
	var miercoles_am =  $("#miercoles_am").val();
	var miercoles_pm =  $("#miercoles_pm").val();
	var jueves_am =  $("#jueves_am").val();
	var jueves_pm =  $("#jueves_pm").val();
	var viernes_am =  $("#viernes_am").val();
	var viernes_pm =  $("#viernes_pm").val();
	var sabado_am =  $("#sabado_am").val();
	var sabado_pm =  $("#sabado_pm").val();
	var domingo_am =  $("#domingo_am").val();
	var domingo_pm =  $("#domingo_pm").val();
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
				'comercios': id_comercios,
				'lunes_am': lunes_am,
				'lunes_pm': lunes_pm,
				'martes_am': martes_am,
				'mertes_pm': mertes_pm,
				'miercoles_am': miercoles_am,
				'miercoles_pm': miercoles_pm,
				'jueves_am': jueves_am,
				'jueves_pm': jueves_pm,
				'viernes_am': viernes_am,
				'viernes_pm': viernes_pm,
				'sabado_am': sabado_am,
				'sabado_pm': sabado_pm,
				'domingo_am': domingo_am,
				'domingo_pm': domingo_pm,
			},'../controller/horario_atencionController.php').then(function(result){
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
