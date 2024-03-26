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
      </form>
      <?php
        require "./login-helper.php"; // Invoca la autenticación 

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = $_POST['nombre'];
            $password = $_POST['password'];

            $resultado = autentificar($usuario, $password);

            if ($resultado) {
                session_start();
                $_SESSION["usuario"] = $resultado; 

                // Redirigir al usuario dependiendo de su rol
                if ($resultado["esAdmin"]) {
                    header("Location: ./index.php"); 
                } else {
                    header("Location: ./user.php"); 
                }

                exit(); 
            } else {
                echo "<p class='error'>Usuario no autenticado</p>";
                exit();
            }
        }
      ?>
    </div>
  </div>
</body>
</html>