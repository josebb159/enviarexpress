<?php 
if(isset($_SESSION['rol'])){
    $rol = $_SESSION['rol'];
}else{
    $rol = "";
}


if($rol=="Usuario Nivel 1"){

    include 'menu_usuario1.php';

}elseif($rol=="Usuario Nivel 2"){
    
    include 'menu_usuario2.php';

}elseif($rol=="enrutador"){

    include 'menu_enrutador.php';

}elseif($rol=="tienda"){

    include 'menu_tienda.php';

}elseif($rol=="recaudador"){

    include 'menu_recaudador.php';

}elseif($rol=="administrador"){
  
    include 'menu.php';

}else{}





?>