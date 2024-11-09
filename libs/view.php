<?php
    class View{
        //Variables para la vista del administrador
        public $modalShow;
        public $listaProductos;
        public $listaCategorias;
        public $listaOcultos;
        public $modalClass;

        //Variables para la vista de la tienda en linea
        public $listaRand;
        public $listaCates;
        public $mensaje;
        public $listaCarro;

        //Variedad de productos
        public $listaHombres;
        public $listaMujeres;

        //Categorias
        public $listaHombresCate;
        public $listaMujeresCate;
        public $nombre;


    function __construct(){

    }
    function renderView($vista){//Notara que nunca hacemos un redirect puntual a una vista
        require 'views/' . $vista; // Entonces llamamos ese codigo y añadimos el recurso vista
    }
    }
?>
