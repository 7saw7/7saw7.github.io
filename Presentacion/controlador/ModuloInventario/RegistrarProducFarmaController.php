<?php
include_once __DIR__ . '/../../../Datos/DAO/ProductoDAO.php';
include_once __DIR__ . '/../../../Datos/Models/producto.php';
include_once __DIR__ . '/../../../Negocio/Servicios/ProductoService.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productoService = new ProductoService();
    $buttonName = $_POST['buttonSubPrivilegio'];
    switch ($buttonName) {        
        case 'RegistrarProductos':
            header("Location: ../../vista/ModuloInventario/registrarProductos.php");
            exit();

        case 'registrar Producto':
            $producto = $_POST['txt_producto'];
            $descripcion = $_POST['txt_descripcion'];
            $precio = $_POST['txt_precio'];
            $cantidad = 0;
            $categoria = $_POST['txt_categoria'];
            $marca = $_POST['txt_marca'];
            $estado = $_POST['txt_estado'];
            $productoService->registrarProducto($producto, $descripcion, $precio, $cantidad, $categoria, $marca, $estado);
            $_SESSION['msg'] = "Exito: se guardó el registro";
            header("Location: ../../vista/ModuloInventario/registrarProductos.php");
            exit();
 
            
        case 'Modificar Productos':
            $productoService->obtenerProductos();
            session_start();
            $_SESSION['productos'] = $productos;
            header("Location: ../../vista/ModuloInventario/formRegistroProducto.php");
            exit();
        
        case 'Registrar Producto':
            $idProducto = $_POST['id'];
            $producto = ProductoDAO::buscarPorId($idProducto);
            session_start();
            $_SESSION['producto'] = $producto;
            header("Location: ../../vista/ModuloInventario/formRegistroProducto.php");
            exit();

        case 'Grabar Producto':
            $ideproducto = (int)$_POST['ideproducto'];
            $nombre = $_POST['producto'];
            $descripcion = $_POST['descripcion'];
            $precio = (double)$_POST['precio'];
            $cantidad = (int)$_POST['cantidadStock'];
            $Acantidad = (int)$_POST['AcantidadStock'];
            $categoria = $_POST['categoria'];
            $marca = $_POST['marca'];
            $estado = $_POST['estado'];
        
            // Registrar objeto producto en la base de datos
            $producto = new Producto();
            $producto->setIdeproducto($ideproducto);
            $producto->setProducto($nombre);
            $producto->setDescripcion($descripcion);
            $producto->setPrecio($precio);
            $producto->setCantidadStock($cantidad+$Acantidad);
            $producto->setCategoria($categoria);
            $producto->setMarca($marca);
            $producto->setEstado($estado);
        
            $productoService->modificarProducto($producto);
        
            // Redireccionar y pasar datos
            session_start();
            $_SESSION['productos'] = ProductoDAO::obtenerProductos();
            header("Location: ../../vista/ModuloInventario/formRegistrarLlegadaProducFarma.php");
            exit();

        case 'Buscar Producto':
            $busqueda = $_POST['busqueda'];
            $productoService->buscarProductos($busqueda);
            session_start();
            $_SESSION['productos'] = $productos;
            header("Location: ../../vista/ModuloInventario/formRegistrarLlegadaProducFarma.php");
            exit();

        case 'Actualizar Lista':
            $productoService->obtenerProductos();
            $_SESSION['productos'] = $productos;
            header("Location: ../../vista/ModuloInventario/formRegistrarLlegadaProducFarma.php");
            exit();

        case 'Regresar':
            header("Location: ../../vista/ModuloSeguridad/BienvenidaSistema.php");
            exit();

        case 'Regresar Modificar':
            $productoService->obtenerProductos();
            $_SESSION['productos'] = $productos;
            header("Location: ../../vista/ModuloInventario/formRegistrarLlegadaProducFarma.php");
            exit();

    }

}