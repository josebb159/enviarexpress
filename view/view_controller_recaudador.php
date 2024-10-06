<?php 


if(isset($_GET['view'])){

	if($_GET['view']=="pedidos_culminados"){
		include 'dinamic/recaudador/pedidos_culminados.php';
	}

/*construir*/

    elseif($_GET['view']=="logout"){
        include 'logout.php';
    }
    

}else{
    include 'dinamic/recaudador/index.php';
}
    
    



?>
