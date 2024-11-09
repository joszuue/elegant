<?php
class OrdenBean {
    private $idOrden;
    private $codigo;
    private $idProducto;
    private $cantidad;
    private $fecha;
    private $total;
    private $comentario;
    private $estado;
    private $producto;


    // Getter and Setter for idOrden
    public function getIdOrden() {
        return $this->idOrden;
    }

    public function setIdOrden($idOrden) {
        $this->idOrden = $idOrden;
    }

    // Getter and Setter for codigo
    public function getCodigo() {
        return $this->codigo;
    }

    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    // Getter and Setter for idProducto
    public function getIdProducto() {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    // Getter and Setter for cantidad
    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    // Getter and Setter for fecha
    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    // Getter and Setter for total
    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    // Getter and Setter for comentario
    public function getComentario() {
        return $this->comentario;
    }

    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    // Getter and Setter for estado
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    // Getter and Setter for producto
    public function getProducto() {
        return $this->producto;
    }

    public function setProducto($producto) {
        $this->producto = $producto;
    }
}
?>