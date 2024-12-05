<?php

include_once __DIR__ . '/../conexion.php';
include_once __DIR__ . '/../Models/privilegio.php';


class UsuarioPrivilegioDAO {

    public static function buscarByIdUP($cod) {
        $ups = [];
        $priv = [];
        $sql = "SELECT IDPRIVILEGIO FROM USUARIOPRIVILEGIO WHERE IDUSUARIO=?";
        $cn = Conexion::abrir();

        try {
            $ps = $cn->prepare($sql);
            $ps->bindParam(1, $cod);
            $ps->execute();

            $ups = $ps->fetchAll(PDO::FETCH_COLUMN);
            $priv = self::buscarByIdP($ups);
    } catch (PDOException $ex) {
        echo "Error en la consulta: " . $ex->getMessage();
    } finally {
        Conexion::cerrar($cn); // Cerrar la conexión después de usarla
    }
        return $priv;
    }

    public static function buscarByIdP($idPrivilegios) {
        $privilegios = [];
        $sql = "SELECT * FROM PRIVILEGIOS WHERE IDPRIVILEGIO=?";
        $cn = Conexion::abrir();

        try {
            foreach ($idPrivilegios as $idPrivilegio) {
                $ps = $cn->prepare($sql);
                $ps->bindParam(1, $idPrivilegio);
                $ps->execute();

                while ($rs = $ps->fetch(PDO::FETCH_ASSOC)) {
                    $privilegios[] = new Privilegios($rs['idprivilegio'], $rs['pathPrivilegio'], 
                    $rs['labelPrivilegio'], $rs['buttonPrivilegio'], $rs['iconPrivilegio']);
                }
            }
        } catch (PDOException $ex) {
            echo "Error en la consulta: " . $ex->getMessage();
        } finally {
            Conexion::cerrar($cn); // Cerrar la conexión después de usarla
        }
        return $privilegios;
    }
}