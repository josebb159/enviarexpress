<?php

if(isset($_GET['view'])){

	if($_GET['view']=="pedidos_culminados"){
		echo "<script src='../assets/js/functions/enrutador/pedidos_culminados.js'></script>";
	}


/*construir*/
    
    
}else{
    echo "<script src='../assets/js/functions/enrutador/dashboard.js'></script>";
}
    
    


?>