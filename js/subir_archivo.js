// Función para mostrar la ventana emergente
function mostrarPopup() {
    document.getElementById("popup-subir-archivo").style.display = "block";
}

// Función para cerrar la ventana emergente
function cerrarPopup() {
    document.getElementById("popup-subir-archivo").style.display = "none";
}

// Asigna la función mostrarPopup al botón "Subir archivo"
document.querySelector(".boton-subir").addEventListener("click", function() {
    mostrarPopup();
});


$(document).ready(function() {
    // Mostrar el formulario de subida al hacer clic en el botón "Subir archivos"
    $(".boton-subir").click(function() {
        $("#formulario-subida").show();
        mostrarPopup(); // Llama a la función mostrarPopup para mostrar la ventana emergente
    });

    // Manejar la subida de archivos mediante AJAX
    $("#form-subir-archivo").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'subir_archivo.php',
            method: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                // Mostrar un mensaje de carga
                console.log('Subiendo archivo...');
            },
            success: function(data) {
                // Procesar la respuesta del servidor
                try {
                    var response = JSON.parse(data);
                    if (response.success) {
                        // Mostrar mensaje de éxito
                        alert(response.message);
                        console.log('Archivo subido exitosamente.');
                        // Agregar el nuevo archivo a la lista de archivos
                        if (response.nombreArchivo) {
                            var nuevoArchivoHTML = '<a href="archivo.php?nombre=' + encodeURIComponent(response.nombreArchivo) + '" target="_blank">' + response.nombreArchivo + '</a>';
                            $(".lista-archivos").append("<div>" + nuevoArchivoHTML + "</div>");
                        }
                    } else {
                        // Mostrar mensaje de error
                        alert(response.message);
                    }
                } catch (error) {
                    console.error('Error al procesar la respuesta del servidor:', error);
                    // Mostrar un mensaje de error genérico
                    alert('Error al procesar la respuesta del servidor.');
                }
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                console.error('Error en la solicitud AJAX:', status, error);
                alert('Error en la solicitud AJAX.');
            }
        });
    });
});
