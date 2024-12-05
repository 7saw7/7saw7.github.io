<?php
include_once __DIR__ . '/../../../Datos/DAO/ProductoDAO.php';
include_once __DIR__ . '/../../../Negocio/Servicios/ProductoService.php';
include_once __DIR__ . '/../../../Negocio/Servicios/SessionService.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $buttonName = $_POST['buttonPrivilegio'];
    $productoService = new ProductoService();
    $sessionService = new SessionService();

    switch ($buttonName) {
        case 'Gestionar Inventario de Almacen':
            header("Location: ../../vista/ModuloInventario/formGestionarInventarioAlmacen.php");
            exit();

        case 'Registrar Llegada de Productos Farmacéuticos':
            $productos = $productoService->obtenerProductos();
            $sessionService->guardarProductosEnSesion($productos);
            header("Location: ../../vista/ModuloInventario/formRegistrarLlegadaProducFarma.php");
            exit();

        case 'Registrar Solicitud de Pedido':
            $productos = $productoService->obtenerProductos();
            $sessionService->guardarProductosEnSesion($productos);
            header("Location: ../../vista/ModuloVentas/formRegistrarSolicitudPedido.php");
            exit();

        case 'Registrar Ventas':
            header("Location: ../../vista/ModuloVentas/formRegistrarVentas.php");
            exit();

        case 'Visualizar Reportes de Ventas':
            echo "Se presionó el botón con label 2";
            exit();

        case 'Regresar':
            $sessionService->destruirSesion();
            header("Location: ../../vista/ModuloSeguridad/formAutenticarUsuario.php");
            exit();
    }
}