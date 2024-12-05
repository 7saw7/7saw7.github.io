<?php

class Privilegios {
    private $idprivilegio;
    private $pathprivilegio;
    private $labelPrivilegio;
    private $buttonPrivilegio;
    private $iconPrivilegio; 

    public function __construct($idprivilegio, $pathprivilegio, $labelPrivilegio, $buttonPrivilegio, $iconPrivilegio) {
        $this->idprivilegio = $idprivilegio;
        $this->pathprivilegio = $pathprivilegio;
        $this->labelPrivilegio = $labelPrivilegio;
        $this->buttonPrivilegio = $buttonPrivilegio;
        $this->iconPrivilegio = $iconPrivilegio;
    }

    public function getIdprivilegio() {
        return $this->idprivilegio;
    }

    public function setIdprivilegio($idprivilegio) {
        $this->idprivilegio = $idprivilegio;
    }

    public function getPathprivilegio() {
        return $this->pathprivilegio;
    }

    public function setPathprivilegio($pathprivilegio) {
        $this->pathprivilegio = $pathprivilegio;
    }

    public function getLabelPrivilegio() {
        return $this->labelPrivilegio;
    }

    public function setLabelPrivilegio($labelPrivilegio) {
        $this->labelPrivilegio = $labelPrivilegio;
    }

    public function getButtonPrivilegio() {
        return $this->buttonPrivilegio;
    }

    public function setButtonPrivilegio($buttonPrivilegio) {
        $this->buttonPrivilegio = $buttonPrivilegio;
    }

    public function getIconPrivilegio() {
        return $this->iconPrivilegio;
    }

    public function setIconPrivilegio($iconPrivilegio) {
        $this->iconPrivilegio = $iconPrivilegio;
    }

}