<?php
require "config.php";

$nombreArchivo = filter_input(INPUT_GET, "nombre");
if (!$nombreArchivo) {
    http_response_code(400);
    exit();
}

$rutaArchivo = DIR_UPLOAD . $nombreArchivo;
if (file_exists($rutaArchivo)) {
    if (unlink($rutaArchivo)) {
        echo "OK";
    } else {
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
?>
