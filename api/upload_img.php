<?php
include '../model/api.php';
$n_api  = new api();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si el archivo ha sido subido
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Configurar el nombre y la ruta donde se guardará el archivo
        $uploadFileDir = '../assets/upload/evidencia/';
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $dest_path = $uploadFileDir . $newFileName;

        // Mover el archivo subido a la ubicación final
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $resultado = $n_api -> entregado_orden_img($_POST['uid'],$_POST['id_orden'],$newFileName );
            echo json_encode(['status' => 'success', 'message' => 'Archivo subido correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al mover el archivo subido']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se ha enviado ningún archivo o hubo un error al subirlo']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>

