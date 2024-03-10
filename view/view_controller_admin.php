<?php 


if(isset($_GET['view'])){

    if($_GET['view']=="usuarios"){
        include 'dinamic/administrador/usuario.php';
    }

	if($_GET['view']=="usuarios_cliente"){
        include 'dinamic/administrador/usuario_cliente.php';
    }

	elseif($_GET['view']=="colores"){
		include 'dinamic/administrador/colores.php';
	}
	elseif($_GET['view']=="medidas"){
		include 'dinamic/administrador/medidas.php';
	}
	
	elseif($_GET['view']=="categoria"){
		include 'dinamic/administrador/categoria.php';
	}

	elseif($_GET['view']=="category"){
		include 'dinamic/administrador/category.php';
	}
	elseif($_GET['view']=="comercios"){
		include 'dinamic/administrador/comercios.php';
	}
	elseif($_GET['view']=="configuracion"){
		include 'dinamic/administrador/configuracion.php';
	}
	elseif($_GET['view']=="mensaje"){
		include 'dinamic/administrador/mensaje.php';
	}

	elseif($_GET['view']=="producto"){
		include 'dinamic/administrador/producto.php';
	}
	elseif($_GET['view']=="orden"){
		include 'dinamic/administrador/orden.php';
	}
	elseif($_GET['view']=="lista_orden"){
		include 'dinamic/administrador/lista_orden.php';
	}
	elseif($_GET['view']=="mandado"){
		include 'dinamic/administrador/mandado.php';
	}
	elseif($_GET['view']=="rol"){
		include 'dinamic/administrador/rol.php';
	}
	elseif($_GET['view']=="direccion"){
		include 'dinamic/administrador/direccion.php';
	}
	elseif($_GET['view']=="horario_atencion"){
		include 'dinamic/administrador/horario_atencion.php';
	}
	elseif($_GET['view']=="delivery"){
		include 'dinamic/administrador/delivery.php';
	}
	elseif($_GET['view']=="jefe_zona"){
		include 'dinamic/administrador/jefe_zona.php';
	}
	elseif($_GET['view']=="notificacion_correo"){
		include 'dinamic/administrador/notificacion_correo.php';
	}
	elseif($_GET['view']=="monedero"){
		include 'dinamic/administrador/monedero.php';
	}
	elseif($_GET['view']=="logs_api"){
		include 'dinamic/administrador/logs.php';
	}
	
/*construir*/

    elseif($_GET['view']=="logout"){
        include 'logout.php';
    }
    

}else{
    include 'dinamic/administrador/index.php';
}
    
    



?>
