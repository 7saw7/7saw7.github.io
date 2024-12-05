<?php

class DetalleVenta {
    private $iddetalle;
    private $idventa;
    private $idusuario;
    private $idproducto;
    private $cantidad;


    public function __construct($iddetalle, $idventa, $idusuario, $idproducto, $cantidad) {
        $this->iddetalle = $iddetalle;
        $this->idventa = $idventa;
        $this->idusuario = $idusuario;
        $this->idproducto = $idproducto;
        $this->cantidad = $cantidad;

    }

    public function getIddetalle() {
        return $this->iddetalle;
    }

    public function setIddetalle($iddetalle) {
        $this->iddetalle = $iddetalle;
    }

    public function getIdventa() {
        return $this->idventa;
    }

    public function setIdventa($idventa) {
        $this->idventa = $idventa;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function getIdproduto() {
        return $this->idproducto;
    }

    public function setIdproduto($idproducto) {
        $this->idproducto = $idproducto;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    
}
