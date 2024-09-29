<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class api{

    public function login($uid){

        $conexion = new Conexion();
     

        $sql = "SELECT  * FROM usuarios where  uid='".$uid."' and estado=1";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
            $result=["user"=>$consulta];
            
            $responseBody = '{"status_code": 200, "message": "OK"}';
          
           $data = array_merge(json_decode($responseBody, true),$result);

            echo json_encode($data);
            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }

    public function login_no_uid($email, $password){

        $conexion = new Conexion();
     

        $sql = "SELECT  * FROM usuarios where  email='".$email."'  and contrasena='".$password."' and estado=1";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";

        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();

        
        
      
        if ($consulta) {

            foreach ($consulta as $key) {
                if($key['uid']==""){
                $uid= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

                $sql = "UPDATE usuarios SET uid='".$uid."' where  email='".$email."' ";
                $_SESSION['uid'] =  $uid;
                $reg = $conexion->prepare($sql);
                $reg->execute();

                $sql = "SELECT  * FROM usuarios where  email='".$email."'  and contrasena='".$password."' and estado=1";
                // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
          
                  $reg = $conexion->prepare($sql);
          
                  $reg->execute();
                  $consulta =$reg->fetchAll();

                }

            }
            
            echo json_encode($consulta);

    
            //echo json_encode($consulta);
          
        }else{
            echo  "[]";
        }
                        
    }

    public function exist_user($email){

        $conexion = new Conexion();
        $sql = "SELECT  * FROM usuarios where  email='".$email."'";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
           echo 1;
          
        }else{
            echo  0;
        }
                        
    }

    public function save_fmc($uid,$fmc){

        $conexion = new Conexion();
     

        $sql = "UPDATE usuarios SET token_fcm='".$fmc."' where  uid='".$uid."' ";
        $reg = $conexion->prepare($sql);

        $reg->execute();
   

                        
    }

        public function update_uid($uid,$email){

        $conexion = new Conexion();
     

        $sql = "UPDATE usuarios SET uid='".$uid."' where  email='".$email."' ";
        $reg = $conexion->prepare($sql);

        $reg->execute();
   

                        
    }

    public function register_user_email($uid, $email, $name){
   
        $conexion = new Conexion();
        $sql = "INSERT INTO `usuarios`(`uid`, `id_rol`,`nombre`, `email`, `estado`) VALUES (:uid,:id_rol,:nombre,:email,:estado)";
        $reg = $conexion->prepare($sql);
    
        $reg->execute(array(':uid' => $uid,':id_rol' => "4",':nombre' => $name,':email' => $email,':estado' => "1"));

    
    }


    public function register_logs($method, $data ){
   
        $conexion = new Conexion();
 
        $sql = "INSERT INTO `logs`(`method`, `data`) VALUES (:method,:data)";
        $reg = $conexion->prepare($sql);
    
        $reg->execute(array(':method' => $method,':data' => $data));
     

    
    }


    public function registrar_orden_enrutador($method, $data ){
   
        $conexion = new Conexion();
 
        $sql = "INSERT INTO `logs`(`method`, `data`) VALUES (:method,:data)";
        $reg = $conexion->prepare($sql);
    
        $reg->execute(array(':method' => $method,':data' => $data));
     

    
    }


    public function set_location($uid, $latitude,  $longitude){

        $conexion = new Conexion();
        $estado_defaul = 1;
        $rol = 1;
        $lastlocation = date("Y-m-d H:i:s"); // Obtener la fecha y hora actuales en el formato adecuado

        // Consulta SQL para actualizar la tabla usuarios
        $sql = "UPDATE usuarios 
                SET latitud = :latitude, 
                    longitud = :longitude, 
                    lastlocation = :lastlocation 
                WHERE uid = :uid";
    
        $reg = $conexion->prepare($sql);
    
        // Asignar los valores a los parámetros de la consulta
        $reg->bindParam(':latitude', $latitude);
        $reg->bindParam(':longitude', $longitude);
        $reg->bindParam(':lastlocation', $lastlocation);
        $reg->bindParam(':uid', $uid);
    
        // Ejecutar la consulta y verificar si fue exitosa
        if ($reg->execute()) {
            return 1;
        } else {
            return 0;
        }
     
        return 1;
    
    }




    public function registrar_usuario($uid, $nombre,  $correo, $contrasena, $telefono, $fecha ){

        $conexion = new Conexion();
        $estado_defaul = 1;
        $rol = 1;
        $nuevaFecha = date("Y-m-d", strtotime($fecha));
    
        $sql = "INSERT INTO `usuarios`(`uid`,`id_rol`, `nombre`, `email`, `telefono`,  `contrasena`,`fecha`, `estado`) VALUES (:uid,:rol,:nombre,:correo,:telefono,:contrasena,:fecha,:estado)";
        $reg = $conexion->prepare($sql);
    
        $reg->execute(array(':rol' => $rol,':uid' => $uid, ':nombre' => $nombre, ':correo' => $correo, ':telefono' => $telefono, ':fecha' => $nuevaFecha,  ':contrasena' => $contrasena, ':estado' => $estado_defaul));
     
        return 1;
    
    }


    public function registrar_usuario_only( $nombre,  $correo, $contrasena, $telefono, $fecha ){

        $uid =  $this->register_user_firebase($correo, $contrasena);
        if($uid==1 || $uid==2){
            return $uid;
        }
   
        $conexion = new Conexion();
        $estado_defaul = 1;
        $rol = 4;
        $nuevaFecha = date("Y-m-d", strtotime($fecha));
    
        $sql = "INSERT INTO `usuarios`(`uid`,`id_rol`, `nombre`, `email`, `telefono`,  `contrasena`,`fecha`, `estado`) VALUES (:uid,:rol,:nombre,:correo,:telefono,:contrasena,:fecha,:estado)";
        $reg = $conexion->prepare($sql);
    
        $reg->execute(array(':rol' => $rol,':uid' => $uid, ':nombre' => $nombre, ':correo' => $correo, ':telefono' => $telefono, ':fecha' => $nuevaFecha,  ':contrasena' => $contrasena, ':estado' => $estado_defaul));
     
        return 3;
    
    }




    public function get_commerce(){

        $conexion = new Conexion();
     

        $sql = "SELECT  * FROM comercios where  estado=1";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
         
            echo json_encode($consulta);
            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }

    public function get_comerce_from_category($id_category){

        $conexion = new Conexion();
     

        $sql = "SELECT  * FROM comercios where  estado=1 and id_category=".$id_category."";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
         
            echo json_encode($consulta);
            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }

    public function get_category(){

        $conexion = new Conexion();
     

        $sql = "SELECT  * FROM category where  estado=1";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
         
            echo json_encode($consulta);
            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }

    public function get_user_delivery($uid){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT *, (select comercios.nombre from usuarios,comercios WHERE usuarios.id=comercios.id_user and usuarios.id=usu.id_comercio_asociate ) as comercio FROM usuarios usu where usu.uid='".$uid."' ;";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
             echo json_encode($consulta);
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }


     
    public function get_user_client($uid){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT * FROM usuarios usu where usu.uid='".$uid."' ;";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
             echo json_encode($consulta);
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }
 

    public function get_direcciones($uid, $tipo){
       //tipo= 1 entrega, 2 recogida
        $conexion = new Conexion();
     

        $sql = "SELECT direccion.* FROM direccion,usuarios where direccion.id_usuarios=usuarios.id and usuarios.uid='".$uid."' and direccion.estado=1 and tipo=".$tipo.";";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
         
            echo json_encode($consulta);
            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }


    public function direcciones_select($uid, $tipo){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT direccion.* FROM direccion,usuarios where direccion.id_usuarios=usuarios.id and usuarios.uid='".$uid."' and direccion.seleccionado=1 and  direccion.estado=1 and tipo=".$tipo.";";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
             echo json_encode($consulta);
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }
 
     public function get_config(){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT * FROM configuracion";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
             echo json_encode($consulta);
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }
     public function cancelado($uid,$id_mandado){

        $conexion = new Conexion();

        $sql = "SELECT * FROM usuarios where  uid='".$uid."' ;";
        echo $sql;
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
           
          
           $sql2 = "UPDATE orden SET  status_orden_envio=5  where  id_orden='".$id_mandado."' ;";
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
     
             $reg2->execute();
             $reg2->fetchAll();

            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }

    public function cancelado_mandado($uid,$id_mandado){

        $conexion = new Conexion();

        $sql = "SELECT * FROM usuarios where  uid='".$uid."' ;";
        echo $sql;
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
           
          
           $sql2 = "UPDATE mandado SET  estado=5  where  id_mandado='".$id_mandado."' ;";
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
     
             $reg2->execute();
             $reg2->fetchAll();

            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }

    public function get_mandados_map(){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql1 = "SELECT mandado.id_mandado as orden, direccion.latitude as latitude, direccion.longitude as longitude , 'mandado' as tipo, 'N' as external  FROM mandado,direccion WHERE mandado.id_entrega=direccion.id_direccion and mandado.estado=1;";
         $sql2 = "SELECT lista_orden.id_orden as orden, comercios.latitude as latitude, comercios.longitude as longitude, 'orden' as tipo ,  'N' as external  FROM `lista_orden` LEFT JOIN orden on orden.id_orden=lista_orden.id_orden LEFT JOIN producto on producto.id_producto=lista_orden.id_producto LEFT JOIN comercios on comercios.id_comercios=producto.id_comercios WHERE orden.status_orden_envio=1 GROUP BY lista_orden.id_orden;";
         $sql3 = "SELECT orden.id_orden as orden, comercios.latitude as latitude, comercios.longitude as longitude, 'orden_external' as tipo, 'N' as external FROM orden LEFT JOIN comercios on comercios.id_user=orden.id_tienda and userexternal='Y' WHERE orden.status_orden_envio=1 GROUP BY orden.id_orden;";
        $reg1 = $conexion->prepare($sql1);
        $reg2 = $conexion->prepare($sql2);
        $reg3 = $conexion->prepare($sql3);
 
         $reg1->execute();
         $reg2->execute();
         $reg3->execute();

         $consulta1 =$reg1->fetchAll();
         $consulta2 =$reg2->fetchAll();
         $consulta3 =$reg3->fetchAll();
         
         $resultado = array_merge($consulta1, $consulta2);
         $resultado = array_merge($resultado, $consulta3);
       
         if ($resultado) {
          
             echo json_encode($resultado);
             //echo json_encode($consulta);
           
         }else{
             return  0; //http_response_code(404);
         }
                         
     }

     
     public function get_mandados_from_map($id){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT *, 'test' as nombre FROM `mandado` where mandado.id_mandado=".$id." and mandado.estado=1;";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
             echo json_encode($consulta);
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }


     public function get_orden_from_map($id){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT orden.id_orden, orden.id_cliente as id_cliente, direccion.direccion, orden.metodo_pago, orden.valor, (SELECT usuarios.nombre from usuarios WHERE orden.id_cliente=usuarios.id) as nombre, comercios.nombre as empresa from orden LEFT JOIN direccion on direccion.id_usuarios=orden.id_cliente LEFT JOIN lista_orden on lista_orden.id_orden=orden.id_orden LEFT JOIN producto on producto.id_producto=lista_orden.id_producto LEFT JOIN comercios ON producto.id_comercios=comercios.id_comercios where orden.id_orden=".$id." and orden.status_orden_envio=1 and direccion.id_direccion=orden.id_entrega GROUP BY id_orden;";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
             echo json_encode($consulta);
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }
 
     public function get_orden_from_map_external($id){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT orden.id_orden, orden.id_user_external as id_cliente, (SELECT temporaluser.direccion from temporaluser WHERE orden.id_user_external=temporaluser.id) as direccion, orden.metodo_pago, orden.valor, (SELECT temporaluser.nombre from temporaluser WHERE orden.id_user_external=temporaluser.id) as nombre, comercios.nombre as empresa , comercios.id_comercios from orden LEFT JOIN comercios ON orden.id_tienda=comercios.id_user where orden.id_orden=".$id." and orden.status_orden_envio=1 GROUP BY id_orden;";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
             echo json_encode($consulta);
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }
 
 

     public function get_orden_pending($uid){

        $conexion = new Conexion();

        $sql = "SELECT * FROM usuarios where  uid='".$uid."' ;";
    
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
           
          
           $sql2 = "select * from orden where id_cliente=".$consulta[0]['id']."  and status_orden_envio < 2";
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
             $reg2->execute();
             $consulta2 =$reg2->fetchAll();
             echo json_encode($consulta2);
          
          
        }else{
            return http_response_code(404);
        }
                        
    }

    public function get_mandado_pending($uid){

        $conexion = new Conexion();

        $sql = "SELECT * FROM usuarios where  uid='".$uid."' ;";
    
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
           
          
           $sql2 = "select * from mandado where id_cliente=".$consulta[0]['id']."  and estado < 4";
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
             $reg2->execute();
             $consulta2 =$reg2->fetchAll();
             echo json_encode($consulta2);
          
          
        }else{
            return http_response_code(404);
        }
                        
    }


    public function update_direcciones($direccion, $tipo){

         $conexion = new Conexion();
 
         $sql = "SELECT direccion.* FROM direccion where  id_direccion='".$direccion."' ;";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
            
           
            $sql2 = "UPDATE direccion SET seleccionado=0  where  id_usuarios='".$consulta[0]['id_usuarios']."' and tipo='".$tipo."' ;";
            // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
              $reg2 = $conexion->prepare($sql2);
      
              $reg2->execute();
              $reg2->fetchAll();

              $sql3 = "UPDATE direccion SET seleccionado=1  where  id_direccion='".$direccion."' and tipo='".$tipo."' ;";
              // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
                $reg3 = $conexion->prepare($sql3);
        
                $reg3->execute();
                $reg3->fetchAll();
              
             
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }

     public function add_direccion($uid,$direccion,$telefono,$latitude,$longitude,$tipo){

        $conexion = new Conexion();

        $sql = "SELECT * FROM usuarios where  uid='".$uid."' ;";
        echo $sql;
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
           
          
           $sql2 = "INSERT INTO direccion  (`id_usuarios`, `nombre`, `direccion`, `telefono`, `latitude`, `longitude`, `seleccionado`, `tipo`,`estado`)
           VALUES (".$consulta[0]['id'].", '$direccion', '$direccion', '$telefono', $latitude, $longitude, 0, $tipo, 1)";
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
     
             $reg2->execute();
             $reg2->fetchAll();

            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }


     public function acept_mandado($uid,$id_mandado){

        $conexion = new Conexion();

        $sql = "SELECT * FROM usuarios where  uid='".$uid."' ;";
        echo $sql;
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
           
          
           $sql2 = "UPDATE mandado SET id_domiciliario='".$consulta[0]['id']."', estado=2  where  id_mandado='".$id_mandado."' ;";
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
     
             $reg2->execute();
             $reg2->fetchAll();

            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }

    public function acept_orden($uid,$id_orden){

        $conexion = new Conexion();

        $sql = "SELECT * FROM usuarios where  uid='".$uid."' ;";
        echo $sql;
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
           
          
           $sql2 = "UPDATE orden SET id_domiciliario='".$consulta[0]['id']."', status_orden_envio=2  where  id_orden='".$id_orden."' ;";
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
     
             $reg2->execute();
             $reg2->fetchAll();

            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }


    public function asosiate_delivery($uid,$id_comercio){

        $conexion = new Conexion();
          
           $sql2 = "UPDATE usuarios SET id_comercio_asociate='".$id_comercio."'  where  uid='".$uid."' ;";

           echo $sql2;
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
     
             $reg2->execute();
             $reg2->fetchAll();

             $sql3 = "SELECT * FROM usuarios where  uid='".$uid."' ;";
          
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg3 = $conexion->prepare($sql3);
     
             $reg3->execute();
             $consulta3 =$reg3->fetchAll();
             
           
             if ($consulta3) {
                $sql4 = "INSERT INTO `horas_ingreso`( tipo, comercio, usuario) VALUES (:tipo,:comercio,:usuario)";
                $reg4 = $conexion->prepare($sql4);
            
                $reg4->execute(array(':tipo' =>"ingreso",':comercio' => $id_comercio, ':usuario' => $consulta3[0]['id']));
             
                
             }


 

            //echo json_encode($consulta);
          
      
                        
    }


    public function en_camino($uid,$id_mandado){

        $conexion = new Conexion();

        $sql = "SELECT * FROM usuarios where  uid='".$uid."' ;";
        echo $sql;
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
           
          
           $sql2 = "UPDATE mandado SET  estado=3  where  id_mandado='".$id_mandado."' ;";
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
     
             $reg2->execute();
             $reg2->fetchAll();

            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }

    public function en_camino_orden($uid,$id_orden){

        $conexion = new Conexion();

        $sql = "SELECT * FROM usuarios where  uid='".$uid."' ;";
        echo $sql;
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
           
          
           $sql2 = "UPDATE orden SET  status_orden_envio=3  where  id_orden='".$id_orden."' ;";
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
     
             $reg2->execute();
             $reg2->fetchAll();

            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }


    public function entregado($uid,$id_mandado){

        $conexion = new Conexion();

        $sql = "SELECT * FROM usuarios where  uid='".$uid."' ;";
        echo $sql;
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
           
          
           $sql2 = "UPDATE mandado SET  estado=5  where  id_mandado='".$id_mandado."' ;";
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
     
             $reg2->execute();
             $reg2->fetchAll();

            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }


    public function entregado_orden($uid,$id_orden){

        $conexion = new Conexion();

        $sql = "SELECT * FROM usuarios where  uid='".$uid."' ;";
        echo $sql;
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
           
          
           $sql2 = "UPDATE orden SET  status_orden_envio=4  where  id_orden='".$id_orden."' ;";
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
             $reg2->execute();
             $reg2->fetchAll();

            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }


    public function entregado_orden_img($uid,$id_orden, $img){

        $conexion = new Conexion();

        $sql = "SELECT * FROM usuarios where  uid='".$uid."' ;";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
           
          
           $sql2 = "UPDATE orden SET  evidencia_img='".$img."'  where  id_orden='".$id_orden."' ;";
           // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
             $reg2 = $conexion->prepare($sql2);
             $reg2->execute();
             $reg2->fetchAll();

            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }


    public function registrar_mandado($id_cliente,  $descripcion,  $direccion, $telefono, $id_recogida,$id_entrega, $tipo_servicio,  $metodo_pago, $distancia,  $valor, $total)  {
   
        $conexion = new Conexion();
        $estado_defaul = 1;
        

        $sql = "SELECT id FROM usuarios where  uid='".$id_cliente."' ;";
        // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
          $reg = $conexion->prepare($sql);
  
          $reg->execute();
          $consulta =$reg->fetchAll();


          if ($consulta) {
            
                                                
            $sql2 = "INSERT INTO `mandado`(
                `id_cliente`,  
                `descripcion`,  
                `telefono`,  
                `direccion`,  
                `id_entrega`,   
                `id_recogida`,   
                `tipo_servicio`,   
                `metodo_pago`, 
                `distancia`, 
                `valor`, 
                `total`
            ) 
            VALUES (
                :id_cliente,  
                :descripcion,  
                :telefono,   
                :direccion,     
                :id_entrega,    
                :id_recogida, 
                :tipo_servicio, 
                :metodo_pago, 
                :distancia,  /* Corregido: se eliminó el segundo dos puntos */
                :valor, 
                :total
            )";
            
            $reg2 = $conexion->prepare($sql2);
            
            $reg2->execute(array(
                ':id_cliente' => $consulta[0]['id'], 
                ':descripcion' => $descripcion,
                ':direccion' => $direccion,
                ':telefono' => $telefono,
                ':id_recogida' => $id_recogida,
                ':id_entrega' => $id_entrega,
                ':tipo_servicio' => $tipo_servicio,
                ':metodo_pago' => $metodo_pago,
                ':distancia' => $distancia,  /* Corregido: se eliminó el segundo dos puntos */
                ':valor' => $valor,
                ':total' => $total
            ));
    
                $lastInsertId = $conexion->lastInsertId();

            
    
      }

}



     public function registrar_orden($id_cliente,  $descripcion,$id_entrega,  $metodo_pago,  $valor,  $products){
   
        $conexion = new Conexion();
        $estado_defaul = 1;
        

        $sql = "SELECT id FROM usuarios where  uid='".$id_cliente."' ;";
        // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
          $reg = $conexion->prepare($sql);
  
          $reg->execute();
          $consulta =$reg->fetchAll();
       

          $pattern = '/producto\(id=(\d+), nombre=([^,]+), descripcio=([^,]+), valor=(\d+), img=([^,]+), cantidad=(\d+)\)/';

            // Inicializa un array para almacenar los objetos
            $productos = [];

            // Encuentra todas las coincidencias y crea objetos a partir de ellas
            if (preg_match_all($pattern, $products, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $producto = new stdClass(); // Crea un objeto vacío
                    $producto->id = intval($match[1]);
                    $producto->nombre = $match[2];
                    $producto->descripcio = $match[3];
                    $producto->valor = intval($match[4]);
                    $producto->img = $match[5];
                    $producto->cantidad = intval($match[6]);
                    
                    // Agrega el objeto al array de productos
                    $productos[] = $producto;
                }
            }
         $cantidadRegistros = count($productos);

        
          if ($consulta) {
             
        
 
       
                $sql2 = "INSERT INTO `orden`( `id_cliente`, `descripcion`,  `id_entrega`,  `metodo_pago`,  `valor`,   `estado`) VALUES ( :id_cliente,  :descripcion,  :id_entrega,  :metodo_pago,  :valor, :estado)";
                $reg2 = $conexion->prepare($sql2);
            
                $reg2->execute(array(':id_cliente' => $consulta[0]['id'], ':descripcion' => $descripcion,   ':id_entrega' => $id_entrega,':metodo_pago' => $metodo_pago,':valor' => $valor, ':estado' => $estado_defaul));
                $lastInsertId = $conexion->lastInsertId();

                
                for ($i = 0; $i < $cantidadRegistros; $i++) {

                    $total = $productos[$i]->cantidad * $productos[$i]->valor;
                
                 
                    $sql3 = "INSERT INTO `lista_orden`( `id_orden` , `id_producto`, `cantidad`, `valor_uni`, `valor_total`, `estado`) VALUES ( :id_orden, :id_producto,  :cantidad, :valor_uni, :valor_total, :estado)";
                    $reg3 = $conexion->prepare($sql3);
                    $reg3->execute(array('id_orden'=> $lastInsertId,  'id_producto' => $productos[$i]->id, ':cantidad' => $productos[$i]->cantidad, ':valor_uni' => $productos[$i]->valor,  ':valor_total' => $total, ':estado' => $estado_defaul));
                

              //  $this->send_notification_delivery();
          }
    
    }

}

