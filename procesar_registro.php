<?php
// Incluir la conexión a la base de datos y funciones de cifrado
include('conexion.php');
include('funciones_cifrado.php');

// Inicializar variables de error
$errors = array();

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['correo']); // Cambiado de 'username' a 'correo'
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $genero = $_POST['genero'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    // Validar que no haya campos vacíos
    if (empty($nombre) || empty($apellidos) || empty($correo) || empty($password) || empty($confirm_password) || empty($genero) || empty($fecha_nacimiento)) {
        $errors[] = "Todos los campos son obligatorios.";
    }

    // Validar dirección de correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El correo electrónico debe ser una dirección válida.";
    }

    // Validar que las contraseñas coincidan
    if ($password != $confirm_password) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    // Validar que el correo electrónico no esté registrado
    $query = "SELECT * FROM usuarios WHERE username='$correo'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $errors[] = "Ya existe un usuario registrado con ese correo electrónico.";
    }

    // Si no hay errores, registrar al usuario
    if (empty($errors)) {
        // Generar salt aleatorio
        $salt = generateSalt();

        // Generar hash SHA512 de la contraseña con el salt
        $password_encrypted = hash('sha512', $password . $salt);

        // Insertar usuario en la base de datos
       // Insertar usuario en la base de datos
        $query = "INSERT INTO usuarios (nombre, apellidos, username, password_encrypted, password_salt, genero, fecha_nacimiento) VALUES ('$nombre', '$apellidos', '$correo', '$password_encrypted', '$salt', '$genero', '$fecha_nacimiento')";
        if (mysqli_query($conn, $query)) {
            header("Location: registro_exitoso.php");
            exit();
        } else {
            $errors[] = "Error al registrar al usuario.";
        }
    }
}

// Si hay errores, mostrarlos en el formulario
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
}
?>
