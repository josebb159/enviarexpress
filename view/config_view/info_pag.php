<?php 
if(isset($index)){
    include 'model/configuracion.php';
}
else{
    include '../model/configuracion.php';
}


$config = new configuracion();
$data_configs = $config->get_config(); 

foreach($data_configs as $data_config){
    if($data_config['descripcion'] == "nombre"){
        define('NAME_CLIENT', $data_config['dato']);	    
    }
    if($data_config['descripcion'] == "color"){
        define('COLOR_PRIMARY', $data_config['dato']);	    
    }
    if($data_config['descripcion'] =="correo"){
        define('CORREO', $data_config['dato']);	    
    }
}


?>