<?php

class Usuario {
    private $idusuario;
    private $usuario;
    private $password;
    private $preguntaSeg;
    private $respuestaSeg;
    private $nombreCom;
    private $dni;
    private $cargo;
    private $estado;

    public function __construct($idusuario, $usuario, $password, $preguntaSeg, $respuestaSeg, $nombreCom, $dni, $cargo, $estado) {
        $this->idusuario = $idusuario;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->preguntaSeg = $preguntaSeg;
        $this->respuestaSeg = $respuestaSeg;
        $this->nombreCom = $nombreCom;
        $this->dni = $dni;
        $this->cargo = $cargo;
        $this->estado = $estado;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPreguntaSeg() {
        return $this->preguntaSeg;
    }

    public function getRespuestaSeg() {
        return $this->respuestaSeg;
    }

    public function getNombreCom() {
        return $this->nombreCom;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function getEstado() {
        return $this->estado;
    }

}
?>