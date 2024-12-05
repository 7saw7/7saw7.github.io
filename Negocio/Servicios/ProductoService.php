<?php
// ProductoService.php
class ProductoService {
    public function registrarProductoEnSesion($idProducto) {
        $producto = ProductoDAO::buscarPorId($idProducto);
        $productosSeleccionados = $_SESSION['productosSeleccionados'] ?? [];
        $productosSeleccionados[] = $producto;
        $_SESSION['productosSeleccionados'] = $productosSeleccionados;
    }
    public function registrarProducto($producto, $descripcion, $precio, $cantidad, $categoria, $marca, $estado) {
        ProductoDAO::insertarProducto($producto, $descripcion, $precio, $cantidad, $categoria, $marca, $estado);
    }
    public function modificarProducto($producto) {
        ProductoDAO::modificar($producto);
    }
    public function quitarProductoDeSesion($idProducto) {
        $productosSeleccionados = $_SESSION['productosSeleccionados'] ?? [];
        $productosSeleccionados = array_filter($productosSeleccionados, function ($producto) use ($idProducto) {
            return $producto->getIdeproducto() != $idProducto;
        });
        $_SESSION['productosSeleccionados'] = $productosSeleccionados;
    }

    public function buscarProductos($busqueda) {
        return ProductoDAO::buscarProductos($busqueda);
    }

    public function actualizarListaProductos() {
        return ProductoDAO::obtenerProductos();
    }
    public function obtenerProductos() {
        return ProductoDAO::obtenerProductos();
    }
    public function buscarPorId($idProducto) {
        return ProductoDAO::buscarPorId($idProducto);
    }
}
