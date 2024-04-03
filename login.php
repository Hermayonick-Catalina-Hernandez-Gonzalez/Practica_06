<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de Sesión</title>
  <link rel="stylesheet" href="./estilos/styles.css">
</head>
<body>
  <div class="container">
    <div class="card">
      <h2>Bienvenidos</h2>
      <form class="form" action="./login.php" method="post">
        <input type="text" placeholder="Nombre" name="nombre" id="nombre">
        <input type="password" placeholder="Contraseña" name="password" id="password">
        <button type="submit" class="button">Iniciar</button>
        <div class="links">
        <button type="button" onclick="window.location.href='./registro.php'" class="registro-button">Registrarse</button>
          <a class="olvido" href="./contraseñaOlvidada.php">¿Olvidaste tu contraseña?</a>
        </div>
      </form>
      <?php
        // Incluir la conexión a la base de datos y la función de autenticación
        require "./conexion.php";
        require "./login-helper.php";

        // Verificar si se envió el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener el correo electrónico y la contraseña del formulario
            $correo = $_POST['nombre'];
            $password = $_POST['password'];

            // Query para obtener el usuario con el correo electrónico proporcionado
            $query = "SELECT * FROM usuarios WHERE username='$correo'";
            $result = mysqli_query($conn, $query);

            // Verificar si se encontró un usuario con ese correo electrónico
            if (mysqli_num_rows($result) > 0) {
                $usuario = mysqli_fetch_assoc($result);
                
                // Verificar la contraseña ingresada con la contraseña en la base de datos
                if (password_verify($password, $usuario['password_encrypted'])) {
                    // Si la contraseña es correcta, iniciar la sesión y redirigir al usuario
                    session_start();
                    $_SESSION["usuario"] = $usuario;

                    // Redirigir al usuario dependiendo de su rol
                    if ($usuario["es_admin"]) {
                        header("Location: ./index.php");
                    } else {
                        header("Location: ./user.php");
                    }
                    exit();
                } else {
                    // Si la contraseña es incorrecta, mostrar un mensaje de error
                    echo "<p class='error'>Credenciales incorrectas</p>";
                }
            } else {
                // Si no se encuentra ningún usuario con ese correo electrónico, mostrar un mensaje de error
                echo "<p class='error'>No se encontró ningún usuario con ese correo electrónico</p>";
            }
          }
      ?>
    </div>
  </div>
</body>
</html>