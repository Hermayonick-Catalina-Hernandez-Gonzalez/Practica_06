<?php

// Root de la aplicación a partir de http://localhost/
define("APP_ROOT", "/xampp/Practica_06/");

// Ruta física de la aplicación
define("APP_PATH", "C:/xampp/htdocs/xampp/Practica_06/");

// Directorio donde se van a subir los archivos
define("DIR_UPLOAD", "C:/xampp/htdocs/xampp/Practica_06/archivos/");

// Extensiones de archivos con su correspondiente content-type.
$CONTENT_TYPES_EXT = [
    "jpg" => "image/jpeg",
    "jpeg" => "image/jpeg",
    "gif" => "image/gif",
    "png" => "image/png",
    "json" => "application/json",
    "pdf" => "application/pdf",
    "bin" => "application/octet-stream"
];

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'my_db');
define('DB_USER', 'root@localhost');
define('DB_PASS', '');

function conectar() {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
    try {
        $conexion = new PDO($dsn, DB_USER, DB_PASS);
        // Establecer el modo de error de PDO a excepción
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        // Manejar errores de conexión
        die("Error de conexión a la base de datos: " . $e->getMessage());
    }
}