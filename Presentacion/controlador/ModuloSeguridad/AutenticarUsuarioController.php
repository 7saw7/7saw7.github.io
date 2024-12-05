<?php
include_once __DIR__ . '/../../../Datos/DAO/UsuarioDAO.php';
include_once __DIR__ . '/../../../Datos/DAO/UsuarioPrivilegioDAO.php';
include_once __DIR__ . '/../../../Datos/Models/usuario.php';
include_once __DIR__ . '/../../validador/validador.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $login = isset($_POST['txtLogin']) ? $_POST['txtLogin'] : null;
    $password = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : null;

    // Validaciones
    $errorMessage = "";

    // Validar el campo usuario
    $validacionLogin = Validador::validarUsuario($login);
    if ($validacionLogin !== true) {
        $errorMessage = $validacionLogin;
    }

    // Validar el campo contraseña
    $validacionPassword = Validador::validarContraseña($password);
    if ($validacionPassword !== true) {
        $errorMessage = $validacionPassword;
    }

    // Si hay errores, redirigir al formulario con el mensaje de error
    if ($errorMessage !== "") {
        header("Location: ../../vista/ModuloSeguridad/formAutenticarUsuario.php?msg=" . urlencode($errorMessage));
        exit();
    }

    // Verificar las credenciales en la base de datos
    $user = UsuarioDAO::validar($login, $password);

    if ($user) {
        // Obtener privilegios del usuario
        $privilegio = UsuarioPrivilegioDAO::buscarByIdUP($user->getIdusuario());

        // Iniciar sesión y redirigir al sistema
        session_start();
        $_SESSION['privilegios'] = $privilegio;
        $_SESSION['idusuario'] = $user->getIdusuario();
        header("Location: ../../vista/ModuloSeguridad/BienvenidaSistema.php");
        exit();
    } else {
        // Si las credenciales no son válidas
        $errorMessage = "Error: los datos ingresados no son válidos";
        header("Location: ../../vista/ModuloSeguridad/formAutenticarUsuario.php?msg=" . urlencode($errorMessage));
        exit();
    }
} else {
    // Si no es una solicitud POST
    $errorMessage = "";
    header("Location: ../../vista/ModuloSeguridad/formAutenticarUsuario.php?msg=" . urlencode($errorMessage));
    exit();
}