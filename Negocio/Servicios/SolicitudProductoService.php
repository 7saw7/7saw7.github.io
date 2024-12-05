<?php
// SolicitudProductoService.php
class SolicitudProductoService {
    public function registrarSolicitud($listaProductos, $cantidad) {
        $numeroOrden = uniqid('orden_');
        $solicitudes = $_SESSION['solicitudes'] ?? [];
        $solicitudes[] = ['numero_orden' => $numeroOrden, 'productos' => $listaProductos, 'cantidades' => $cantidad];
        $_SESSION['solicitudes'] = $solicitudes;
    }
}
