<?php
include_once __DIR__ . '/../../HeaderFooterSingleton.php';
include_once __DIR__ . '/../../../Datos/Models/producto.php';
include_once __DIR__ . '/../../../Datos/DAO/ProductoDAO.php';


$singleton = HeaderFooterSingleton::obtenerInstancia();
$header = $singleton->obtenerHeader();
$footer = $singleton->obtenerFooter();

session_start();
$listaProductos = $_SESSION['productos'] ?? array();

$listaProductosSeleccionados = $_SESSION['productosSeleccionados'] ?? array();
$mostrarSegundaTabla = !empty($listaProductosSeleccionados);
$solicitudes = $_SESSION['solicitudes'] ?? array(); // Obtener la lista de solicitudes de la sesión

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Formulario de Búsqueda</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="../../assets/css/formRegistrarSolicitudPedido.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php echo $header; ?> 
    <form action="../../controlador/ModuloVentas/RegistrarSolicitudPedidoController.php" method="post">
        <input type="text" name="busqueda" placeholder="Ingrese un término de búsqueda">
        <button class="BLogin" name="buttonSubPrivilegio" value="Buscar Producto" type="submit">Buscar</button>
        <button class="BLogin" name="buttonSubPrivilegio" value="Actualizar Lista" type="submit">Actualizar</button>
    </form>

    <!-- Tabla de productos -->
    <table>
        <h2>Lista de Productos</h2>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad en Stock</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaProductos as $producto) { ?>
                <tr>
                    <td><?php echo $producto->getIdeproducto(); ?></td>
                    <td><?php echo $producto->getProducto(); ?></td>
                    <td><?php echo $producto->getDescripcion(); ?></td>
                    <td><?php echo $producto->getPrecio(); ?></td>
                    <td><?php echo $producto->getCantidadStock(); ?></td>
                    <td><?php echo $producto->getCategoria(); ?></td>
                    <td><?php echo $producto->getMarca(); ?></td>
                    <td><?php echo $producto->getEstado(); ?></td>
                    <td>
                        <form action="../../controlador/ModuloVentas/RegistrarSolicitudPedidoController.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $producto->getIdeproducto(); ?>">
                            <button class="BLogin" type="submit" name="buttonSubPrivilegio" value="Registrar Producto">Añadir</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Tabla de productos seleccionados -->
    <?php if ($mostrarSegundaTabla) { ?>
        <h2>Productos Solicitados</h2>
        <form action="../../controlador/ModuloVentas/RegistrarSolicitudPedidoController.php" method="post">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad en Stock</th>
                        <th>Cantidad a comprar</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaProductosSeleccionados as $producto) { ?>
                        <tr>
                            <td><?php echo $producto->getIdeproducto(); ?></td>
                            <td><?php echo $producto->getProducto(); ?></td>
                            <td><?php echo $producto->getDescripcion(); ?></td>
                            <td><?php echo $producto->getPrecio(); ?></td>
                            <td><?php echo $producto->getCantidadStock(); ?></td>
                            <td>
                                <select name="cantidad[<?php echo $producto->getIdeproducto(); ?>]" id="cantidad">
                                    <?php for ($i = 0; $i <= 10; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><?php echo $producto->getCategoria(); ?></td>
                            <td><?php echo $producto->getMarca(); ?></td>
                            <td><?php echo $producto->getEstado(); ?></td>
                            <td>
                            <form action="../../controlador/ModuloVentas/RegistrarSolicitudPedidoController.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $producto->getIdeproducto(); ?>">
                                <button class="BLogin" type="submit" name="buttonSubPrivilegio" value="Quitar Producto">Quitar</button>
                            </form>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <?php $_SESSION['lista'] = $listaProductosSeleccionados;?>
                            <button class="BLogin" type="submit" name="buttonSubPrivilegio" value="Registrar Solicitud Producto">Registrar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    <?php } ?>

    <!-- Botón "Regresar" fuera de la tabla -->
    <form action="../../controlador/ModuloVentas/RegistrarSolicitudPedidoController.php" method="post">
        <button style="position: absolute; top: 10px; right: 10px;" type="submit" name="buttonSubPrivilegio" value="Regresar Bienvenida">Regresar</button>
    </form>
    <?php
    $productos = ProductoDAO::obtenerProductos();
    $_SESSION['productos'] = $productos;
    ?>
</body>
</html>