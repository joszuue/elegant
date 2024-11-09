<?php
    class ErrorController extends Controller{
        public $view;
        function __construct(){
            parent::__construct();
            $this->view->mensaje= "Error al cargar la pagina o recurso";
            $this->view->renderView('error/Error.php');
        }
    }
?>