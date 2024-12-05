<?php

class Conexion {

    private static $url = "mysql:host=localhost;dbname=polonia";
    private static $usuario = "root";
    private static $password = "";

    public static function abrir() {
        try {
            $cn = new PDO(self::$url, self::$usuario, self::$password);
            $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $cn;
        } catch (PDOException $ex) {
            echo "Error en la conexión: " . $ex->getMessage();
            return null;
        }
    }

    public static function cerrar($cn) {
        $cn = null;
    }
}