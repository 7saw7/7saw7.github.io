<?php

class UsuarioPrivilegio {
    private $idusuarioprivilegio;
    private $idusuario;
    private $idprivilegio;

    public function __construct($idusuarioprivilegio, $idusuario, $idprivilegio) {
        $this->idusuarioprivilegio = $idusuarioprivilegio;
        $this->idusuario = $idusuario;
        $this->idprivilegio = $idprivilegio;
    }

    public function getIdusuarioprivilegio() {
        return $this->idusuarioprivilegio;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function getIdprivilegio() {
        return $this->idprivilegio;
    }

    public function setIdusuarioprivilegio($idusuarioprivilegio) {
        $this->idusuarioprivilegio = $idusuarioprivilegio;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function setIdprivilegio($idprivilegio) {
        $this->idprivilegio = $idprivilegio;
    }

}
