<?php
include_once __DIR__ . '/../../HeaderFooterSingleton.php';
include_once __DIR__ . '/../../../Datos/Models/privilegio.php';
include_once __DIR__ . '/../../../Datos/Models/usuario.php';
session_start();
if (!isset($_SESSION["idusuario"])) {
    header("Location: formAutenticarUsuario.php");
    exit();
}
$singleton = HeaderFooterSingleton::obtenerInstancia();
$header = $singleton->obtenerHeader();
$footer = $singleton->obtenerFooter();
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Bienvenido:</title>
    <link href="../../assets/css/BienvenidaSistema.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php echo $header; ?>    
    <?php
$privilegios = $_SESSION["privilegios"];
?>
    <table class="table">
        <tr>
            <?php foreach ($privilegios as $privilegio) { ?>
                <td class="tde">
                    <form name="formx" method="POST" action="<?php echo $privilegio->getPathprivilegio(); ?>">
                        <p><img src="<?php echo $privilegio->getIconPrivilegio(); ?>" width="300" height="200"></p>
                        <input class="BLogin" type="submit" value="<?php echo $privilegio->getLabelPrivilegio(); ?>" name="buttonPrivilegio" />
                    </form>
                </td>
            <?php } ?>
        </tr>
    </table>
    <?php echo $footer; ?>
    <form action="../../controlador/ModuloSeguridad/privilegiosController.php" method="post">
        <button style="position: absolute; top: 10px; right: 10px;" type="submit" name="buttonPrivilegio" value="Regresar">Regresar</button>
    </form>
</body>
</html>

