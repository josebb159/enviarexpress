<?php

if(isset($_GET['view'])){

	if($_GET['view']=="pedidos_culminados"){
		echo "<script src='../assets/js/functions/recaudador/pedidos_culminados.js'></script>";
	}


/*construir*/
    
    
}else{
    echo "<script src='../assets/js/functions/recaudador/dashboard.js'></script>";
}
    
    


?>