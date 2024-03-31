<?php
if(isset($conect)){if($conect==1){}else{include 'db.php';$conect =1;}}else{include 'db.php';$conect =1;}
class mensaje {
	public $conexion;
	private $mensaje;
	private $descripcion;


	public function __construct(){
		$this->conexion = new Conexion();
	}


	public function registrar_mensaje($id='204',$mensaje,$descripcion,$tipo,$estado){
	$estado_defaul = 1;
	$sql = "INSERT INTO `mensaje`(`estado`,`mensaje`,`descripcion`,tipo) VALUES (:estado,:mensaje,:descripcion,:tipo)";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':estado' => $estado_defaul,':mensaje' => $mensaje,':descripcion' => $descripcion,':tipo' => $tipo));
	return 1;
	}
	public function buscar_mensaje(){$sql = "SELECT  * FROM mensaje ";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$consulta =$reg->fetchAll();
	if ($consulta) {
		return $consulta;
	}else{
		return 0;
	} }
	public function cambiar_estado_mensaje($id, $estado){$sql = "UPDATE `mensaje` SET `estado`=:estado WHERE id_mensaje=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado));
	}
	public function eliminar_mensaje($id){$sql = "DELETE FROM `mensaje`  WHERE id_mensaje=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id));
	}
	public function modificar_mensaje($id, $estado,$mensaje,$descripcion){
	$sql = "UPDATE `mensaje` SET `estado`=:estado ,`mensaje`=:mensaje,`descripcion`=:descripcion WHERE id_mensaje=:id";
	$reg = $this->conexion->prepare($sql);
	$reg->execute(array(':id' => $id, ':estado' => $estado,':mensaje' => $mensaje,':descripcion' => $descripcion));
	}
	public function buscar_json_mensaje($id){$sql = "SELECT  * FROM rol where id=".$id."";
	$reg = $this->conexion->prepare($sql);
	$reg->execute();
	$results = $reg->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($results);
	}
	public function rango() {
		// C�digo del m�todo aqu�
	}
	public function send_notification($tipo, $mensaje){
        //tipo= 1 entrega, 2 recogida
         $conexion = new Conexion();
      
 
         $sql = "SELECT  * FROM usuarios where  id_rol=".$tipo."";
       // $sql = "SELECT  * FROM usuarios where usuario='jose' and contrasena='123' and estado=1";
         $reg = $conexion->prepare($sql);
 
         $reg->execute();
         $consulta =$reg->fetchAll();
         
       
         if ($consulta) {
			
          
         // Datos de configuración
            $serverKey = 'AAAA9NT8Y_s:APA91bF3Vg1-fBH9y2OBWeZltDdE5LnSpMNskB8CA1bI7xHYRCYTEV2zqruyfDFTUyKAI69HWrlNRZ39bROnu67Ec14PRgX-OgUqknl53MAbuXg9Yl-Wk1xc3xZoKBsv2Htw3ja9lB-N'; // La clave del servidor de Firebase
            //$deviceToken = 'elV9L-kYQc61fnZmKI4PMC:APA91bGUtHQ6G1lXqIeyqdw1PF1mZ6pNYKcyQyIsYe5tLbL7FgEZEgDpN1naYXQw5eo51oRov9irL0iP44ZxBrIw9aKHG5t4eimQYBoMb2hrROZiQB5o7BB-s6THVxY9Zse0x1FtKbub'; // El token de registro del dispositivo
			$deviceTokens=[];
			foreach( $consulta as $user){
				$deviceTokens[] =  $user['token_fcm'];
			}
			
			$message = array(
                'title' => $mensaje,
                'body' => ''
            );
            $notification = array('title' =>  $mensaje, 'text' => 'Contenido de la notificación');

            // Construir el arreglo de datos
            $data = array(
                'registration_ids' => $deviceTokens,
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
			var_dump($result);
            // Verificar el resultado
            if ($result === false) {
                echo 'Error al enviar la notificación: ' . curl_error($ch);
            } else {
              //  echo 'Notificación enviada con éxito.';
            }

            // Cerrar la conexión cURL
            curl_close($ch);
           
         }else{
             return http_response_code(404);
         }
                         
     }

}
?>