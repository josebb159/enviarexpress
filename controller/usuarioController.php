<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/tmp'));
include '../model/usuario.php';
include '../model/notificacion_correo.php';
if(isset($_POST['id'])){
   $id =  $_POST['id'];
}
 
if(isset($_POST['rol'])){
   $rol =  $_POST['rol'];
}

if(isset($_POST['nombre'])){
   $nombre =  $_POST['nombre'];
}

if(isset($_POST['telefono'])){
   $telefono =  $_POST['telefono'];
}

if(isset($_POST['correo'])){
   $correo =  $_POST['correo'];
}




 if(isset($_POST['contrasena'])){
    $contrasena =  $_POST['contrasena'];
 }

 if(isset($_POST['estado'])){
    $estado =  $_POST['estado'];
 }

 if(isset($_POST['image'])){
   $image =  $_POST['image'];
}


 if(isset($_POST['op'])){
    $op =  $_POST['op'];
 }



 switch ($op) {

   case 'update_imagen':
		$nombreImagen = generarNombreAleatorio(20);
		$archivoImagen = $_FILES['imagen']['tmp_name'];
		$destinoImagen = '../assets/upload/user/' . $nombreImagen.".jpg";

		if (move_uploaded_file($archivoImagen, $destinoImagen)) {
			// La imagen se ha guardado correctamente
			// Puedes realizar otras operaciones aquí, como guardar los datos en una base de datos
			// o realizar alguna otra tarea adicional
	
			echo json_encode(array('status' => 'success', 'message' => 'Imagen guardada correctamente', 'nombreImagen' => $nombreImagen.".jpg"));
			// Envía una respuesta a Ajax indicando que todo ha ido bien
		///	echo json_encode(array('status' => 'success', 'message' => 'Imagen guardada correctamente'));
		} else {
			// Ocurrió un error al guardar la imagen
			//echo json_encode(array('status' => 'error', 'message' => 'Error al guardar la imagen'));
		}
			

	break;
     case 'login':
       $n_usuario  = new usuario();


        $resultado = $n_usuario -> login( $correo, $contrasena);
         if($resultado ==TRUE){
            $n_usuario -> obtener_rol();
         } 
         echo $resultado;

        
         break;
         case 'registrar':
            $n_usuario  = new usuario();
     
             $resultado = $n_usuario -> registrar_usuario($rol, $nombre,  $contrasena,$correo, $telefono,$image);
           
              echo $resultado;
     
             
              break;
     
         default:
         case 'buscar':

            $n_usuario  = new usuario();
            $resultado = $n_usuario -> buscar_usuarios();
        
   
            foreach ($resultado as $key) {
               if($key['estado']=="1"){
                  $st = " checked";
               }else{
                  $st = "";
               }
   
               ?>
                   <tr>
                                               <td><?php echo $key['id']; ?></td>
                                               <td><?php echo $key['nombre']; ?></td>
                                               <td><img class="img-thumbnail preview-image2" src="../assets/upload/user/<?= $key['img']; ?>" alt="Mi imagen" onclick="openModal('../assets/upload/user/<?= $key['img']; ?>')"></td>
                                     
                                           
                                               <td><?php echo $key['rol']; ?></td>
                                               <td><?php echo $key['fecha_registro']; ?></td>
                                               <td>   
                                                     <?php include '../view/static/bt_estado.php';  ?>
                                               </td>
                                               <td>
                                               <div class="dropdown">
                                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Acciones
                                                         <i class="mdi mdi-chevron-down"></i>
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
                                                         <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos( '<?php echo $key['id']."','".$key['nombre']."','".$key['rol_id']."','".$key['telefono']."','".$key['email']."','".$key['img']."'"; ?>)">Modificar</a>
                                                         <a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id']; ?>)">Eliminar</a>
                                                      </div>
                                                </div>
                                               </td>
                                  
                   </tr>
   
   
               <?php
   
    
         
   
           }
               
          break;
          case 'buscar_asignados':

            $n_usuario  = new usuario();
            $resultado = $n_usuario -> buscar_asignado($_SESSION['id_usuario']);
        
   
            foreach ($resultado as $key) {
               if($key['estado']=="1"){
                  $st = " checked";
               }else{
                  $st = "";
               }
   
               ?>
                   <tr>
                                               <td><?php echo $key['id']; ?></td>
                                               <td><?php echo $key['nombre']; ?></td>
                                               <td><img width="100" height="70"src="../assets/upload/user/<?= $key['img']; ?>"  alt="Mi imagen" onclick="openModal('../assets/upload/user/<?= $key['img']; ?>')"></td>
                                     
                                           
                                            
                                               <td><?php echo $key['fecha_registro']; ?></td>
                                               <td>   
                                                     <?php include '../view/static/bt_estado.php';  ?>
                                               </td>
                                               <td>
                                               <div class="dropdown">
                                                      <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      Acciones
                                                         <i class="mdi mdi-chevron-down"></i>
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin: 0px;">
                                                         <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#myModal" onclick="cargar_datos( '<?php echo $key['id']."','".$key['nombre']."','".$key['rol_id']."','".$key['contrasena']."'"; ?>)">Modificar</a>
                                                         <a class="dropdown-item" href="#" onclick="eliminar(<?php echo $key['id']; ?>)">Eliminar</a>
                                                      </div>
                                                </div>
                                               </td>
                                  
                   </tr>
   
   
               <?php
   
    
         
   
           }
               
          break;  
          case 'cambiar_estado':

            $n_usuario  = new usuario();
            $resultado = $n_usuario -> cambiar_estado_usuario($id, $estado);
            echo 1;
               
          break;  
          case 'eliminar':
            
         
            $n_usuario  = new usuario();
            $resultado = $n_usuario -> eliminar_usuario($id);
           echo 1;
            
          break;
          case 'buscar_modificar':
   
            $n_usuario  = new usuario();
            $resultado = $n_usuario -> buscar_usuario_json($id);
            echo $resultado;
          
          break;    
          case 'modificar':
   
            $n_usuario  = new usuario();
            $resultado = $n_usuario -> modificar_usuario($id,$nombre, $rol,  $telefono, $correo, $image);
            echo $resultado;
          
          break; 
          case 'modificar':
   
            $n_usuario  = new usuario();
            $resultado = $n_usuario -> modificar_usuario($id,$nombre,  $contrasena, $rol);
            echo $resultado;
          
          break;    

          case 'cantidad_domiciliario':
   
            $n_usuario  = new usuario();
            $resultado = $n_usuario -> cantidad_domiciliario();
            foreach ($resultado as $key) {
               echo $key['cantidad'];
            }
          
          break;   
        
 }

 function generarNombreAleatorio($longitud) {
   $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $nombreAleatorio = '';

   for ($i = 0; $i < $longitud; $i++) {
       $indice = rand(0, strlen($caracteres) - 1);
       $nombreAleatorio .= $caracteres[$indice];
   }

   return $nombreAleatorio;
}



?>