<?php
include_once __DIR__ . '/../../HeaderFooterSingleton.php';
include_once __DIR__ . '/../../../Datos/Models/producto.php';

$singleton = HeaderFooterSingleton::obtenerInstancia();
$header = $singleton->obtenerHeader();
$footer = $singleton->obtenerFooter();

session_start();
$solicitudes = $_SESSION['solicitudes'] ?? array(); // Obtener la lista de solicitudes de la sesión
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registrar Venta</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="../../assets/css/formRegistrarVentas.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../assets/css/headerfootersingleton.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php echo $header; ?>
    <form action="../../controlador/ModuloVentas/RegistrarVentasController.php" method="post">
        <button style="position: absolute; top: 10px; right: 10px;" type="submit" name="buttonSubPrivilegio" value="RegresarMventas">Regresar</button>
    </form>
    <?php echo $footer; ?>
    <!-- Tabla de Solicitudes -->
    <table>
    <h2>Lista de Solicitudes de Pedido</h2>
    <thead>
        <tr>
            <th>Número de Orden</th>
            <th colspan="2">Acción</th>
        </tr>
    </thead>
    <tbody id="solicitudesTabla">
        <?php foreach ($solicitudes as $orden) { ?>
            <tr>
                <td><?php echo $orden['numero_orden']; ?></td>
                <td>
                    <form action="../../controlador/ModuloVentas/RegistrarVentasController.php" method="post">
                        <input type="hidden" name="numero_orden" value='<?php echo json_encode($orden['numero_orden']); ?>'>
                        <button class="BLogin" type="submit" name="buttonSubPrivilegio" value="Mostrar Detalles">Mostrar Detalles</button>
                    </form>
                </td>
                <td>
                    <form action="../../controlador/ModuloVentas/RegistrarVentasController.php" method="post">
                        <input type="hidden" name="numero_orden" value="<?php echo $orden['numero_orden']; ?>">
                        <button class="BLogin" type="submit" name="buttonSubPrivilegio" value="Cancelar Orden">Cancelar</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
    <script>
        $(document).ready(function() {
            // Función para actualizar la tabla de solicitudes de pedido
            function actualizarTablaSolicitudes() {
                $.ajax({
                    url: 'actualizarTablaSolicitudes.php', // Archivo PHP para obtener los datos actualizados de la tabla
                    type: 'GET',
                    dataType: 'html',
                    success: function(response) {
                        $('#solicitudesTabla').html(response); // Actualizar solo el contenido de la tabla
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                    }
                });
            }

            // Actualizar la tabla cada segundo
            setInterval(actualizarTablaSolicitudes, 1000); // 1000 milisegundos = 1 segundo
        });
    </script>
</body>
</html>
