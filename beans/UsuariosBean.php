<?php

class UsuariosBean {
    private $codigo;
    private $contraseña;
    private $rol;
    private $estado;
    private $nombre1;
    private $nombre2;
    private $apellido1;
    private $apellido2;
    private $correo;

    public function __construct() {
        // Constructor vacío
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    public function getContraseña() {
        return $this->contraseña;
    }

    public function setContraseña($contraseña) {
        $this->contraseña = $contraseña;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getNombre1() {
        return $this->nombre1;
    }

    public function setNombre1($nombre1) {
        $this->nombre1 = $nombre1;
    }

    public function getNombre2() {
        return $this->nombre2;
    }

    public function setNombre2($nombre2) {
        $this->nombre2 = $nombre2;
    }

    public function getApellido1() {
        return $this->apellido1;
    }

    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    public function getApellido2() {
        return $this->apellido2;
    }

    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }
}

?>
