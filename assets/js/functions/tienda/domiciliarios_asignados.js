$(document).ready(function(){

	ver_registros();

});

document.getElementById('telefono').addEventListener('input', function (e) {
	let value = e.target.value.replace(/\D/g, ''); // Elimina cualquier carácter que no sea número

	// Formatea la entrada en el formato 000-0000-000
	if (value.length > 3) {
		value = value.slice(0, 3) + '-' + value.slice(3);
	}
	if (value.length > 8) {
		value = value.slice(0, 8) + '-' + value.slice(8);
	}

	e.target.value = value.slice(0, 12); // Limita el input al formato 000-0000-000
});

 


function ver_registros(){
	var table = $('#datatable-buttons').DataTable();
	table.destroy();
	var result = function_ajax({
		'op':'buscar_asignados'
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
				'op':'desasignar_domiciliario',
				'id': id
}			,'../controller/usuarioController.php');
			
				ver_registros();
				Swal.fire("Eliminado!", "La registro fue eliminado.", "success");
			
		}
	});
}




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
