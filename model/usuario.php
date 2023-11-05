<?php
session_start();
if(isset($conect)){

    if($conect==1){

    }else{
        include 'db.php';
        $conect =1;
    }
    
  
}else{
    include 'db.php';
    $conect =1;
}
class usuario {
    public $rol; 


    public function registrar_usuario($rol, $nombre,  $contrasena,$correo,$telefono,$img ){
   
        $conexion = new Conexion();
        $estado_defaul = 1;
        //se condiciona para que el domiciliario se le cree el uid automaticamente en el registro
        if($rol==3){
            $bytesAleatorios = random_bytes(24 / 2);
            $uid = bin2hex($bytesAleatorios);
            $sql = "INSERT INTO `usuarios`(`id_rol`, `nombre`,   `contrasena`, `estado`, `email`,`telefono`,`img`, `uid`) VALUES (:rol,:nombre,:contrasena,:estado,:correo,:telefono,:img, :uid)";
       
            $reg = $conexion->prepare($sql);
    
            $reg->execute(array(':rol' => $rol, ':nombre' => $nombre,   ':contrasena' => $contrasena, ':estado' => $estado_defaul, ':correo' => $correo, ':telefono' => $telefono,':img' => $img,':uid' => $uid));
        }else{
            $sql = "INSERT INTO `usuarios`(`id_rol`, `nombre`,   `contrasena`, `estado`, `email`,`telefono`,`img`) VALUES (:rol,:nombre,:contrasena,:estado,:correo,:telefono,:img)";
            $reg = $conexion->prepare($sql);
    
            $reg->execute(array(':rol' => $rol, ':nombre' => $nombre,   ':contrasena' => $contrasena, ':estado' => $estado_defaul, ':correo' => $correo, ':telefono' => $telefono,':img' => $img));
        }

    
     
        return 1;
    
    }


    public function buscar_usuarios(){
   
        $conexion = new Conexion();
    
        $sql = "SELECT usuarios.id as id, rol.descripcion as rol, usuarios.nombre,  rol.id as rol_id,  `contrasena`, usuarios.estado as estado, usuarios.fecha_registro, usuarios.img, usuarios.email, usuarios.telefono FROM usuarios, rol WHERE rol.id=usuarios.id_rol; ";
        $reg = $conexion->prepare($sql);
    
        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
    
            return $consulta;
    
        }else{
            return 0;
        }
    }
    

    
    public function buscar_asignado($id){
   
        $conexion = new Conexion();
    
        $sql = "SELECT usuarios.id as id, rol.descripcion as rol, usuarios.nombre,  rol.id as rol_id,  `contrasena`, usuarios.estado as estado, usuarios.fecha_registro, usuarios.img FROM usuarios, rol WHERE rol.id=usuarios.id_rol and id_comercio_asociate='".$id."' ";
        $reg = $conexion->prepare($sql);
    
        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
    
            return $consulta;
    
        }else{
            return 0;
        }
    }
    
    


    public function login($usuario, $contrasena){

        $conexion = new Conexion();


        $sql = "SELECT  * FROM usuarios where email='".$usuario."' and contrasena='".$contrasena."' and estado=1";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
        
      
        if ($consulta) {
            foreach ($consulta as $key) {
        
                $_SESSION['nombre'] =  $key['nombre'];
           
                $_SESSION['id_usuario'] =  $key['id'];
                $this->rol = $key['id_rol'];

                if($key['id_rol']==2){

                    $sql = "SELECT  * FROM comercios where id_user='".$_SESSION['id_usuario']."' ";
                    $reg = $conexion->prepare($sql);
            
                    $reg->execute();
                    $consulta =$reg->fetchAll();
                  
                    if ($consulta) {
                        foreach ($consulta as $key) {
            
                            $_SESSION['nombre_tienda'] =  $key['nombre'];
                            $_SESSION['id_tienda'] =  $key['id_comercios'];
                
                        }
                        
                
                    }

                }
    
            }
            
            return true;
        }else{
            return false;
        }
                        
    }


    public function obtener_rol(){

 
        $conexion = new Conexion();


        $sql = "SELECT  * FROM rol where id='".$this->rol."' ";
        $reg = $conexion->prepare($sql);

        $reg->execute();
        $consulta =$reg->fetchAll();
      
        if ($consulta) {
            foreach ($consulta as $key) {

                $_SESSION['rol'] =  $key['nombre'];
    
            }
            
    
        }
        
    }



    
public function cambiar_estado_usuario($id, $estado){
   
    $conexion = new Conexion();
    $estado_defaul = 1;

    $sql = "UPDATE `usuarios` SET `estado`=:estado WHERE id=:id";
    $reg = $conexion->prepare($sql);

    $reg->execute(array(':id' => $id, ':estado' => $estado));


}

public function eliminar_usuario($id){
   
    $conexion = new Conexion();
    $estado_defaul = 1;

    $sql = "DELETE FROM `usuarios`  WHERE id=:id";
    $reg = $conexion->prepare($sql);

    $reg->execute(array(':id' => $id));


}

public function modificar_usuario($id,$nombre,$id_rol, $telefono, $correo, $img ){
   
    $conexion = new Conexion();
  

    $sql = "UPDATE `usuarios` SET `nombre`=:nombre, `id_rol`=:id_rol, `telefono`=:telefono, `email`=:correo,  `img`=:img  WHERE id=:id";
    $reg = $conexion->prepare($sql);

    $reg->execute(array(':id' => $id ,':nombre' => $nombre,':id_rol' => $id_rol,':telefono' => $telefono,':correo' => $correo,':img' => $img));

    return 1;
}

 

public function buscar_usuario_json($id){
   
    $conexion = new Conexion();

    $sql = "SELECT  * FROM usuarios where id=".$id."";
    $reg = $conexion->prepare($sql);

    $reg->execute();

    $results = $reg->fetchAll(PDO::FETCH_ASSOC);
    return $json = json_encode($results);

}

public function cantidad_domiciliario(){
    $conexion = new Conexion();
    $sql = "SELECT  count(*) as cantidad FROM usuarios where id_rol='3' ";
    $reg = $conexion->prepare($sql);
    $reg->execute();
    $consulta =$reg->fetchAll();
    if ($consulta) {
        return $consulta;
    }else{
        return 0;
    } 
}
    




}

?>