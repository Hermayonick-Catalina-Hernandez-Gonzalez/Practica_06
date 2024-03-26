<?php
require "config.php";

// Obtener la lista de archivos en el directorio
$archivos = scandir(DIR_UPLOAD);
$archivos = array_diff($archivos, array(".", "..")); // Eliminar las entradas "." y ".."

// Mostrar la lista de archivos en formato de tabla
echo "<table>";
echo "<tr><th>Nombre del archivo</th><th>Tamaño del archivo (KB)</th><th>Borrar</th></tr>";
foreach ($archivos as $archivo) {
    $rutaArchivo = DIR_UPLOAD . $archivo;
    $tamañoKB = round(filesize($rutaArchivo) / 1024, 2); // Tamaño en KB
    echo "<tr>";
    echo "<td><a href='archivo.php?nombre=" . urlencode($archivo) . "' target='_blank'>$archivo</a></td>";
    echo "<td>$tamañoKB</td>";
    echo "<td><button class='boton-borrar' data-nombre='$archivo'>Borrar</button></td>";
    echo "</tr>";
}
echo "</table>";
?>
