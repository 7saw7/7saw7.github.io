<?php

include_once __DIR__ . '/../conexion.php';
include_once __DIR__ . '/../Models/usuario.php';

class UsuarioDAO {

    public static function validar($co, $cl) {
        $user = null;
        $sql = "SELECT * FROM USUARIO WHERE USUARIO=? AND PASSWORD=?";
        $cn = Conexion::abrir();

        try {
            $ps = $cn->prepare($sql);
            $ps->bindParam(1, $co);
            $ps->bindParam(2, $cl);
            $ps->execute();

            while ($rs = $ps->fetch(PDO::FETCH_ASSOC)) {
                $user = new Usuario($rs['idusuario'], $rs['usuario'], $rs['password'], $rs['preguntaSeg'], 
                $rs['respuestaSeg'], $rs['nombreCom'], $rs['dni'], $rs['cargo'], $rs['estado']);
            }
        } catch (PDOException $ex) {
            echo "Error en la consulta: " . $ex->getMessage();
        } finally {
            Conexion::cerrar($cn); // Cerrar la conexión después de usarla
        }
        return $user;
    }

    public static function validarDni($dni) {
        $user = null;
        $sql = "SELECT * FROM USUARIO WHERE DNI=?";
        $cn = Conexion::abrir();

        try {
            $ps = $cn->prepare($sql);
            $ps->bindParam(1, $dni);
            $ps->execute();

            if ($rs = $ps->fetch(PDO::FETCH_ASSOC)) {
                $user = new Usuario($rs['idusuario'], $rs['usuario'], $rs['password'], $rs['preguntaSeg'], 
                $rs['respuestaSeg'], $rs['nombreCom'], $rs['dni'], $rs['cargo'], $rs['estado']);
            }
        } catch (PDOException $ex) {
            echo "Error en la consulta: " . $ex->getMessage();
        } finally {
            Conexion::cerrar($cn); // Cerrar la conexión después de usarla
        }
        return $user;
    }

    public static function validarRespuesta($respuesta) {
        $user = null;
        $sql = "SELECT * FROM USUARIO WHERE respuestaSeg=?";
        $cn = Conexion::abrir();

        try {
            $ps = $cn->prepare($sql);
            $ps->bindParam(1, $respuesta);
            $ps->execute();

            if ($rs = $ps->fetch(PDO::FETCH_ASSOC)) {
                $user = new Usuario($rs['idusuario'], $rs['usuario'], $rs['password'], $rs['preguntaSeg'], 
                $rs['respuestaSeg'], $rs['nombreCom'], $rs['dni'], $rs['cargo'], $rs['estado']);
            }
        } catch (PDOException $ex) {
            echo "Error en la consulta: " . $ex->getMessage();
        } finally {
            Conexion::cerrar($cn); // Cerrar la conexión después de usarla
        }
        return $user;
    }

    public static function modificarContraseña($nuevaContraseña, $idUsuario) {
        $sql = "UPDATE USUARIO SET password = ? WHERE idusuario = ?";
        $cn = Conexion::abrir();

        try {
            $ps = $cn->prepare($sql);
            $ps->bindParam(1, $nuevaContraseña);
            $ps->bindParam(2, $idUsuario);
            $ps->execute();
        } catch (PDOException $ex) {
            echo "Error en la consulta: " . $ex->getMessage();
        } finally {
            Conexion::cerrar($cn); // Cerrar la conexión después de usarla
        }
    }
}
?>