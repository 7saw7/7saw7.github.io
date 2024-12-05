<?php
include_once __DIR__ . '/../../HeaderFooterSingleton.php';

// Obtener la instancia del Singleton
$singleton = HeaderFooterSingleton::obtenerInstancia();

// Obtener la cabecera
$header = $singleton->obtenerHeader();

// Obtener el pie
$footer = $singleton->obtenerFooter();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/styles.css">
</head>
<body>
    <?php echo $header; ?>
    <div class="ContenedorAutenticar">
        <button class="BVolver" onclick="goBack()">Volver</button>
    </div>
    <form method="POST" action="recuperarContra">
    <fieldset class="Principal">
    <h3 class="ILogin"><strong>Recuperar Clave</strong></h3>
    <table class="tbclave">
    <tr>
        <th><label for="txtDNI">DNI:</label></th>
    </tr>
    <tr>
        <th><img src="../../assets/Imagen/dni.png"></th>
        <th><input type="text" id="txtDNI" name="txtdni" required></th>
    </table>
    <input class="BConfirmar" type="submit" value="Confirmar" name="btnConfirmarDNI">
    </fieldset>
    </form>
    <?php echo $footer; ?>
</body>
</html>