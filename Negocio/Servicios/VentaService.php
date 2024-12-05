<?php
// VentaService.php
class VentaService {
    // Método para registrar una venta
    public function registrarVenta($total, $opExoneradas, $opGravadas, $igv, $fechaVenta) {
        return VentaDAO::registrarVenta($total, $opExoneradas, $opGravadas, $igv, $fechaVenta);
    }

    // Método para registrar el detalle de la venta
    public function registrarDetalleVenta($idventa, $idusuario) {
        VentaDAO::registrarDetalleVenta($idventa, $idusuario);
    }

    // Método para cancelar una orden
    public function cancelarOrden($numeroOrdenEliminar) {
        // Obtener la lista actual de solicitudes de la sesión
        $solicitudes = $_SESSION['solicitudes'] ?? [];
        
        // Filtrar las solicitudes para excluir la que se va a cancelar
        $solicitudes = array_filter($solicitudes, function ($orden) use ($numeroOrdenEliminar) {
            return $orden['numero_orden'] !== $numeroOrdenEliminar;
        });
        
        // Guardar la lista actualizada en la sesión
        $_SESSION['solicitudes'] = $solicitudes;
    }

    // Método para buscar productos
    public function buscarProductos($busqueda) {
        return ProductoDAO::buscarProductos($busqueda);
    }

    // Método para mostrar detalles de una solicitud
    public function mostrarDetallesSolicitud($numeroOrden) {
        // Limpiar y obtener la lista actual de solicitudes
        $solicitudes = array_map(function ($solicitud) {
            $solicitud['numero_orden'] = trim($solicitud['numero_orden']);
            return $solicitud;
        }, $_SESSION['solicitudes'] ?? []);
        
        // Filtrar la solicitud correspondiente al número de orden
        $solicitudesSeleccionadas = array_filter($solicitudes, function ($orden) use ($numeroOrden) {
            return (string) $orden['numero_orden'] === (string) $numeroOrden;
        });
        
        return $solicitudesSeleccionadas;
    }
}
