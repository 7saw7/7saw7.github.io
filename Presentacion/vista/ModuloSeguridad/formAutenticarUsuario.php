<?php
include_once __DIR__ . '/../../HeaderFooterSingleton.php';

// Obtener la instancia del Singleton
$singleton = HeaderFooterSingleton::obtenerInstancia();

// Obtener la cabecera
$header = $singleton->obtenerHeader();

// Obtener el pie
$footer = $singleton->obtenerFooter();

session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>AutenticarUsuario</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/styles.css">
    <script src="../../assets/js/validacion.js"></script>
</head>
<body>
    <?php echo $header; ?>

    <!-- Contenedor para el mensaje emergente -->
    <div id="errorMessagePopup" class="error-popup" style="display:none;">
        <span id="errorMessageText"></span>
    </div>

    <form name="formAutenticarUsuario" action="../../controlador/ModuloSeguridad/AutenticarUsuarioController.php" method="post">
        <fieldset class="Principal">
            <h3 class="ILogin"><strong>Autenticar Usuario</strong></h3>
            <table>
                <tbody>
                    <tr>
                        <th><img src="../../assets/Imagen/Persona.png"></th>
                        <th><input 
                            class="Tlogin" 
                            name="txtLogin" 
                            type="text" 
                            placeholder="Usuario" 
                            required 
                            minlength="3" 
                            maxlength="15"
                            pattern="[A-Za-z0-9]+" 
                            title="El usuario solo puede contener letras y números">
                    </th>
                    </tr>
                    <tr>
                        <th><img src="../../assets/Imagen/Bloqueo.png"></th>
                        <th><input 
                            class="Tlogin" 
                            name="txtPassword" 
                            type="password" 
                            placeholder="Contraseña" 
                            required 
                            minlength="8" 
                            maxlength="20" 
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas y números.">
                    </th>
                    </tr>
                </tbody>
            </table>
            <input class="BLogin" name="btnLogin" type="submit" value="Aceptar">
            <a href="../../controlador/ModuloSeguridad/RecuperarClave/RecuperarClaveController.php" class="RecuperarContraseña">Recuperar contraseña</a>
        </fieldset>
    </form>

    <?php echo $footer; ?>
</body>
</html>
