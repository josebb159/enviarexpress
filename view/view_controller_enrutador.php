<?php 


if(isset($_GET['view'])){

    if($_GET['view']=="usuarios"){
        include 'dinamic/enrutador/usuario.php';
    }

	if($_GET['view']=="enrutar"){
        include 'dinamic/enrutador/enrutar.php';
    }

	if($_GET['view']=="usuarios_cliente"){
        include 'dinamic/enrutador/usuario_cliente.php';
    }

	elseif($_GET['view']=="colores"){
		include 'dinamic/enrutador/colores.php';
	}
	elseif($_GET['view']=="medidas"){
		include 'dinamic/enrutador/medidas.php';
	}
	
	elseif($_GET['view']=="categoria"){
		include 'dinamic/enrutador/categoria.php';
	}

	elseif($_GET['view']=="category"){
		include 'dinamic/enrutador/category.php';
	}
	elseif($_GET['view']=="comercios"){
		include 'dinamic/enrutador/comercios.php';
	}
	elseif($_GET['view']=="configuracion"){
		include 'dinamic/enrutador/configuracion.php';
	}
	elseif($_GET['view']=="mensaje"){
		include 'dinamic/enrutador/mensaje.php';
	}

	elseif($_GET['view']=="producto"){
		include 'dinamic/enrutador/producto.php';
	}
	elseif($_GET['view']=="orden"){
		include 'dinamic/enrutador/orden.php';
	}
	elseif($_GET['view']=="lista_orden"){
		include 'dinamic/enrutador/lista_orden.php';
	}
	elseif($_GET['view']=="mandado"){
		include 'dinamic/enrutador/mandado.php';
	}
	elseif($_GET['view']=="rol"){
		include 'dinamic/enrutador/rol.php';
	}
	elseif($_GET['view']=="direccion"){
		include 'dinamic/enrutador/direccion.php';
	}
	elseif($_GET['view']=="horario_atencion"){
		include 'dinamic/enrutador/horario_atencion.php';
	}
	elseif($_GET['view']=="delivery"){
		include 'dinamic/enrutador/delivery.php';
	}
	elseif($_GET['view']=="jefe_zona"){
		include 'dinamic/enrutador/jefe_zona.php';
	}
	elseif($_GET['view']=="notificacion_correo"){
		include 'dinamic/enrutador/notificacion_correo.php';
	}
	elseif($_GET['view']=="monedero"){
		include 'dinamic/enrutador/monedero.php';
	}
	elseif($_GET['view']=="logs_api"){
		include 'dinamic/enrutador/logs.php';
	}
	
	elseif($_GET['view']=="publicidad"){
		include 'dinamic/enrutador/publicidad.php';
	}
	elseif($_GET['view']=="report"){
		include 'dinamic/enrutador/report.php';
	}
	elseif($_GET['view']=="asginados"){
		include 'dinamic/enrutador/asginados.php';
	}
	elseif($_GET['view']=="pedidos_culminados"){
		include 'dinamic/enrutador/pedidos_culminados.php';
	}
	elseif($_GET['view']=="comercio"){
		include 'dinamic/enrutador/comercio.php';
	}
/*construir*/

    elseif($_GET['view']=="logout"){
        include 'logout.php';
    }
    

}else{
    include 'dinamic/enrutador/index.php';
}
    
    



?>
