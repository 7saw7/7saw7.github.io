<?php

class Producto {
    private $ideproducto;
    private $producto;
    private $descripcion;
    private $precio;
    private $cantidadStock;
    private $categoria;
    private $marca;
    private $estado;

    public function __construct(
        $ideproducto = null,
        $producto = null,
        $descripcion = null,
        $precio = null,
        $cantidadStock = null,
        $categoria = null,
        $marca = null,
        $estado = null
    ) {
        $this->ideproducto = $ideproducto;
        $this->producto = $producto;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->cantidadStock = $cantidadStock;
        $this->categoria = $categoria;
        $this->marca = $marca;
        $this->estado = $estado;
    }


    public function getIdeproducto() {
        return $this->ideproducto;
    }

    public function setIdeproducto($ideproducto) {
        $this->ideproducto = $ideproducto;
    }

    public function getProducto() {
        return $this->producto;
    }

    public function setProducto($producto) {
        $this->producto = $producto;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function getCantidadStock() {
        return $this->cantidadStock;
    }

    public function setCantidadStock($cantidadStock) {
        $this->cantidadStock = $cantidadStock;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

}