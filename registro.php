<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Usuario</title>
    <link rel="stylesheet" href="./estilos/registro.css">
</head>

<body>
    <div class="background"></div>
    <div class="card">
        <h2>Registro nuevos usuarios</h2>
        <form class="form" action="./procesar_registro.php" method="post" onsubmit="return validarFormulario()">
            <input type="text" placeholder="Nombre" name="nombre" id="nombre" required>
            <input type="text" placeholder="Apellidos" name="apellidos" id="apellidos" required>
            <input type="email" placeholder="Correo electrónico" name="correo" id="correo" required>
            <input type="password" placeholder="Contraseña" name="password" id="password" required>
            <input type="password" placeholder="Confirmar Contraseña" name="confirm_password" id="confirm_password" required>
            <div class="gender-date-container">
                <select name="genero" id="genero" required>
                    <option value="">Seleccionar género</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                    <option value="X">Prefiero no especificar</option>
                </select>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>
            </div>
            <button type="submit">Registrarse</button>
            <button type="button" onclick="window.location.href='./login.php'" class="return-button">Regresar al inicio de sesión</button>
        </form>
    </div>
    
</body>
</html>
