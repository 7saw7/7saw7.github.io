<?php
include_once __DIR__ . '/../../HeaderFooterSingleton.php';
include_once __DIR__ . '/../../../Datos/Models/producto.php';

$singleton = HeaderFooterSingleton::obtenerInstancia();
$header = $singleton->obtenerHeader();
$footer = $singleton->obtenerFooter();

session_start();
$producto = $_SESSION['producto'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Editar Producto</title>
    <link href="../../assets/css/formRegistroProducto.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php echo $header; ?> 

    <form action="../../controlador/ModuloInventario/RegistrarProducFarmaController.php" method="post">
        <table>
            <tr>
                <td>Nombre</td>
                <td>
                    <input name="ideproducto" type="hidden" value="<?php echo $producto->getIdeproducto(); ?>">
                    <input name="producto" type="text" value="<?php echo $producto->getProducto(); ?>" readonly>

                </td>
            </tr>
            <tr>
                <td>Descripción</td>
                <td><input name="descripcion" type="text" value="<?php echo $producto->getDescripcion(); ?>" readonly></td>
            </tr>
            <tr>
                <td>Precio</td>
                <td><input name="precio" type="text" value="<?php echo $producto->getPrecio(); ?>" readonly></td>
            </tr>
            <tr>
                <td>Categoría</td>
                <td><input name="categoria" type="text" value="<?php echo $producto->getCategoria(); ?>" readonly></td>
            </tr>
            <tr>
                <td>Marca</td>
                <td><input name="marca" type="text" value="<?php echo $producto->getMarca(); ?>" readonly></td>
            </tr>
            <tr>
                <td>Estado</td>
                <td><input name="estado" type="text" value="<?php echo $producto->getEstado(); ?>" readonly></td>
            </tr>
            <tr>
                <td>Cantidad en Stock</td>
                <td><input name="cantidadStock" type="text" value="<?php echo $producto->getCantidadStock(); ?>" readonly></td>
            </tr>
            <tr>
                <td>Añadir Cantidad</td>
                <td>
                <input 
                    name="AcantidadStock" 
                    type="number" 
                    value="<?php echo isset($_POST['AcantidadStock']) ? htmlspecialchars($_POST['AcantidadStock']) : ''; ?>" 
                    placeholder="Ingrese la cantidad a agregar" 
                    min="1" 
                    max="250" 
                    required 
                    title="Por favor, ingrese un número entre 1 y 250">
            </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input class="BLogin" type="submit" name="buttonSubPrivilegio" value="Grabar Producto">
                </td>
            </tr>
        </table>
    </form>
    <form action="../../controlador/ModuloInventario/RegistrarProducFarmaController.php" method="post">
        <button style="position: absolute; top: 10px; right: 10px;" type="submit" name="buttonSubPrivilegio" value="Regresar Modificar">Regresar</button>
    </form>

    <?php echo $footer; ?>

</body>
</html>