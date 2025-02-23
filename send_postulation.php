<?php

require_once 'model/delivery.php'; // Incluir la clase Delivery
require_once 'model/usuario.php'; // Incluir la clase Delivery

$delivery = new Delivery();
$usuario = new usuario();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $numero = $_POST['numero'];
    $numero_emergencia = $_POST['numero_emergencia'];


    $id_usuario =  $usuario -> registro_delivery($nombre, $correo, $numero );

    // Carpeta de imágenes
    $directorio = "assets/upload/delivery/";
    if (!file_exists($directorio)) {
        mkdir($directorio, 0777, true);
    }

    // Función para subir imágenes
    function subirImagen($input_name, $directorio) {
        if (!empty($_FILES[$input_name]['name'])) {
            $archivo = time() . "_" . basename($_FILES[$input_name]['name']);
            $ruta = $directorio . $archivo;
            move_uploaded_file($_FILES[$input_name]['tmp_name'], $ruta);
            return $archivo;
        }
        return null;
    }

    // Subir imágenes
    $foto_cedula = subirImagen('foto_cedula', $directorio);
    $foto_licencia = subirImagen('foto_licencia', $directorio);
    $foto_soat = subirImagen('foto_soat', $directorio);
    $foto_tecnomecanica = subirImagen('foto_tecnomecanica', $directorio);
    $foto_tarjeta = subirImagen('foto_tarjeta', $directorio);
    $propiedad = subirImagen('propiedad', $directorio);
    $foto_facial = subirImagen('foto_facial', $directorio);

    // Estado por defecto
    $estado = 1;

    // Llamar a la función para registrar el delivery
    $resultado = $delivery->registrar_delivery(
        204, // ID por defecto
        $id_usuario,
        $nombre,
        $cedula,
        $foto_cedula,
        $foto_licencia,
        $foto_soat,
        $foto_tecnomecanica,
        $foto_tarjeta,
        $propiedad,
        $foto_facial,
        $direccion,
        $numero,
        $numero_emergencia,
        $estado
    );

    // Redirigir con mensaje de éxito o error
    if ($resultado) {
        echo "<script>
            alert('Registro exitoso');
            </script>
            <div style=\"text-align: center; margin-top: 50px; font-family: Arial, sans-serif;\">
                <h2>¡Gracias por registrarte en Enviar Express!</h2>
                <p>Tus datos serán evaluados por el administrador para su aprobación.</p>
            </div>;
        ";
    
        // Eliminar los datos del POST para evitar reenvío al recargar
        unset($_POST);
    } else {
        echo "<script>
            alert('Error en el registro');
             </script>
           <div style=\"text-align: center; margin-top: 50px; font-family: Arial, sans-serif;\">
                <h2>Hubo un error en el registro</h2>
                <p>Por favor, inténtalo nuevamente más tarde.</p>
            </div>';
       ";
    
        // También limpiar los datos POST en caso de error
        unset($_POST);
    }
}
?>
