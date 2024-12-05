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
    <link href="../../assets/css/modificarProducto.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php echo $header; ?> 

    <form action="../../controlador/ModuloInventario/GestionarInventarioAlmacenController.php" method="post">
    <table>
        <tr>
            <td>Nombre</td>
            <td>
                <input name="ideproducto" type="hidden" value="<?php echo $producto->getIdeproducto(); ?>">
                <input 
                    name="producto" 
                    type="text" 
                    value="<?php echo htmlspecialchars($producto->getProducto(), ENT_QUOTES, 'UTF-8'); ?>" 
                    placeholder="Ingrese el nombre del producto" 
                    required 
                    minlength="3" 
                    maxlength="100" 
                    pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s\-]+" 
                    title="El nombre puede incluir letras, números, espacios y guiones">
            </td>
        </tr>
        <tr>
            <td>Descripción</td>
            <td>
                <textarea 
                    class="descripcion" 
                    name="descripcion" 
                    placeholder="Ingrese una descripción" 
                    required 
                    minlength="10" 
                    maxlength="255" 
                    title="La descripción debe tener entre 10 y 255 caracteres."><?php echo htmlspecialchars($producto->getDescripcion(), ENT_QUOTES, 'UTF-8'); ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Precio</td>
            <td>
                <input 
                    class="precio"
                    name="precio" 
                    type="number" 
                    step="0.01" 
                    min="0.1" 
                    max="10000" 
                    value="<?php echo $producto->getPrecio(); ?>" 
                    placeholder="Ingrese el precio" 
                    required 
                    title="El precio debe ser un número positivo con hasta 2 decimales">
            </td>
        </tr>
        <tr>
            <td>Categoría</td>
            <td>
                <input 
                    name="categoria" 
                    type="text" 
                    value="<?php echo htmlspecialchars($producto->getCategoria(), ENT_QUOTES, 'UTF-8'); ?>" 
                    placeholder="Ingrese la categoría" 
                    required 
                    minlength="3" 
                    maxlength="50" 
                    pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                    title="La categoría solo puede incluir letras y espacios">
            </td>
        </tr>
        <tr>
            <td>Marca</td>
            <td>
                <input 
                    name="marca" 
                    type="text" 
                    value="<?php echo htmlspecialchars($producto->getMarca(), ENT_QUOTES, 'UTF-8'); ?>" 
                    placeholder="Ingrese la marca" 
                    required 
                    minlength="2" 
                    maxlength="50"
                    pattern="[A-Za-z0-9\s\.\,\!\@\#\$\%\^\&\*\(\)\-\_\+\=\?\<\>\:\'\"
                    title="La marca debe contener solo letras y espacios, y tener entre 2 y 50 caracteres.">
            </td>
        </tr>
        <tr>
            <td>Estado</td>
            <td>
                <select name="estado" required>
                    <option value="Activo" <?php echo $producto->getEstado() === "Activo" ? "selected" : ""; ?>>Activo</option>
                    <option value="Inactivo" <?php echo $producto->getEstado() === "Inactivo" ? "selected" : ""; ?>>Inactivo</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <input name="cantidadStock" type="hidden" value="<?php echo $producto->getCantidadStock(); ?>">
            </td>
            <td>
                <input class="BLogin" type="submit" name="buttonSubPrivilegio" value="Grabar Producto">
            </td>
        </tr>
    </table>
    </form>
    <form action="../../controlador/ModuloInventario/GestionarInventarioAlmacenController.php" method="post">
        <button style="position: absolute; top: 10px; right: 10px;" type="submit" name="buttonSubPrivilegio" value="Regresar Modificar">Regresar</button>
    </form>

    <?php echo $footer; ?>

</body>
</html>