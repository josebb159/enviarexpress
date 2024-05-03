$(document).ready(function(){
	ver_registros();
	ver_registros_select();
	let codigoAleatorio = generarCodigoAleatorio();
	$("#code").html(codigoAleatorio);


	$('#basic-pills-wizard').bootstrapWizard({
        'tabClass': 'nav nav-pills nav-justified'
    });

    $('#progrss-wizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index+1;
        var $percent = ($current/$total) * 100;
		if(index==1){
			registrar_cliente();
		}
		if(index==2){
		
		}
		if(index==3){
			listo()
		}
        $('#progrss-wizard').find('.progress-bar').css({width:$percent+'%'});
    }});
});


// Active tab pane on nav link

var triggerTabList = [].slice.call(document.querySelectorAll('.twitter-bs-wizard-nav .nav-link'))
triggerTabList.forEach(function (triggerEl) {
    var tabTrigger = new bootstrap.Tab(triggerEl)

    triggerEl.addEventListener('click', function (event) {
        event.preventDefault()
        tabTrigger.show()
    })
})





	function registrar_cliente(){
	var result = function_ajax({
		'op':'registrar_cliente',
		'nombre': $("#nombre").val(),
		'apellido': $("#apellido").val(),
		'correo': $("#correo").val(),
		'telefono': $("#telefono").val(),
		'direccion': $("#direccion").val(),
		'code': $("#code").html(),
}	,'../controller/ordenExternalController.php').then(function(result){
	if(result=="1"){
	}
	}).catch(function(error) {console.log('Error:', error);});
}


function listo(){
	var result = function_ajax({
		'op':'listo',
		'pago': $("#tipo_pago").val(),

}	,'../controller/ordenExternalController.php').then(function(result){
	if(result=="1"){
	}
	}).catch(function(error) {console.log('Error:', error);});
}


function registrar_producto(){
	var result = function_ajax({
		'op':'registrar_producto',
		'cantidad': $("#cantidad").val(),
		'producto': $("#datos").val(),
}	,'../controller/ordenExternalController.php').then(function(result){
	ver_registros();
	$("#cantidad").val(0);
	}).catch(function(error) {console.log('Error:', error);});
}



function ver_registros_select(){
	$(".select2").select2();
	var result = function_ajax({
		'op':'selectdinamic'
}	,'../controller/productoController.php').then(function(result){
	$("#datos").html(result);

	}).catch(function(error) {console.log('Error:', error);});
}

function ver_registros(){

	var result = function_ajax({
		'op':'buscarOrden',
		'code':  $("#code").html()
}	,'../controller/productoController.php').then(function(result){
	$("#datos_product").html(result);

	}).catch(function(error) {console.log('Error:', error);});
}

function eliminar(id){

	var result = function_ajax({
		'op':'eliminarproducto',
		'id':  id
}	,'../controller/productoController.php').then(function(result){
	ver_registros();

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



function generarCodigoAleatorio() {
    let caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let codigo = '';

    for (let i = 0; i < 7; i++) {
        let caracterAleatorio = caracteres.charAt(Math.floor(Math.random() * caracteres.length));
        codigo += caracterAleatorio;
    }

    return codigo;
}