<?php
include_once __DIR__ . '/../../../Datos/DAO/ProductoDAO.php';
include_once __DIR__ . '/../../../Negocio/Servicios/ProductoService.php';
include_once __DIR__ . '/../../../Negocio/Servicios/SolicitudProductoService.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $buttonName = $_POST['buttonSubPrivilegio'];
    $productoService = new ProductoService();
    $solicitudProductoService = new SolicitudProductoService();

    switch ($buttonName) {
        case 'Registrar Producto':
            $idProducto = $_POST['id'];
            $productoService->registrarProductoEnSesion($idProducto);
            header("Location: ../../vista/ModuloVentas/formRegistrarSolicitudPedido.php");
            exit();

        case 'Buscar Producto':
            $busqueda = $_POST['busqueda'];
            $productos = $productoService->buscarProductos($busqueda);
            $_SESSION['productos'] = $productos;
            header("Location: ../../vista/ModuloVentas/formRegistrarSolicitudPedido.php");
            exit();

        case 'Quitar Producto':
            $idProducto = $_POST['id'];
            $productoService->quitarProductoDeSesion($idProducto);
            header("Location: ../../vista/ModuloVentas/formRegistrarSolicitudPedido.php");
            exit();

        case 'Registrar Solicitud Producto':
            $lista = $_SESSION['lista'];
            $cantidad = $_POST['cantidad'];
            $solicitudProductoService->registrarSolicitud($lista, $cantidad);
            $_SESSION['productosSeleccionados'] = [];
            header("Location: ../../vista/ModuloVentas/formRegistrarSolicitudPedido.php");
            exit();

        case 'Actualizar Lista':
            $productos = $productoService->actualizarListaProductos();
            $_SESSION['productos'] = $productos;
            header("Location: ../../vista/ModuloVentas/formRegistrarSolicitudPedido.php");
            exit();

        case 'Regresar Bienvenida':
            header("Location: ../../vista/ModuloSeguridad/BienvenidaSistema.php");
            exit();
    }
}
