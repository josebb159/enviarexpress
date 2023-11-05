<?php 


if(isset($_GET['view'])){

 

	if($_GET['view']=="producto"){
		include 'dinamic/tienda/producto.php';
	}

	elseif($_GET['view']=="orden"){
		include 'dinamic/tienda/orden.php';
	}
	elseif($_GET['view']=="lista_orden"){
		include 'dinamic/tienda/lista_orden.php';
	}
	elseif($_GET['view']=="domiciliarios_asignados"){
		include 'dinamic/tienda/domiciliarios_asignados.php';
	}

	elseif($_GET['view']=="miqr"){
		include 'dinamic/tienda/miqr.php';
	}
	elseif($_GET['view']=="horario_atencion"){
		include 'dinamic/tienda/horario_atencion.php';
	}

	
/*construir*/

    elseif($_GET['view']=="logout"){
        include 'logout.php';
    }
    

}else{
    include 'dinamic/tienda/index.php';
}
    
    



?>
