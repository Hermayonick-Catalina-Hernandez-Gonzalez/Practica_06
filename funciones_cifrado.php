<?php
// Función para generar un salt aleatorio
function generateSalt() {
    return bin2hex(random_bytes(32)); // Salt de 64 caracteres
}
?>