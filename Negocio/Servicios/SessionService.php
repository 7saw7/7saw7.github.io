<?php
session_start();
class SessionService {
    
    public function guardarProductosEnSesion($productos) {
        $_SESSION['productos'] = $productos;
    }
    public function guardarProductoEnSesion($producto) {
        $_SESSION['producto'] = $producto;
    }
    public function destruirSesion() {
        session_unset();
        session_destroy();
    }
}