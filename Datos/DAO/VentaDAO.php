<?php
include_once __DIR__ . '/../conexion.php';
include_once __DIR__ . '/../Models/venta.php';
include_once __DIR__ . '/../Models/producto.php';
session_start();

class VentaDAO {
    public static function registrarVenta($total, $opExoneradas, $opGravadas, $igv, $fechaVenta) {
        // SQL para la inserción del producto
        $sql = "INSERT INTO VENTA (opExoneradas, opGravadas, igv, total, fechaventa) VALUES (?, ?, ?, ?, ?)";
    
        // Establecer la conexión a la base de datos
        $cn = Conexion::abrir(); // Asumiendo que hay una clase llamada Conexion con un método estático abrir()
    
        try {
            // Preparar la instrucción SQL
            $ps = $cn->prepare($sql);
            
            // Asignar valores a los parámetros de la consulta
            $ps->bindParam(1, $opExoneradas);
            $ps->bindParam(2, $opGravadas);
            $ps->bindParam(3, $igv);
            $ps->bindParam(4, $total);
            $ps->bindParam(5, $fechaVenta);
    
            // Ejecutar la inserción del producto
            $ps->execute();
    
            // Obtener el ID de la última inserción
            $idVenta = $cn->lastInsertId();
    
        } catch (PDOException $ex) {
            // Manejar excepciones aquí
            // Logger::log($ex->getMessage()); // Si tienes un sistema de registro de errores
            echo "Error en la inserción del producto: " . $ex->getMessage();
            return null; // Otra opción es lanzar la excepción o devolver algún valor que indique un error
        } finally {
            Conexion::cerrar($cn); // Cerrar la conexión después de usarla
        }
    
      // Devolver el ID de la venta
            return $idVenta;
    }  

public static function registrarDetalleVenta($idventa, $idusuario) {

    $solicitudSeleccionada = $_SESSION['solicitudSeleccionada'] ?? array();

    foreach ($solicitudSeleccionada['productos'] as $producto) { 

    // SQL para la inserción del producto
    $sql = "INSERT INTO DETALLEVENTA (idventa , idusuario , idproducto , cantidad) VALUES (?, ?, ?, ?)";

    // Establecer la conexión a la base de datos
    $cn = Conexion::abrir(); // Asumiendo que hay una clase llamada Conexion con un método estático abrir()
    $pro = $producto->getIdeproducto();
    $can = $solicitudSeleccionada['cantidades'][$producto->getIdeproducto()];
    // Preparar la instrucción SQL
    try {
        $ps = $cn->prepare($sql);
        
        // Asignar valores a los parámetros de la consulta
        $ps->bindParam(1, $idventa);
        $ps->bindParam(2, $idusuario);
        $ps->bindParam(3, $pro);
        $ps->bindParam(4, $can);

        // Ejecutar la inserción del producto
        $ps->execute();
    } catch (PDOException $ex) {
        // Manejar excepciones aquí
        // Logger::log($ex->getMessage()); // Si tienes un sistema de registro de errores
        echo "Error en la inserción del producto: " . $ex->getMessage();
    } finally {
        Conexion::cerrar($cn); // Cerrar la conexión después de usarla
    }
    }   
}

public static function obtenerProductos() {
    $productos = array();

    // SQL para la selección de productos
    $sql = "SELECT * FROM PRODUCTO";

    // Establecer la conexión a la base de datos
    $cn = Conexion::abrir(); // Asumiendo que hay una clase llamada Conexion con un método estático abrir()

    // Preparar la instrucción SQL
    try {
        $ps = $cn->prepare($sql);

        // Ejecutar la consulta y obtener el resultado en un ResultSet
        $ps->execute();
        $result = $ps->fetchAll(PDO::FETCH_ASSOC);

        // Recorrer los resultados y crear objetos Producto
        foreach ($result as $row) {
            $producto = new Producto();
            $producto->setIdeproducto($row['idproducto']);
            $producto->setProducto($row['producto']);
            $producto->setDescripcion($row['descripcion']);
            $producto->setPrecio($row['precio']);
            $producto->setCantidadStock($row['cantidadStock']);
            $producto->setCategoria($row['categoria']);
            $producto->setMarca($row['marca']);
            $producto->setEstado($row['estado']);
            $productos[] = $producto;
        }
    } catch (PDOException $ex) {
        // Manejar excepciones aquí
        // Logger::log($ex->getMessage()); // Si tienes un sistema de registro de errores
        echo "Error al obtener productos: " . $ex->getMessage();
    } finally {
        Conexion::cerrar($cn); // Cerrar la conexión después de usarla
    }

    return $productos;
}

public static function buscarPorId($cod) {
    // Variable producto
    $producto = null;

    try {
        // Consulta a la base de datos
        $sql = "SELECT * FROM PRODUCTO WHERE idproducto=?";
        
        // Conexión a la base de datos
        $cn = Conexion::abrir(); // Asumiendo que hay una clase llamada Conexion con un método estático abrir()

        // Ejecutar la instrucción SQL usando la conexión
        $ps = $cn->prepare($sql);

        // Asignar valor al parámetro
        $ps->bindParam(1, $cod, PDO::PARAM_INT);

        // Ejecutar la consulta
        $ps->execute();

        // Leer el resultado y asignar valores al objeto producto
        if ($row = $ps->fetch(PDO::FETCH_ASSOC)) {
            // Crear objeto producto
            $producto = new Producto(
                $row['idproducto'],
                $row['producto'],
                $row['descripcion'],
                $row['precio'],
                $row['cantidadStock'],
                $row['categoria'],
                $row['marca'],
                $row['estado']
            );
        }

        // Cerrar objetos
        $cn = null;
        $ps = null;
    } catch (PDOException $ex) {
        // Manejar excepciones aquí
        echo "Error: " . $ex->getMessage();
    } finally {
        Conexion::cerrar($cn); // Cerrar la conexión después de usarla
    }

    return $producto;
}

public static function modificar($producto) {
    $sql = "UPDATE producto SET producto=?, descripcion=?, cantidadStock=?, precio=?, categoria=?, marca=?, estado=? WHERE idproducto=?";
    $cn = Conexion::abrir();
    try {
        $ps = $cn->prepare($sql);
        $nombre = $producto->getProducto();
        $descripcion = $producto->getDescripcion();
        $cantidad = $producto->getCantidadStock();
        $precio = $producto->getPrecio();
        $categoria = $producto->getCategoria();
        $marca = $producto->getMarca();
        $estado = $producto->getEstado();
        $idproducto = $producto->getIdeproducto();

        // Asignar valores a los parámetros de la consulta
        $ps->bindParam(1, $nombre);
        $ps->bindParam(2, $descripcion);
        $ps->bindParam(3, $cantidad);
        $ps->bindParam(4, $precio);
        $ps->bindParam(5, $categoria);
        $ps->bindParam(6, $marca);
        $ps->bindParam(7, $estado);
        $ps->bindParam(8, $idproducto);

        // Ejecutar la actualización
        $ps->execute();

        // Cerrar objetos
        $cn = null;
        $ps = null;
    } catch (PDOException $ex) {
        // Manejar excepciones aquí
        echo "Error al modificar el producto: " . $ex->getMessage();
    } finally {
        Conexion::cerrar($cn); // Cerrar la conexión después de usarla
    }
}

public static function buscarProductos($letras) {
    $productos = array();
    
    try {
        $sql = "SELECT * FROM PRODUCTO WHERE producto LIKE ?";
        $cn = Conexion::abrir(); // Asumiendo que tienes un método estático llamado abrir() en la clase Conexion

        $ps = $cn->prepare($sql);
        
        // Agregar el signo de porcentaje (%) al inicio y al final de las letras para buscar coincidencias en cualquier posición
        $ps->bindValue(1, "%" . $letras . "%", PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $producto = new Producto(
                $row['idproducto'],
                $row['producto'],
                $row['descripcion'],
                $row['precio'],
                $row['cantidadStock'],
                $row['categoria'],
                $row['marca'],
                $row['estado']
            );
            $productos[] = $producto;
        }

        // Cerrar objetos
        $cn = null;
        $ps = null;
    } catch (PDOException $ex) {
        // Manejar excepciones aquí
        echo "Error: " . $ex->getMessage();
    } finally {
        Conexion::cerrar($cn); // Cerrar la conexión después de usarla
    }

    return $productos;
}

}