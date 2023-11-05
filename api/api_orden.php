<?php
include '../model/api.php';
// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir el cuerpo de la solicitud
    $data = file_get_contents("php://input");
   
    // Decodificar el cuerpo JSON en un arreglo asociativo
    $requestData = json_decode($data, true);
   
    // var_dump($requestData);
    // Verificar si se recibió la variable "nombre" y el array
    if (isset($requestData['total']) && isset($requestData['array'])) {
        $nombre = $requestData['total'];
        $array = $requestData['array'];
        
        // Hacer algo con $nombre y $array aquí
       // echo "Nombre: $nombre\n";
       // echo "Array: ";
       // print_r($array);
        var_dump($requestData['array']);
       





        $objeto = json_decode($requestData['array']);

    
      
       $id_cliente=$requestData['uid'];
      
    
       $telefono= ''; 
     
       $id_entrega=$requestData['direccion_entrega'];
       
       $metodo_pago=$requestData['metodo_pago'];

       $total=$requestData['total'];
       $descripcion =$requestData['description'];
       $product = "";
       $n_api  = new api();
       $resultado = $n_api -> registrar_orden($id_cliente,  $descripcion,    $id_entrega, $metodo_pago,  $total, $requestData['array']);

    } else {
        echo "Datos incompletos en la solicitud.";
    }
} else {
    echo "Método de solicitud no válido.";
}

// Obtener todas las peticiones GET y POST
$currentDate = date('Y-m-d H:i:s');
$data = array(
   'fecha' => $currentDate,
   'GET' => $_GET,
   'POST' => $_POST
);

// Ruta y nombre de archivo
$filename = 'peticiones_orden.json';

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