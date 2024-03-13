<?php


          
         // Datos de configuración
            $serverKey = 'AAAA9NT8Y_s:APA91bF3Vg1-fBH9y2OBWeZltDdE5LnSpMNskB8CA1bI7xHYRCYTEV2zqruyfDFTUyKAI69HWrlNRZ39bROnu67Ec14PRgX-OgUqknl53MAbuXg9Yl-Wk1xc3xZoKBsv2Htw3ja9lB-N'; // La clave del servidor de Firebase
            $deviceToken = 'ewMUOuueSIqW-4gVrCi9bQ:APA91bGE8d7vu01OeVyksXJemXT_B8sK-3oEtspDLNu09HpjdFad7-LAflK7SvD7PsY-rpzXk_CUsG3N5o5LULM3k94-orHSw2W9LYdZppIcXxEeCXLn8epZqcBds9WoocU_vrrxxq4F'; // El token de registro del dispositivo
           
            $message = array(
                'title' => 'Se encuentra un nuevo pedido',
                'body' => '',
                'status' => "23"
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
            echo $result;
            // Verificar el resultado
            if ($result === false) {
                echo 'Error al enviar la notificación: ' . curl_error($ch);
            } else {
                echo 'Notificación enviada con éxito.';
            }

            // Cerrar la conexión cURL
            curl_close($ch);
           
   
                         


?>