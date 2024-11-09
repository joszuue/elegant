<?php
session_start();
    class CategoriaController extends Controller{//extenderemos de controller para poder acceder a sus funciones
        public $view;
        public $model;
        private $nombreImg;

        function __construct(){
            parent::__construct();
            $this->loadModel('Cate');
        }
 
        function panelCategorias(){
            // Verificar si las variables de sesión están definidas y si el usuario tiene rol de "Admin"
            if (isset($_SESSION['codigo']) && $_SESSION['rol'] == "Admin") {
                $this->view->modalShow = true;
                $this->view->listaCategorias= $this->model->listaCategorias();//enviamos arreglos de objetos a las vistas
                $this->view->renderView('adminServices/categorias.php');
            } else {
                $this->view->renderView('error/Error403.php');
            }  
        }
        
        function agregarCategoria() {
            $nombre = $_POST["nombre"];
            // Invocar el método del modelo
            if($this->model->agregarCategoria($nombre)){
                $this->view->modalClass= "bg-success";
                $this->view->mensaje = "¡La categoria " . $nombre ." se ha añadido con éxito!";
            }else{
                $this->view->modalClass= "bg-danger";
                $this->view->mensaje = "¡Ha ocurrido un error al añadir la categoria!";
            }
            $this->panelCategorias();
        }

        function categoria(){
            $this->view->nombre = $_POST["nombre"];
            $this->view->id = $_POST["id"];
            $this->view->renderView('adminServices/updateCategorias.php'); 
        }

        function modificarCategoria() {
            $nombre = $_POST["nombre"];
            $id = $_POST["id"];
            // Invocar el método del modelo
            if($this->model->modificarCategoria($nombre, $id)){
                $this->view->modalClass= "bg-success";
                $this->view->mensaje = "¡La categoria " . $nombre ." se ha modificado con éxito!";
            }else{
                $this->view->modalClass= "bg-danger";
                $this->view->mensaje = "¡Ha ocurrido un error al modificar la categoria!";
            }
            $this->panelCategorias();
        }

        function eliminarCategoria(){
            if($this->model->eliminarCategoria($_POST["id"])){
                $this->view->modalClass= "bg-success";
                $this->view->mensaje = "¡La categoria " . $_POST["nombre"] ." se ha eliminado con éxito!";
            }else{
                $this->view->modalClass= "bg-danger";
                $this->view->mensaje = "¡Ha ocurrido un error al eliminar la categoria!";
            }
            $this->panelCategorias();
        }
    }
?>
