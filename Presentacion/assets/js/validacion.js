// Función para mostrar el mensaje emergente
function showError(message) {
    var errorPopup = document.getElementById("errorMessagePopup");
    var errorText = document.getElementById("errorMessageText");
    
    // Establecer el mensaje de error
    errorText.innerText = message;

    // Mostrar el popup
    errorPopup.style.display = 'block';

    // Ocultar el popup después de 2 segundos
    setTimeout(function() {
        errorPopup.style.display = 'none';

        // Limpiar el mensaje de error de la URL
        clearErrorFromURL();
    }, 2000);  // 2000 milisegundos = 2 segundos
}

// Función para cargar el mensaje de error desde la URL
function loadErrorMessage() {
    var errorMessage = new URLSearchParams(window.location.search).get('msg');
    if (errorMessage) {
        // Mostrar el mensaje de error
        showError(decodeURIComponent(errorMessage));
    }
}

// Función para limpiar el mensaje de error de la URL sin recargar la página
function clearErrorFromURL() {
    var url = new URL(window.location.href);
    url.searchParams.delete('msg'); // Eliminar el parámetro 'msg'
    window.history.replaceState({}, document.title, url); // Actualizar la URL
}

// Ejecutar la carga del mensaje al cargar la página
window.onload = loadErrorMessage;
