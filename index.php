<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manejador de Archivos</title>
  <link rel="stylesheet" href="./estilos/style.css">
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.querySelector(".boton-listar").addEventListener("click", function() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "listar_archivos.php", true);
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            document.querySelector(".lista-archivos").innerHTML = xhr.responseText;
            // Agregar evento de clic a los enlaces
            var enlaces = document.querySelectorAll(".lista-archivos a");
            enlaces.forEach(function(enlace) {
              enlace.addEventListener("click", function(event) {
                event.preventDefault();
                var urlArchivo = enlace.getAttribute("href");
                window.open(urlArchivo, "_blank");
              });
            });
            // Agregar evento de clic a los botones de borrar
            var botonesBorrar = document.querySelectorAll(".boton-borrar");
            botonesBorrar.forEach(function(boton) {
              boton.addEventListener("click", function() {
                var nombreArchivo = boton.getAttribute("data-nombre"); // Obtiene el nombre del archivo del atributo data-nombre
                var confirmacion = confirm("¿Está seguro que desea borrar " + nombreArchivo + "?");
                if (confirmacion) {
                  var fila = boton.closest("tr");
                  var xhrBorrar = new XMLHttpRequest();
                  xhrBorrar.open("GET", "borrar_archivo.php?nombre=" + encodeURIComponent(nombreArchivo), true);
                  xhrBorrar.onreadystatechange = function() {
                    if (xhrBorrar.readyState === 4 && xhrBorrar.status === 200) {
                      fila.remove(); // Eliminar la fila del archivo de la tabla
                      alert("El archivo ha sido borrado exitosamente.");
                    }
                  };
                  xhrBorrar.send();
                }
              });
            });
          }
        };
        xhr.send();
      });
    });
  </script>

</head>

<body>
  <div class="contenedor-transparente">
    <h2>¡Bienvenido!</h2>
    <div class="botones-container">
      <button class="boton-listar">Listar archivos</button>
      <button class="boton-subir">Subir archivos</button>
    </div>
    <div class="lista-archivos"></div>

    <div id="popup-subir-archivo" class="popup">
      <div class="popup-contenido">
        <span class="cerrar" onclick="cerrarPopup()">×</span>
        <h2>Subir Archivo</h2>
        <form id="form-subir-archivo" enctype="multipart/form-data">
          <label for="nombre-archivo">Nombre del archivo (opcional):</label>
          <input type="text" id="nombre-archivo" name="nombre-archivo">
          <label for="archivo">Seleccione el archivo:</label>
          <input type="file" id="archivo" name="archivo">
          <input type="submit" value="Subir archivo">
        </form>
      </div>
    </div>
    <script src="./js/subir_archivo.js" defer></script>
    
    <button class="boton-salir" onclick="location.href='./login.php'">Cerrar sesión</button>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>