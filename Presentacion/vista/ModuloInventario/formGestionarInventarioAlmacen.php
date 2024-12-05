<?php
include_once __DIR__ . '/../../HeaderFooterSingleton.php';
$singleton = HeaderFooterSingleton::obtenerInstancia();
$header = $singleton->obtenerHeader();
$footer = $singleton->obtenerFooter();
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Formulario</title>
    <link href="../../assets/css/GestionarInventarioAlmacen.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php echo $header; ?> 
    <table class="table"> 
    <tr>
    <form method="POST" action="../../controlador/ModuloInventario/GestionarInventarioAlmacenController.php">
    <td class="tde">
        <p><img src="../../assets/Imagen/registrarProductos.png" width="200" height="200"></p>
        <input class="BLogin" type="submit" value="Registrar Productos" name="buttonSubPrivilegio">
    </td>
    <td class="tde">
        <p><img src="../../assets/Imagen/modificarProductos.png" width="200" height="200"></p>
        <input class="BLogin" type="submit" value="Modificar Productos" name="buttonSubPrivilegio">
    </td>
    </form>
    </tr>
    </table>

    <!-- Botón "Regresar" fuera de la tabla -->
    <form action="../../controlador/ModuloInventario/GestionarInventarioAlmacenController.php" method="post">
        <button style="position: absolute; top: 10px; right: 10px;" type="submit" name="buttonSubPrivilegio" value="Regresar Bienvenida">Regresar</button>
    </form>

    <?php echo $footer; ?>

</body>
</html>
