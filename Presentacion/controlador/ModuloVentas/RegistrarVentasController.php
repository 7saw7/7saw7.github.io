<?php
// En tu controlador
include_once __DIR__ . '/../../../Datos/DAO/VentaDAO.php';
include_once __DIR__ . '/../../../Datos/Models/producto.php';
include_once __DIR__ . '/../../../Negocio/Servicios/VentaService.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $buttonName = $_POST['buttonSubPrivilegio'];
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Crear una instancia del servicio de ventas
    $ventaService = new VentaService();

    switch ($buttonName) {
        case 'Registrar venta':
            $total = isset($_POST['total']) ? floatval($_POST['total']) : 0;
            $opExoneradas = isset($_POST['opExoneradas']) ? floatval($_POST['opExoneradas']) : 0;
            $opGravadas = isset($_POST['opGravadas']) ? floatval($_POST['opGravadas']) : 0;
            $igv = isset($_POST['igv']) ? floatval($_POST['igv']) : 0;
            $fechaVenta = isset($_POST['fechaventa']) ? $_POST['fechaventa'] : date('Y-m-d H:i:s');

            // Usar el servicio para registrar la venta y el detalle de la venta
            $idventa = $ventaService->registrarVenta($total, $opExoneradas, $opGravadas, $igv, $fechaVenta);
            $idusuario = $_SESSION['idusuario'];
            $ventaService->registrarDetalleVenta($idventa, $idusuario);

            $numeroOrdenEliminar = $_POST['numero_orden'] ?? null;

            // Usar el servicio para cancelar la orden
            $ventaService->cancelarOrden($numeroOrdenEliminar);
            
            header("Location: ../../vista/ModuloVentas/formRegistrarVentas.php");
            break;

        case 'Buscar Producto':
            $busqueda = $_POST['busqueda'];
            
            // Usar el servicio para buscar productos
            $productos = $ventaService->buscarProductos($busqueda);
            $_SESSION['productos'] = $productos;

            header("Location: ../../vista/ModuloVentas/formRegistrarSolicitudPedido.php");
            break;

        case 'Cancelar Orden':
            $numeroOrdenCancelar = $_POST['numero_orden'] ?? null;

            // Usar el servicio para cancelar la orden
            $ventaService->cancelarOrden($numeroOrdenCancelar);

            header("Location: ../../vista/ModuloVentas/formRegistrarVentas.php");
            break;

        case 'Mostrar Detalles':
            $numero_orden = trim($_POST['numero_orden'], " \t\n\r\0\x0B'\"");

            // Usar el servicio para obtener los detalles de la solicitud
            $solicitudesSeleccionadas = $ventaService->mostrarDetallesSolicitud($numero_orden);

            // Verificar si la solicitud fue encontrada
            if (empty($solicitudesSeleccionadas)) {
                echo "No se encontró la solicitud.<br>";
                exit();
            }

            // Almacena la solicitud filtrada en la sesión
            $_SESSION['solicitudSeleccionada'] = reset($solicitudesSeleccionadas);
            $numero_orden_url = urlencode($numero_orden);
            
            header("Location: ../../vista/ModuloVentas/formRegistroDeVenta.php?numero_orden=$numero_orden_url");
            break;

        case 'RegresarMventas':
            header("Location: ../../vista/ModuloSeguridad/BienvenidaSistema.php");
            break;

        case 'RegresarMventa':
            header("Location: ../../vista/ModuloVentas/formRegistrarVentas.php");
            break;
    }
}