public function obtener_domiciliario($uid){
    //tipo= 1 entrega, 2 recogida
     $conexion = new Conexion();
  

     $sql = "SELECT 'test' as nombre, '12345678' as telefono";
   // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
     $reg = $conexion->prepare($sql);

     $reg->execute();
     $consulta =$reg->fetchAll();
     
   
     if ($consulta) {
      
         echo json_encode($consulta);
         //echo json_encode($consulta);
       
     }else{
         return http_response_code(404);
     }
                     
 }

        public function get_orden_mandado($uid){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT mandado.* FROM mandado, usuarios WHERE usuarios.id=mandado.id_cliente and mandado.estado<5 and usuarios.uid='".$uid."'";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
             echo json_encode($consulta);
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }

     public function get_orden($uid){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT orden.* FROM orden, usuarios WHERE usuarios.id=orden.id_cliente and orden.status_orden_envio<5 and usuarios.uid='".$uid."'";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
        
             echo json_encode($consulta);
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }

     public function product_from_comerce($id_comercio){

         $conexion = new Conexion();
         $sql = "SELECT * FROM `producto` where estado=1 and id_comercios=".$id_comercio.";";

         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
             echo json_encode($consulta);
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }

     public function get_product($id_producto){

        $conexion = new Conexion();
        $sql = "SELECT * FROM `producto` where estado=1 and id_producto=".$id_producto.";";

        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
         
            echo json_encode($consulta);
            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }

     public function get_comercio($id_comercio){

        $conexion = new Conexion();
        $sql = "SELECT comercios.*, category.nombre as categoria FROM `comercios`, category where category.id_category=comercios.id_category and comercios.estado=1 and comercios.id_comercios=".$id_comercio.";";

        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
         
            echo json_encode($consulta);
            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }



     public function get_all_orden($uid){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT mandado.*,
         CASE mandado.estado
        WHEN '1' THEN 'iniciado'
        WHEN '2' THEN 'aceptada'
        WHEN '3' THEN 'en camino'
        WHEN '5' THEN 'finalizada'
        WHEN '6' THEN 'cancelada'
        ELSE 'error'
    END AS estado_descripcion FROM mandado, usuarios
            WHERE usuarios.id=mandado.id_domiciliario and usuarios.uid='".$uid."'";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
             echo json_encode($consulta);
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }


     public function is_in_mandado($uid){
     
         $conexion = new Conexion();
      
 
         $sql = "SELECT mandado.* FROM mandado, usuarios WHERE usuarios.id=mandado.id_domiciliario and mandado.estado<5 and usuarios.uid='".$uid."'";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
             echo json_encode($consulta);
             //echo json_encode($consulta);
           
         }else{
             return http_response_code(404);
         }
                         
     }


     public function is_in_orden($uid){
     
        $conexion = new Conexion();
     

        $sql = "SELECT orden.* FROM orden, usuarios WHERE usuarios.id=orden.id_domiciliario and orden.status_orden_envio<4 and usuarios.uid='".$uid."'";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
         
            echo json_encode($consulta);
            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }

     public function is_in_mandado_whith_direction($uid){
     
        $conexion = new Conexion();
     

        $sql = "SELECT mandado.*, direccion.telefono as tele_direccion,  direccion.latitude as latitude_direccion, direccion.longitude as longitude_direccion, (select usuarios.nombre from usuarios where usuarios.id=mandado.id_cliente) as cliente FROM mandado, usuarios,direccion WHERE usuarios.id=mandado.id_domiciliario and direccion.id_direccion=mandado.id_recogida and mandado.estado<5 and usuarios.uid='".$uid."'";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
         
            echo json_encode($consulta);
            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }


    public function ordenes_asignadas($uid){
     
        $conexion = new Conexion();
        $sql = "SELECT orden.* ,(SELECT comercios.nombre from comercios WHERE comercios.id_user=orden.id_tienda) as tienda,  0 as distancia, direccion.telefono as tele_direccion, (SELECT comercios.latitude from comercios WHERE comercios.id_user=orden.id_tienda)  as latitude, (SELECT comercios.longitude from comercios WHERE comercios.id_user=orden.id_tienda) as longitude, (select usuarios.nombre from usuarios where usuarios.id=orden.id_cliente) as cliente FROM orden left join direccion on direccion.id_direccion=orden.id_entrega left join usuarios on usuarios.id=orden.id_domiciliario where orden.status_orden_envio<5 and usuarios.uid='".$uid."'";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
         
            echo json_encode($consulta);
            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }

    public function recoger_list($uid){
     
        $conexion = new Conexion();
        $sql = "SELECT orden.* , (
    SELECT
        direccion
    FROM
        temporaluser
    WHERE
        orden.id_user_external = temporaluser.id
) AS direccion,(SELECT comercios.nombre from comercios WHERE comercios.id_user=orden.id_tienda) as tienda,  0 as distancia, direccion.telefono as tele_direccion, (SELECT comercios.latitude from comercios WHERE comercios.id_user=orden.id_tienda)  as latitude, (SELECT comercios.longitude from comercios WHERE comercios.id_user=orden.id_tienda) as longitude, (select usuarios.nombre from usuarios where usuarios.id=orden.id_cliente) as cliente FROM orden left join direccion on direccion.id_direccion=orden.id_entrega left join usuarios on usuarios.id=orden.id_domiciliario where orden.status_orden_envio<5 and usuarios.uid='".$uid."' and orden.recogido=1";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
         
            echo json_encode($consulta);
            //echo json_encode($consulta);
          
        }else{
            return http_response_code(404);
        }
                        
    }



    public function is_in_order_whith_direction($uid){
     
        $conexion = new Conexion();
     

        $sql = "SELECT orden.*, 0 as distancia, direccion.telefono as tele_direccion, direccion.latitude as latitude_direccion, direccion.longitude as longitude_direccion, (select usuarios.nombre from usuarios where usuarios.id=orden.id_cliente) as cliente FROM orden left join direccion on direccion.id_direccion=orden.id_entrega left join usuarios on usuarios.id=orden.id_domiciliario where orden.status_orden_envio<5 and usuarios.uid='".$uid."'";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
         
            echo json_encode($consulta);
            //echo json_encode($consulta);
          
        }else{
            $sql2 = "SELECT orden.*, 
            0 as distancia, 
            (select temporaluser.telefono from temporaluser where temporaluser.id=orden.id_user_external) as tele_direccion, 
            0 as latitude_direccion, 
            0 as longitude_direccion, 
            (select temporaluser.nombre from temporaluser where temporaluser.id=orden.id_user_external) as cliente 
            FROM orden, usuarios WHERE 
            usuarios.id=orden.id_domiciliario 
            and orden.status_orden_envio<5 and usuarios.uid='".$uid."';";
          // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
            $reg2 = $conexion->prepare($sql2);
    
            $reg2->execute();
            $consulta2 =$reg2->fetchAll();
            
          
            if ($consulta2) {
             
                echo json_encode($consulta2);
                //echo json_encode($consulta);
              
            }else{
                return 0;
                //return http_response_code(404);
            }
        }
                        
    }

    public function is_in_order_whith_direction_external($uid){
     
        $conexion = new Conexion();
     

        $sql = "SELECT orden.*, 
        0 as distancia, 
        (select temporaluser.telefono from temporaluser where temporaluser.id=orden.id_user_external) as tele_direccion, 
        0 as latitude_direccion, 
        0 as longitude_direccion, 
        (select temporaluser.nombre from temporaluser where temporaluser.id=orden.id_user_external) as cliente 
        FROM orden, usuarios WHERE 
        usuarios.id=orden.id_domiciliario 
        and orden.status_orden_envio<5 and usuarios.uid='".$uid."';";
      // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
         
            echo json_encode($consulta);
            //echo json_encode($consulta);
          
        }else{
            return 0;
            //return http_response_code(404);
        }
                        
    }

     public function send_notification_delivery(){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT  * FROM usuarios where  estado=1";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
         // Datos de configuración
            $serverKey = 'AAAA9NT8Y_s:APA91bF3Vg1-fBH9y2OBWeZltDdE5LnSpMNskB8CA1bI7xHYRCYTEV2zqruyfDFTUyKAI69HWrlNRZ39bROnu67Ec14PRgX-OgUqknl53MAbuXg9Yl-Wk1xc3xZoKBsv2Htw3ja9lB-N'; // La clave del servidor de Firebase
            $deviceToken = 'elV9L-kYQc61fnZmKI4PMC:APA91bGUtHQ6G1lXqIeyqdw1PF1mZ6pNYKcyQyIsYe5tLbL7FgEZEgDpN1naYXQw5eo51oRov9irL0iP44ZxBrIw9aKHG5t4eimQYBoMb2hrROZiQB5o7BB-s6THVxY9Zse0x1FtKbub'; // El token de registro del dispositivo
            $message = array(
                'title' => 'Se encuentra un nuevo pedido',
                'body' => ''
            );
            $notification = array('title' => 'Título de la notificación', 'text' => 'Contenido de la notificación');

            // Construir el arreglo de datos
            $data = array(
                'to' => $deviceToken,
                'notification' => $notification,
                'data' => $message
            );

            // Convertir el arreglo a JSON
            $jsonData = json_encode($data);

            // Configurar la petición cURL
            $ch = curl_init('https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: key=' . $serverKey
            ));

            // Enviar la petición
            $result = curl_exec($ch);

            // Verificar el resultado
            if ($result === false) {
                echo 'Error al enviar la notificación: ' . curl_error($ch);
            } else {
                echo 'Notificación enviada con éxito.';
            }

            // Cerrar la conexión cURL
            curl_close($ch);
           
         }else{
             return http_response_code(404);
         }
                         
     }


     public  function register_user_firebase($email, $pass ){
        $serverKey = 'AIzaSyC555XnHjO6tUnOrGe6K7ZiocoIdnZLH50';
        $url = 'https://identitytoolkit.googleapis.com/v1/accounts:signUp?key='.$serverKey;
        
        $data = array(
            'email' => $email,
            'password' => $pass,
            'returnSecureToken' => true
        );
        
        $data_string = json_encode($data);
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        ));
        
        $result = curl_exec($ch);
        curl_close($ch);
     
        $response = json_decode($result, true);
        if(isset($response['localId'])){
            return $response['localId'];
        }else{
            if( $response['error']['message']=="WEAK_PASSWORD : Password should be at least 6 characters"){
                return 1;
            }elseif( $response['error']['message']=="INVALID_EMAIL"){
                return 2;
            }
            
        }
       
     }


     public function send_notification_status($status){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT  * FROM usuarios where  estado=1";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
          
         // Datos de configuración
            $serverKey = 'AAAA9NT8Y_s:APA91bF3Vg1-fBH9y2OBWeZltDdE5LnSpMNskB8CA1bI7xHYRCYTEV2zqruyfDFTUyKAI69HWrlNRZ39bROnu67Ec14PRgX-OgUqknl53MAbuXg9Yl-Wk1xc3xZoKBsv2Htw3ja9lB-N'; // La clave del servidor de Firebase
            $deviceToken = 'f9As-K2FSYmTVIvnDQOs7Z:APA91bGqn8OVov-iJKwy7VH2u5zlYxNF1cqh2OqgnMg9b-fQYq-H0jYG68klzCkVpTSZoZox7Q-93l8iRhBJk7bDNy61IZOG8gfyOyp2zJVYhcucR_WFRlA9MdKLj_lBy5xR6YNdSJ2z'; // El token de registro del dispositivo
            $message = array(
                'title' => 'Se encuentra un nuevo pedido',
                'body' => '',
                'status' => $status 
            );
            $notification = array('title' => 'Título de la notificación', 'text' => 'Contenido de la notificación');

            // Construir el arreglo de datos
            $data = array(
                'to' => $deviceToken,
                'notification' => $notification,
                'data' => $message
            );

            // Convertir el arreglo a JSON
            $jsonData = json_encode($data);

            // Configurar la petición cURL
            $ch = curl_init('https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: key=' . $serverKey
            ));

            // Enviar la petición
            $result = curl_exec($ch);

            // Verificar el resultado
            if ($result === false) {
                echo 'Error al enviar la notificación: ' . curl_error($ch);
            } else {
                echo 'Notificación enviada con éxito.';
            }

            // Cerrar la conexión cURL
            curl_close($ch);
           
         }else{
             return http_response_code(404);
         }
                         
     }


     public function recoger_pedido($id_orden){

        $conexion = new Conexion();
     

        $sql = "UPDATE orden SET recogido='1' where  id_orden='".$id_orden."' ";
        $reg = $conexion->prepare($sql);
        echo $sql;
        $reg->execute();
        

                        
    }



}

?>