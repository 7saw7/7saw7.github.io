<?php

class Validador {

    // Función para sanitizar los datos de usuario y contraseña
    public static function sanitizarDatos($dato) {
        return filter_var($dato, FILTER_SANITIZE_STRING);
    }

    // Función para validar si un campo está vacío
    public static function validarCampoVacio($campo, $nombreCampo) {
        if (empty($campo)) {
            return "El campo $nombreCampo no puede estar vacío.";
        }
        return true;
    }

    // Función para validar el usuario
    public static function validarUsuario($usuario) {
        // Sanitizar el dato antes de validarlo
        $usuario = self::sanitizarDatos($usuario);

        // Validar que el usuario no esté vacío
        $validacionVacio = self::validarCampoVacio($usuario, "Usuario");
        if ($validacionVacio !== true) {
            return $validacionVacio;
        }

        // Validación de longitud (3 a 15 caracteres) y patrón alfanumérico
        if (strlen($usuario) < 3 || strlen($usuario) > 15) {
            return "El usuario debe tener entre 3 y 15 caracteres.";
        }

        if (!preg_match("/^[A-Za-z0-9]+$/", $usuario)) {
            return "El usuario solo puede contener letras y números.";
        }

        // Validación pasada
        return true;
    }

    // Función para validar la contraseña
    public static function validarContraseña($password) {
        // Sanitizar el dato antes de validarlo
        $password = self::sanitizarDatos($password);

        // Validar que la contraseña no esté vacía
        $validacionVacio = self::validarCampoVacio($password, "Contraseña");
        if ($validacionVacio !== true) {
            return $validacionVacio;
        }

        // Validación de longitud y complejidad de la contraseña
        if (strlen($password) < 8 || strlen($password) > 20) {
            return "La contraseña debe tener entre 8 y 20 caracteres.";
        }

        if (!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $password)) {
            return "La contraseña debe tener al menos 8 caracteres, incluyendo mayúsculas, minúsculas y números.";
        }

        // Validación pasada
        return true;
    }
}