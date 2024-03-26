<?php
require "config.php";

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"])) {
    $nombreArchivo = $_POST["nombre-archivo"];
    $archivoSubido = $_FILES["archivo"];

    // Validar el tipo de archivo
    $tiposPermitidos = array('image/jpeg', 'image/png', 'image/gif', 'application/pdf');
    if (!in_array($archivoSubido["type"], $tiposPermitidos)) {
        $response["success"] = false;
        $response["message"] = "Tipo de archivo no permitido.";
    } else {
        // Si no se especifica un nombre, usar el nombre original del archivo
        if (empty($nombreArchivo)) {
            $nombreArchivo = $archivoSubido["name"];
        } else {
            // Concatenar la extensión del archivo original al nombre especificado
            $nombreArchivo .= '.' . pathinfo($archivoSubido["name"], PATHINFO_EXTENSION);
        }

        // Mover el archivo subido al directorio de destino
        $rutaDestino = DIR_UPLOAD . $nombreArchivo;
        if (move_uploaded_file($archivoSubido["tmp_name"], $rutaDestino)) {
            // Archivo subido exitosamente
            $response["success"] = true;
            $response["message"] = "Archivo subido exitosamente.";
            $response["nombreArchivo"] = $nombreArchivo;
        } else {
            // Error al subir el archivo
            $response["success"] = false;
            $response["message"] = "Error al subir el archivo.";
        }
    }
} else {
    $response["success"] = false;
    $response["message"] = "No se recibió ningún archivo.";
}

echo json_encode($response);
?>
