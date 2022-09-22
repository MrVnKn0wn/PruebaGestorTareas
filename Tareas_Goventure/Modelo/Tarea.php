<?php

class Tarea{
    private $id;
    private $denominacion;
    // private $categorias=array();

    public function __construct($denominacion) {
        $this->denominacion = $denominacion;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getDenominacion() {
        return $this->denominacion;
    }

    // function getCategorias() {
    //     return $this->categorias;
    // }

    public function setId($id) {
        $this->id = $id;
    }

    // function addCategoria($categoria){
    //     $this->categorias[]=$categoria;
    // }

    // function setCategorias($arrayCategorias){
    //     $this->categorias=$arrayCategorias;
    // }

    public function setDenominacion($denominacion) {
        $this->denominacion = $denominacion;
    }

    public function __toString() {
        return "ID " . $this->id . " / " . $this->denominacion;
    }
}