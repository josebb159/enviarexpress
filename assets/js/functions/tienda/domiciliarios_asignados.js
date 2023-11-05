$(document).ready(function(){

	ver_registros();


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
