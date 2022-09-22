<?php

class Categoria{
    private $id;
    private $denominacion;

    public function __construct($denominacion) {
        $this->denominacion = $denominacion;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getDenominacion() {
        return $this->denominacion;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDenominacion($denominacion) {
        $this->denominacion = $denominacion;
    }

    public function __toString() {
        return "ID " . $this->id . " / " . $this->denominacion;
    }
}