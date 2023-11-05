<?php

if(isset($_GET['view'])){

    if($_GET['view']=="agregar_categoria"){
        echo "<script src='../assets/js/functions/administrador/agregar_categoria.js'></script>";
   
    }
  
	if($_GET['view']=="usuarios"){
		echo "<script src='../assets/js/functions/administrador/usuario.js'></script>";
	}

	if($_GET['view']=="categoria"){
		echo "<script src='../assets/js/functions/administrador/categoria.js'></script>";
	}
	if($_GET['view']=="colores"){
		echo "<script src='../assets/js/functions/administrador/colores.js'></script>";
	}
	if($_GET['view']=="medidas"){
		echo "<script src='../assets/js/functions/administrador/medidas.js'></script>";
	}
	


	if($_GET['view']=="category"){
		echo "<script src='../assets/js/functions/administrador/category.js'></script>";
	}
	if($_GET['view']=="comercios"){
		echo "<script src='../assets/js/functions/administrador/comercios.js'></script>";
	}
	if($_GET['view']=="configuracion"){
		echo "<script src='../assets/js/functions/administrador/configuracion.js'></script>";
	}
	if($_GET['view']=="mensaje"){
		echo "<script src='../assets/js/functions/administrador/mensaje.js'></script>";
	}
	
	if($_GET['view']=="producto"){
		echo "<script src='../assets/js/functions/administrador/producto.js'></script>";
	}
	if($_GET['view']=="orden"){
		echo "<script src='../assets/js/functions/administrador/orden.js'></script>";
	}
	if($_GET['view']=="lista_orden"){
		echo "<script src='../assets/js/functions/administrador/lista_orden.js'></script>";
	}
	if($_GET['view']=="mandado"){
		echo "<script src='../assets/js/functions/administrador/mandado.js'></script>";
	}
	if($_GET['view']=="rol"){
		echo "<script src='../assets/js/functions/administrador/rol.js'></script>";
	}
	if($_GET['view']=="direccion"){
		echo "<script src='../assets/js/functions/administrador/direccion.js'></script>";
	}
	if($_GET['view']=="horario_atencion"){
		echo "<script src='../assets/js/functions/administrador/horario_atencion.js'></script>";
	}
	if($_GET['view']=="delivery"){
		echo "<script src='../assets/js/functions/administrador/delivery.js'></script>";
	}
	if($_GET['view']=="jefe_zona"){
		echo "<script src='../assets/js/functions/administrador/jefe_zona.js'></script>";
	}
	if($_GET['view']=="notificacion_correo"){
		echo "<script src='../assets/js/functions/administrador/notificacion_correo.js'></script>";
	}
	if($_GET['view']=="monedero"){
		echo "<script src='../assets/js/functions/administrador/monedero.js'></script>";
	}
/*construir*/
    
    
}else{
    echo "<script src='../assets/js/functions/administrador/dashboard.js'></script>";
}
    
    


?>