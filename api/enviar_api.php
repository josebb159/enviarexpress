<?php

include '../model/api.php';

if(isset($_GET['data'])){
   $data =  $_GET['data'];
}else{
   die();
}




 switch ($data) {
     case 'Login':
 
         $n_api  = new api();
         $resultado = $n_api -> login($_POST['uid']);
         echo $resultado;
         
      break;
      case 'Login_no_uid':

         $n_api  = new api();
         $resultado = $n_api -> Login_no_uid($_POST['email'],$_POST['password']);
         echo $resultado;
         
      break;

     case 'Registrar':
 
      $n_api  = new api();
     $resultado = $n_api -> registrar_usuario($_POST['uid'],$_POST['nombre'],$_POST['correo'],$_POST['contrasena'],$_POST['telefono'],$_POST['fecha']);
     //$resultado = $n_api -> registrar_usuario('sadsa','sadsa','sadsa','sadsa','sadsa','sadsa');
     echo $resultado;
      
      break;

      case 'get_comerce':
 
         $n_api  = new api();
         $resultado = $n_api -> get_commerce();
         echo $resultado;
         
      break;
        case 'get_comerce_from_category':
 
         $n_api  = new api();
         $resultado = $n_api -> get_comerce_from_category($_POST['id_category']);
         echo $resultado;
         
      break;
      case 'get_category':
 
         $n_api  = new api();
         $resultado = $n_api -> get_category();
         echo $resultado;
         
      break;
      case 'add_ubication':

         $n_api  = new api();
         $resultado = $n_api -> add_direccion($_POST['uid'],$_POST['direccion'],$_POST['telefono'],$_POST['latitude'],$_POST['longitude'],$_POST['tipo']);
         echo $resultado;
         
      break;
      case 'get_direcciones':

         $n_api  = new api();
         $resultado = $n_api -> get_direcciones($_POST['uid'],$_POST['tipo']);
         echo $resultado;
         
      break;
      case 'direcciones_select':
         
         $n_api  = new api();
         $resultado = $n_api -> direcciones_select($_POST['uid'], $_POST['tipo']);
         echo $resultado;
         
      break;
       case 'updata_direcciones':

         $n_api  = new api();
         $resultado = $n_api -> update_direcciones($_POST['id_direccion'], $_POST['tipo']);
         echo $resultado;
         
      break;
      case 'get_config':

         $n_api  = new api();
         $resultado = $n_api -> get_config();
         echo $resultado;
         
      break;
      case 'get_orden_pending':
         $n_api  = new api();
         $resultado = $n_api -> get_orden_pending($_POST['uid']);
         echo $resultado;
         
      break;
      case 'get_mandado_pending':
         $n_api  = new api();
         $resultado = $n_api -> get_mandado_pending($_POST['uid']);
         echo $resultado;
         
      break;
      case 'get_mandados_map':

         $n_api  = new api();
         $resultado = $n_api -> get_mandados_map();
         echo $resultado;
         
      break;
      case 'cancelado':
 
         $n_api  = new api();
         $resultado = $n_api -> cancelado($_POST['uid'],$_POST['id_mandado']);
         echo $resultado;
         
      break;
      case 'cancelado_mandado':
 
         $n_api  = new api();
         $resultado = $n_api -> cancelado_mandado($_POST['uid'],$_POST['id_mandado']);
         echo $resultado;
         
      break;
      case 'get_mandados_from_map':
         $n_api  = new api();
         $resultado = $n_api -> get_mandados_from_map($_GET['id']);
         echo $resultado;
         
      break;
      case 'get_orden_from_map':
         $n_api  = new api();
         $resultado = $n_api -> get_orden_from_map($_GET['id']);
         echo $resultado;
         
      break;


      case 'get_user_delivery':
     
         $n_api  = new api();
         $resultado = $n_api -> get_user_delivery($_POST['uid']);
         echo $resultado;
         
      break;
      case 'get_user_client':
     
         $n_api  = new api();
         $resultado = $n_api -> get_user_client($_POST['uid']);
         echo $resultado;
         
      break;


      case 'get_orden_mandado':
    
         $n_api  = new api();
         $resultado = $n_api -> get_orden_mandado($_POST['uid']);
        
      break;
      case 'get_orden':

         $n_api  = new api();
         $resultado = $n_api -> get_orden($_POST['uid']);
         
         
      break;
      case 'product_from_comerce':
    
         $n_api  = new api();
         $resultado = $n_api -> product_from_comerce($_POST['id_comercio']);
         
      break;

      case 'get_comercio':
    
         $n_api  = new api();
         $resultado = $n_api -> get_comercio($_POST['id_comercio']);
         
      break;

      case 'get_product':
    
         $n_api  = new api();
         $resultado = $n_api -> get_product($_POST['id_producto']);
         
      break;


      case 'save_fmc':
       
         $n_api  = new api();
         $resultado = $n_api -> save_fmc($_POST['uid'],$_POST['fmc']);

         
      break;
      case 'update_uid':
       
         $n_api  = new api();
         $resultado = $n_api -> update_uid($_POST['uid'],$_POST['email']);

         
      break;
      case 'send_notification_delivey':
       
         $n_api  = new api();
         $resultado = $n_api -> send_notification_delivery();

         
      break;
      case 'send_notification_status':
       
         $n_api  = new api();
         $resultado = $n_api -> send_notification_status("activo");

         
      break;

      case 'acept_mandado':
         $n_api  = new api();
         $resultado = $n_api -> acept_mandado($_POST['uid'],$_POST['id_mandado']);
         echo $resultado;
         
      break;
      case 'acept_orden':
         $n_api  = new api();
         $resultado = $n_api -> acept_orden($_POST['uid'],$_POST['id_orden']);
         echo $resultado;
         
      break;


      case 'asosiate_delivery':
       
         $n_api  = new api();
         $resultado = $n_api -> asosiate_delivery($_POST['uid'],$_POST['id_comercio']);
   
         
      break;

      case 'is_in_mandado':

 
         $n_api  = new api();
         $resultado = $n_api -> is_in_mandado($_POST['uid']);
         echo $resultado;
         
      break;

      case 'is_in_orden':

 
         $n_api  = new api();
         $resultado = $n_api -> is_in_orden($_POST['uid']);
         echo $resultado;
         
      break;

      case 'get_all_orden':
      
 
         $n_api  = new api();
         $resultado = $n_api -> get_all_orden($_POST['uid']);
         echo $resultado;
         
      break;

      case 'is_in_mandado_whith_direction':

         $n_api  = new api();
         $resultado = $n_api -> is_in_mandado_whith_direction($_POST['uid']);
         echo $resultado;
         
      break;

      case 'is_in_order_whith_direction':

         $n_api  = new api();
         $resultado = $n_api -> is_in_order_whith_direction($_POST['uid']);
         echo $resultado;
         
      break;


      
      case 'en_camino':
 
         $n_api  = new api();
         $resultado = $n_api -> en_camino($_POST['uid'],$_POST['id_mandado']);
         echo $resultado;
         
      break;
      case 'en_camino_orden':
 
         $n_api  = new api();
         $resultado = $n_api -> en_camino_orden($_POST['uid'],$_POST['id_orden']);
         echo $resultado;
         
      break;
      case 'entregado':
 
         $n_api  = new api();
         $resultado = $n_api -> entregado($_POST['uid'],$_POST['id_mandado']);
         echo $resultado;
         
      break;
      case 'obtener_domiciliario':
 
         $n_api  = new api();
         $resultado = $n_api -> obtener_domiciliario($_POST['id_domiciliario']);
         echo $resultado;
         
      break;
      case 'entregado_orden':
 
         $n_api  = new api();
         $resultado = $n_api -> entregado_orden($_POST['uid'],$_POST['id_orden']);
         echo $resultado;
         
      break;
      case 'registrar_orden':
         $id_cliente=$_POST['uid'];
      
         $descripcion=$_POST['mandado'];
         $direccion=$_POST['direccion'];
         $telefono= $_POST['telefono']; //$_POST[''];
         $latitude="1";
         $longitude="1";
         $id_entrega=$_POST['id_entrega'];
         $id_recogida=$_POST['id_recodida'];
         $metodo_pago=$_POST['metodo_pago'];
         $tipo_servicio=$_POST['tipo_servicio'];
         $distancia=$_POST['distancia'];
         $valor=$_POST['valor'];
         $total=$_POST['total'];

         $n_api  = new api();
         $resultado = $n_api -> registrar_orden($id_cliente,  $descripcion, $telefono, $direccion, $latitude,$longitude,  $id_entrega, $id_recogida, $metodo_pago, $tipo_servicio,$distancia,  $valor, $total);
         echo $resultado;
         
      break;


      case 'registrar_mandado':
         $id_cliente="zfAeDqNslzQ6UjMjOTXWbfscQzi2";//$_POST['uid'];
      
         $descripcion= $_POST['mandado'];
         $direccion= $_POST['direccion'];
         $telefono= $_POST['telefono']; //$_POST[''];
         $id_entrega=$_POST['id_entrega'];
         $id_recogida=$_POST['id_recodida'];
         $metodo_pago=$_POST['metodo_pago'];
         $tipo_servicio=$_POST['tipo_servicio'];
         $distancia=$_POST['distancia'];
         $valor=$_POST['valor'];
         $total=$_POST['total'];
         $n_api  = new api();
          
         $resultado = $n_api -> registrar_mandado($id_cliente,  $descripcion,  $direccion, $telefono, $id_recogida,$id_entrega, $tipo_servicio,  $metodo_pago, $distancia,  $valor, $total);
         echo $resultado;
         
      break;


         # code...
         break;
 }


// Obtener todas las peticiones GET y POST
$currentDate = date('Y-m-d H:i:s');
$data = array(
   'fecha' => $currentDate,
   'GET' => $_GET,
   'POST' => $_POST
);

// Ruta y nombre de archivo
$filename = 'peticiones.json';

// Leer el archivo existente, si existe
if (file_exists($filename)) {
   $fileContents = file_get_contents($filename);
   $existingData = json_decode($fileContents, true);

   // Combinar las peticiones existentes con las nuevas
   $existingData[] = $data;
   $jsonData = json_encode($existingData). PHP_EOL;
} else {
   // Si el archivo no existe, crear uno nuevo con los datos actuales
   $jsonData = json_encode(array($data));
}

// Guardar en el archivo
file_put_contents($filename, $jsonData);


?>