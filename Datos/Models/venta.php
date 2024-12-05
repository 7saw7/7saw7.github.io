<?php

class Venta {
    private $idventa;
    private $opExoneradas;
    private $opGravadas;
    private $igv;
    private $total;
    private $fechaventa;


    public function __construct($idventa, $opExoneradas, $opGravadas, $igv, $total, $fechaventa) {
        $this->idventa = $idventa;
        $this->opExoneradas = $opExoneradas;
        $this->opGravadas = $opGravadas;
        $this->igv = $igv;
        $this->total = $total;
        $this->fechaventa = $fechaventa;

    }

    public function getIdventa() {
        return $this->idventa;
    }

    public function setIdventa($idventa) {
        $this->idventa = $idventa;
    }

    public function getOpExoneradas() {
        return $this->opExoneradas;
    }

    public function setOpExoneradas($opExoneradas) {
        $this->opExoneradas = $opExoneradas;
    }

    public function getOpGravadas() {
        return $this->opGravadas;
    }

    public function setOpGravadas($opGravadas) {
        $this->opGravadas = $opGravadas;
    }

    public function getIgv() {
        return $this->igv;
    }

    public function setIgv($igv) {
        $this->igv = $igv;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }
    
    public function getFechaventa() {
        return $this->fechaventa;
    }

    public function setFechaventa($fechaventa) {
        $this->fechaventa = $fechaventa;
    }

}