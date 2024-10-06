<?php 
if(isset($_SESSION['rol'])){
    $rol = $_SESSION['rol'];
}else{
    $rol = "";
}


if($rol=="administrador"){

    include 'dependencias_js_admin.php';

}elseif($rol=="tienda"){
    include 'dependencias_js_tienda.php';
}elseif($rol=="enrutador"){
    include 'dependencias_js_enrutador.php';
}elseif($rol=="recaudador"){
    include 'dependencias_js_recaudador.php';
}elseif($rol=="Usuario Nivel 3"){
    include 'dependencias_js_usuario3.php';
}elseif($rol=="Usuario Nivel 4"){
    include 'dependencias_js_usuario4.php';
}
else{}


 
?>