<?php
include_once __DIR__ . '/../../../Datos/Models/producto.php';
session_start();

$solicitudSeleccionada = $_SESSION['solicitudSeleccionada'] ?? array();
$cantidades = $_SESSION['cantidades'] ?? array();

// Obtén la fecha y hora actual
$fechaHoraActual = date('Y-m-d H:i:s');
$numero_orden = $_GET['numero_orden'];

if ($solicitudSeleccionada == null) {
    // Aquí puedes mostrar los detalles
    echo "No se encontró la solicituddddeeeeeeeessssssssssssss.";
    header("Location: ../../vista/ModuloVentas/formRegistroDeVenta.php?numero_orden=$numero_orden");
} else {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Formulario de Búsqueda</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="../../assets/css/formRegistroDeVenta.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="../../controlador/ModuloVentas/RegistrarVentasController.php" method="post">
        <button style="position: absolute; top: 10px; right: 10px;" type="submit" name="buttonSubPrivilegio" value="RegresarMventa">Regresar</button>
</form>
<!-- Tabla de Productos -->
<form action="../../controlador/ModuloVentas/RegistrarVentasController.php" method="post">
<table>
    <h2>Boleta</h2>
    <thead>
        <tr>
        <td colspan="7"></td> <!-- Celdas vacías para ocupar espacio -->
        <td style="text-align: right;" id="fechaHora">Fecha y Hora: <?php echo $fechaHoraActual; ?></td>
        </tr>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Costo</th>
            <th>Acción</th>
        </tr>
    </thead>
    <?php
    // Inicializar la suma total
    $totalCosto = 0;
    ?>
    <tbody>
        <?php foreach ($solicitudSeleccionada['productos'] as $producto) { ?>
            <tr>
                <td><?php echo $producto->getIdeproducto(); ?></td>
                <td><?php echo $producto->getProducto(); ?></td>
                <td><?php echo $producto->getCategoria(); ?></td>
                <td><?php echo $producto->getMarca(); ?></td>
                <td><?php echo 's/ ' . $producto->getPrecio(); ?></td>
                <td style="text-align: center;"><?php echo $solicitudSeleccionada['cantidades'][$producto->getIdeproducto()]; ?></td>
                <?php
                // Calcular el costo por producto
                $costoProducto = $producto->getPrecio() * $solicitudSeleccionada['cantidades'][$producto->getIdeproducto()];
                // Sumar al total
                $totalCosto += $costoProducto;
                ?>
                <td style="text-align: right;"><?php echo 's/ ' . $costoProducto; ?></td>
                <td style="text-align: center;">
                    <form action="../../controlador/ModuloVentas/RegistrarSolicitudPedidoController.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $producto->getIdeproducto(); ?>">
                        <button class="BLogin" type="submit" name="buttonSubPrivilegio" value="Quitar Producto">Quitar</button>
                    </form>
                </td>
            </tr>
        <?php 
        
        
        } ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <th>OP. EXONERADAS</th>
            <td style="text-align: right;"><?php echo 's/ ' .  0; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <th>OP. GRAVADAS</th>
            <td style="text-align: right;"><?php echo 's/ ' . (number_format($totalCosto*82/100, 2, '.', '')); ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <th>IGV</th>
            <td style="text-align: right;"><?php echo 's/ ' . (number_format($totalCosto*18/100, 2, '.', '')); ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <th>TOTAL</th>
            <td style="text-align: right;"><?php echo 's/ ' . $totalCosto; ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <th>EFECTIVO</th>
            <td><input style="text-align: right;" type="number" name="montoRecibido" id="montoRecibido" placeholder="Ingrese monto recibido"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <th>VUELTO</th>
            <td><input style="text-align: right;" type="number" name="vuelto" id="vuelto" readonly></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <!-- Campos ocultos para op. exonerada, op. gravada, igv y total -->
            <input type="hidden" name="opExonerada" value="<?php echo 0; ?>">
            <input type="hidden" name="opGravadas" value="<?php echo (number_format($totalCosto * 82 / 100, 2, '.', '')); ?>">
            <input type="hidden" name="igv" value="<?php echo (number_format($totalCosto * 18 / 100, 2, '.', '')); ?>">
            <input type="hidden" name="total" value="<?php echo $totalCosto; ?>">

            <!-- Campos para efectivo, vuelto y fechaventa -->
            <input type="hidden" name="efectivo" id="efectivo">
            <input type="hidden" name="vuelto" id="vuelto">
            <input type="hidden" name="fechaventa" id="fechaventa">  
            <!-- Campo oculto para enviar el número de orden -->
            <input type="hidden" name="numero_orden" value="<?php echo htmlspecialchars($numero_orden); ?>">          
            <td><button class="BLogin" name="buttonSubPrivilegio" value="Registrar venta" type="submit">Registrar venta</button></td>
        </tr>
    </tbody>
</table>
</form>
</body>
<?php
}
?>
<!-- Script para manejar el cálculo del vuelto -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Obtener los elementos del DOM una vez que el contenido esté cargado
    var montoRecibidoInput = document.getElementById('montoRecibido');
    var vueltoInput = document.getElementById('vuelto');
    var totalCosto = <?php echo $totalCosto; ?>; // Obtener el totalCosto desde PHP

    // Agregar un evento para calcular el vuelto cuando cambia el monto recibido
    montoRecibidoInput.addEventListener('input', function() {
        // Validar que el monto recibido sea un número
        var montoRecibido = parseFloat(this.value);

        // Validar que el monto recibido sea mayor o igual al total de la venta
        if (!isNaN(montoRecibido) && montoRecibido >= totalCosto) {
            // Calcular el vuelto
            var vuelto = montoRecibido - totalCosto;
            vueltoInput.value = vuelto.toFixed(2);

            // Actualizar los campos ocultos de efectivo y vuelto
            document.getElementById('efectivo').value = montoRecibido;
            document.getElementById('vuelto').value = vuelto.toFixed(2);
        } else {
            // Mostrar un mensaje si el monto recibido es insuficiente
            vueltoInput.value = ''; // Limpiar el campo de vuelto
        }
    });
});
</script>

<!-- Script para actualizar la fecha y hora cada segundo -->
<script>
// Función para actualizar la fecha y hora cada segundo
function actualizarFechaHora() {
    // Obtén el elemento de la fecha y hora
    var fechaHoraElemento = document.getElementById('fechaHora');

    // Obtén la fecha y hora actual
    var fechaHoraActual = new Date();

    // Formatea la fecha y hora (puedes ajustar el formato según tus preferencias)
    var formatoFechaHora = fechaHoraActual.getFullYear() + '-' +
        ('0' + (fechaHoraActual.getMonth() + 1)).slice(-2) + '-' +
        ('0' + fechaHoraActual.getDate()).slice(-2) + ' ' +
        ('0' + fechaHoraActual.getHours()).slice(-2) + ':' +
        ('0' + fechaHoraActual.getMinutes()).slice(-2) + ':' +
        ('0' + fechaHoraActual.getSeconds()).slice(-2);

    // Asigna el nuevo contenido a la celda
    fechaHoraElemento.textContent = 'Fecha y Hora: ' + formatoFechaHora;

    // Actualiza el campo oculto de fechaventa
    document.getElementById('fechaventa').value = formatoFechaHora;
}

// Llama a la función inicialmente para establecer la fecha y hora actual
actualizarFechaHora();

// Establece la actualización cada segundo
setInterval(actualizarFechaHora, 1000);
</script>