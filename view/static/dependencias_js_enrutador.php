<?php

if(isset($_GET['view'])){

    if($_GET['view']=="agregar_categoria"){
        echo "<script src='../assets/js/functions/enrutador/agregar_categoria.js'></script>";
   
    }
  
	if($_GET['view']=="usuarios"){
		echo "<script src='../assets/js/functions/enrutador/usuario.js'></script>";
	}
	if($_GET['view']=="enrutar"){
		echo "<script src='../assets/js/functions/enrutador/enrutar.js'></script>";
	}
	if($_GET['view']=="usuarios_cliente"){
		echo "<script src='../assets/js/functions/enrutador/usuario_cliente.js'></script>";
	}

	if($_GET['view']=="categoria"){
		echo "<script src='../assets/js/functions/enrutador/categoria.js'></script>";
	}
	if($_GET['view']=="colores"){
		echo "<script src='../assets/js/functions/enrutador/colores.js'></script>";
	}
	if($_GET['view']=="medidas"){
		echo "<script src='../assets/js/functions/enrutador/medidas.js'></script>";
	}
	


	if($_GET['view']=="category"){
		echo "<script src='../assets/js/functions/enrutador/category.js'></script>";
	}
	if($_GET['view']=="comercios"){
		echo "<script src='../assets/js/functions/enrutador/comercios.js'></script>";
	}
	if($_GET['view']=="configuracion"){
		echo "<script src='../assets/js/functions/enrutador/configuracion.js'></script>";
	}
	if($_GET['view']=="mensaje"){
		echo "<script src='../assets/js/functions/enrutador/mensaje.js'></script>";
	}
	
	if($_GET['view']=="producto"){
		echo "<script src='../assets/js/functions/enrutador/producto.js'></script>";
	}
	if($_GET['view']=="orden"){
		echo "<script src='../assets/js/functions/enrutador/orden.js'></script>";
	}
	if($_GET['view']=="lista_orden"){
		echo "<script src='../assets/js/functions/enrutador/lista_orden.js'></script>";
	}
	if($_GET['view']=="mandado"){
		echo "<script src='../assets/js/functions/enrutador/mandado.js'></script>";
	}
	if($_GET['view']=="rol"){
		echo "<script src='../assets/js/functions/enrutador/rol.js'></script>";
	}
	if($_GET['view']=="direccion"){
		echo "<script src='../assets/js/functions/enrutador/direccion.js'></script>";
	}
	if($_GET['view']=="horario_atencion"){
		echo "<script src='../assets/js/functions/enrutador/horario_atencion.js'></script>";
	}
	if($_GET['view']=="delivery"){
		echo "<script src='../assets/js/functions/enrutador/delivery.js'></script>";
	}
	if($_GET['view']=="jefe_zona"){
		echo "<script src='../assets/js/functions/enrutador/jefe_zona.js'></script>";
	}
	if($_GET['view']=="notificacion_correo"){
		echo "<script src='../assets/js/functions/enrutador/notificacion_correo.js'></script>";
	}
	if($_GET['view']=="monedero"){
		echo "<script src='../assets/js/functions/enrutador/monedero.js'></script>";
	}
	if($_GET['view']=="logs_api"){
		echo "<script src='../assets/js/functions/enrutador/logs.js'></script>";
	}
	
	
	if($_GET['view']=="publicidad"){
		echo "<script src='../assets/js/functions/enrutador/publicidad.js'></script>";
	}
/*construir*/
    
    
}else{
    echo "<script src='../assets/js/functions/enrutador/dashboard.js'></script>";
}
    
    


?>