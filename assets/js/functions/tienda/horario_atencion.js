$(document).ready(function(){
	ver_registros();
});

function registrar(){

	var result = function_ajax({
		'op':'registrar',
		'lunes_am': $("#lunes_am").val(),
		'lunes_pm': $("#lunes_pm").val(),
		'martes_am': $("#martes_am").val(),
		'mertes_pm': $("#mertes_pm").val(),
		'miercoles_am': $("#miercoles_am").val(),
		'miercoles_pm': $("#miercoles_pm").val(),
		'jueves_am': $("#jueves_am").val(),
		'jueves_pm': $("#jueves_pm").val(),
		'viernes_am': $("#viernes_am").val(),
		'viernes_pm': $("#viernes_pm").val(),
		'sabado_am': $("#sabado_am").val(),
		'sabado_pm': $("#sabado_pm").val(),
		'domingo_am': $("#domingo_am").val(),
		'domingo_pm': $("#domingo_pm").val(),
		'estado':'1'
}	,'../controller/horario_atencionController.php').then(function(result){

	if(result=="1"){
	
		alert_success();
		//ver_registros();

	}
	}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();
	var result = function_ajax({
		'op':'buscar_json'
}	,'../controller/horario_atencionController.php').then(function(result){
	
	var horario = JSON.parse(result)[0];

	$("#lunes_am").val(horario.lunes_am);
	$("#lunes_pm").val(horario.lunes_pm);
	$("#martes_am").val(horario.martes_am);
	$("#martes_pm").val(horario.martes_pm);
	$("#miercoles_am").val(horario.miercoles_am);
	$("#miercoles_pm").val(horario.miercoles_pm);
	$("#jueves_am").val(horario.jueves_am);
	$("#jueves_pm").val(horario.jueves_pm);
	$("#viernes_am").val(horario.viernes_am);
	$("#viernes_pm").val(horario.viernes_pm);
	$("#sabado_am").val(horario.sabado_am);
	$("#sabado_pm").val(horario.sabado_pm);
	$("#domingo_am").val(horario.domingo_am);
	$("#domingo_pm").val(horario.domingo_pm);
	$('#datatable-buttons').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		]
	});
	}).catch(function(error) {console.log('Error:', error);});
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
