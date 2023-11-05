<?php

if(isset($_GET['view'])){

    if($_GET['view']=="agregar_categoria"){
        echo "<script src='../assets/js/functions/tienda/agregar_categoria.js'></script>";
   
    }
  
	if($_GET['view']=="usuarios"){
		echo "<script src='../assets/js/functions/tienda/usuario.js'></script>";
	}

	if($_GET['view']=="categoria"){
		echo "<script src='../assets/js/functions/tienda/categoria.js'></script>";
	}
	if($_GET['view']=="colores"){
		echo "<script src='../assets/js/functions/tienda/colores.js'></script>";
	}
	if($_GET['view']=="medidas"){
		echo "<script src='../assets/js/functions/tienda/medidas.js'></script>";
	}
	


	if($_GET['view']=="category"){
		echo "<script src='../assets/js/functions/tienda/category.js'></script>";
	}
	if($_GET['view']=="comercios"){
		echo "<script src='../assets/js/functions/tienda/comercios.js'></script>";
	}
	if($_GET['view']=="configuracion"){
		echo "<script src='../assets/js/functions/tienda/configuracion.js'></script>";
	}
	if($_GET['view']=="mensaje"){
		echo "<script src='../assets/js/functions/tienda/mensaje.js'></script>";
	}
	
	if($_GET['view']=="producto"){
		echo "<script src='../assets/js/functions/tienda/producto.js'></script>";
	}
	if($_GET['view']=="orden"){
		echo "<script src='../assets/js/functions/tienda/orden.js'></script>";
	}
	if($_GET['view']=="lista_orden"){
		echo "<script src='../assets/js/functions/tienda/lista_orden.js'></script>";
	}
	if($_GET['view']=="mandado"){
		echo "<script src='../assets/js/functions/tienda/mandado.js'></script>";
	}
	if($_GET['view']=="rol"){
		echo "<script src='../assets/js/functions/tienda/rol.js'></script>";
	}
	if($_GET['view']=="direccion"){
		echo "<script src='../assets/js/functions/tienda/direccion.js'></script>";
	}
	if($_GET['view']=="domiciliarios_asignados"){
		echo "<script src='../assets/js/functions/tienda/domiciliarios_asignados.js'></script>";
	}
	if($_GET['view']=="miqr"){
		echo "<script src='../assets/js/functions/tienda/miqr.js'></script>";
	}
	if($_GET['view']=="horario_atencion"){
		echo "<script src='../assets/js/functions/tienda/horario_atencion.js'></script>";
	}
/*construir*/
    
    
}else{
    echo "<script src='../assets/js/functions/administrador/dashboard.js'></script>";
}
    
    


?>