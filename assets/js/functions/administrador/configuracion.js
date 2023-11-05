$(document).ready(function(){
	ver_registros();
});
 

function ver_registros(){

	var result = function_ajax({
		'op':'buscar'
}	,'../controller/configuracionController.php').then(function(result){

	$("#form_2").html(result);
	
	}).catch(function(error) {console.log('Error:', error);});
}




function modificar(){
	var id =  $("#id_configuracion").val();
	var algo_radpio =  $("#algo_radpio").val();
	var ar_km_adicional =  $("#ar_km_adicional").val();
	var mejor_ir_con_tiempo =  $("#mejor_ir_con_tiempo").val();
	var mict_km_adicional =  $("#mict_km_adicional").val();
	var viaja_en_carro =  $("#viaja_en_carro").val();
	var vec_km_adicional =  $("#vec_km_adicional").val();
	var whatsapp =  $("#whatsapp").val();
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
				'algo_radpio': algo_radpio,
				'ar_km_adicional': ar_km_adicional,
				'mejor_ir_con_tiempo': mejor_ir_con_tiempo,
				'mict_km_adicional': mict_km_adicional,
				'viaja_en_carro': viaja_en_carro,
				'vec_km_adicional': vec_km_adicional,
				'whatsapp': whatsapp,
			},'../controller/configuracionController.php').then(function(result){
			if(result=="1"){
				ver_registros();
				Swal.fire("Modificado!", "El registro fue modificado.", "success");
			
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
