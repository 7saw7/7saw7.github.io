<?php
include_once __DIR__ . '/../../HeaderFooterSingleton.php';
$singleton = HeaderFooterSingleton::obtenerInstancia();
$header = $singleton->obtenerHeader();
$footer = $singleton->obtenerFooter();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="../../assets/css/registrarProductos.css" rel="stylesheet" type="text/css">
    <title>PHP Page</title>
</head>

<body>
    <?php echo $header; ?> 
    <div class="container">
    <form action="../../controlador/ModuloInventario/GestionarInventarioAlmacenController.php" method="post">
        <table>
            <tr>
                <td><label for="nombre">Nombre:</label></td>
                <td>
                    <input 
                        type="text" 
                        id="nombre" 
                        name="txt_producto" 
                        placeholder="Ingrese el nombre del producto"
                        required 
                        minlength="3" 
                        maxlength="100" 
                        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s\-]+" 
                        title="El nombre puede incluir letras, números, espacios y guiones">
                </td>
            </tr>

            <tr>
                <td><label for="descripcion">Descripción:</label></td>
                <td>
                    <textarea 
                        class="descripcion" 
                        name="txt_descripcion" 
                        placeholder="Ingrese una descripción"
                        required 
                        minlength="10" 
                        maxlength="255"
                        title="La descripción debe tener entre 10 y 255 caracteres."></textarea>
                </td>
            </tr>

            <tr>
                <td><label for="precio">Precio:</label></td>
                <td>
                    <input 
                        type="number" 
                        class="precio" 
                        name="txt_precio" 
                        step="0.01" 
                        min="0.01" 
                        max="10000"
                        placeholder="Ingrese el precio"
                        required
                        title="El precio debe ser un número positivo con hasta 2 decimales.">
                </td>
            </tr>

            <tr>
                <td><label for="categoria">Categoría:</label></td>
                <td>
                    <input 
                        type="text" 
                        id="categoria" 
                        name="txt_categoria" 
                        placeholder="Ingrese la categoría"
                        required 
                        minlength="3" 
                        maxlength="50"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                        title="La categoría solo puede incluir letras y espacios">
                </td>
            </tr>

            <tr>
                <td><label for="marca">Marca:</label></td>
                <td>
                    <input 
                        type="text" 
                        id="marca" 
                        name="txt_marca" 
                        placeholder="Ingrese la marca"
                        required 
                        minlength="2" 
                        maxlength="50"
                        pattern="[A-Za-z0-9\s\.\,\!\@\#\$\%\^\&\*\(\)\-\_\+\=\?\<\>\:\'\"
                        title="La marca debe contener solo letras y espacios, y tener entre 2 y 50 caracteres.">
                </td>
            </tr>

            <tr>
                <td><label for="estado">Estado:</label></td>
                <td>
                    <select id="estado" name="txt_estado" required>
                        <option value="" disabled selected>Seleccione un estado</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input 
                        type="submit" 
                        value="Registrar Producto" 
                        name="buttonSubPrivilegio" 
                        class="BLogin">
                </td>
            </tr>
        </table>
    </form>
    <form action="../../controlador/ModuloInventario/GestionarInventarioAlmacenController.php" method="post">
        <button 
            style="position: absolute; top: 10px; right: 10px;" 
            type="submit" 
            name="buttonSubPrivilegio" 
            value="Regresar Gestion">
            Regresar
        </button>
    </form>
    </div>
    <?php echo $footer; ?>
</body>
</html>

