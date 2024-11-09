<?php
session_start();
    class UsuarioController extends Controller{//extenderemos de controller para poder acceder a sus funciones
        public $view;
        public $model;
        function __construct(){
            parent::__construct();
            $this->loadModel('Usu');
        }

        function panelSuperAdmin(){
            $this->view->modalShow = true;
        
            // Verificar si las variables de sesión están definidas y si el usuario tiene rol de "Admin"
            if (isset($_SESSION['codigo']) && $_SESSION['rol'] == "superAdmin") {
                $this->view->listaUsuarios= $this->model->listaUsuario();
                $this->view->renderView('adminServices/superAdmin/usuario.php');
            } else {
                $this->view->renderView('error/Error403.php');
            }
             
        }
         
        function agregarUsuario() {
            $nombre1 = $_POST["nombre1"];
            $nombre2 = $_POST["nombre2"];
            $apellido1 = $_POST["apellido1"];
            $apellido2 = $_POST["apellido2"];
            $codigo = $this->generarCodigo($apellido1,$apellido2);
            $correo = $_POST["correo"];
            $contra = password_hash($_POST["contra"], PASSWORD_DEFAULT);
            // Invocar el método del modelo
            if($this->model->validarCorreo($correo) == null){
                if($this->model->agregarUsuario($codigo, $contra, $nombre1, $nombre2, $apellido1, $apellido2, $correo, "Admin")){
                    $this->view->modalClass= "bg-success";
                    $this->view->mensaje = "¡El usuario " . $nombre1 . " ". $apellido1 ." se ha añadido con éxito!";
                }else{
                    $this->view->modalClass= "bg-danger";
                    $this->view->mensaje = "¡Ha ocurrido un error al añadir al usuario!";
                }
            }else{
                $this->view->modalClass= "bg-danger";
                    $this->view->mensaje = "¡El correo " . $correo ." ya se encuentra registrado!";
            }
            
            $this->panelSuperAdmin();
        }


        function modificarUsuario() {
            $nombre = $_POST["nombre"];
            $id = $_POST["id"];
            // Invocar el método del modelo
            if($this->model->modificarUsuario($nombre, $id)){
                $this->view->modalClass= "bg-success";
                $this->view->mensaje = "¡El usuario " . $nombre ." se ha modificado con éxito!";
            }else{
                $this->view->modalClass= "bg-danger";
                $this->view->mensaje = "¡Ha ocurrido un error al modificar el usuario!";
            }
            $this->panelSuperAdmin();
        }

        function eliminarUsuario(){
            if($this->model->eliminarUsuario($_POST["id"])){
                $this->view->modalClass= "bg-success";
                $this->view->mensaje = "¡El usuario " . $_POST["nombre"] ." se ha eliminado con éxito!";
            }else{
                $this->view->modalClass= "bg-danger";
                $this->view->mensaje = "¡Ha ocurrido un error al eliminar el usuario!";
            }
            $this->panelSuperAdmin();
        }

        function generarCodigo($palabra1, $palabra2) {
            // Extraer la primera letra de cada palabra
            $letra1 = strtoupper($palabra1[0]);
            $letra2 = strtoupper($palabra2[0]);
            
            // Generar cuatro números aleatorios
            $numerosAleatorios = rand(1000, 9999);
            
            // Concatenar las letras y los números
            $codigo = $letra1 . $letra2 . $numerosAleatorios;
            
            return $codigo;
        } 
    }
?>
