$(document).ready(function(){
	ver_comercios();
    ver_ventas();
    ver_domiciliarios();
});


function ver_comercios(){

	var result = function_ajax({
		'op':'cantidad'
}	,'../controller/comerciosController.php').then(function(result){
	$("#comercios").html(result);
	
	}).catch(function(error) {console.log('Error:', error);});
}


function ver_ventas(){

	var result = function_ajax({
		'op':'cantidad'
}	,'../controller/ordenController.php').then(function(result){

	$("#ventas").html(result);

	}).catch(function(error) {console.log('Error:', error);});
}


function ver_domiciliarios(){

	var result = function_ajax({
		'op':'cantidad_domiciliario'
}	,'../controller/usuarioController.php').then(function(result){

	$("#domiciliario").html(result);

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
