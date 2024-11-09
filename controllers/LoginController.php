<?php
session_start();
    class LoginController extends Controller{//extenderemos de controller para poder acceder a sus funciones
        public $view;
        public $model;
        
        function __construct(){
            parent::__construct();
            $this->loadModel('Usu');
        }
        
        function panelAdmin() {
            $this->view->modalShow = true;
        
            // Verificar si las variables de sesión están definidas y si el usuario tiene rol de "Admin"
            if (isset($_SESSION['codigo']) && $_SESSION['rol'] == "Admin") {
                $this->view->renderView('adminServices/panelAdmin.php');
            } else {
                $this->view->renderView('error/Error403.php');
            }
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

        function loginServices(){
            $this->view->modalShow = true;
            $this->view->renderView('adminServices/login.php');
        }

        function login() {
            // Validar si las variables POST están definidas
            if (isset($_POST["codigo"]) && isset($_POST["contra"])) {
                $codigo = $_POST["codigo"];
                $pass = $_POST["contra"];
        
                // Obtener la contraseña de la base de datos
                $contraBdd = $this->model->findPass($codigo);
        
                if ($contraBdd !== null && password_verify($pass, $contraBdd)) {
                    $usu = $this->model->findUser($codigo, $contraBdd);
        
                    if ($usu !== null) {
                        $_SESSION['codigo'] = $usu->getCodigo();
                        $_SESSION['nombre1'] = $usu->getNombre1();
                        $_SESSION['nombre2'] = $usu->getNombre2();
                        $_SESSION['apellido1'] = $usu->getApellido1();
                        $_SESSION['apellido2'] = $usu->getApellido2();
                        $_SESSION['correo'] = $usu->getCorreo();
                        $_SESSION['rol'] = $usu->getRol();

                        switch($usu->getRol()){
                            case "Admin":
                                $this->panelAdmin();
                                break;
                            case "superAdmin":
                                $this->panelSuperAdmin();
                                break;  
                            default:
                                $this->view->modalClass = "bg-danger";
                                $this->view->mensaje = "Rol desconocido.";
                                $this->loginServices();
                                break;
                        }
                        return;
                    } else {
                        $this->view->modalClass = "bg-danger";
                        $this->view->mensaje = "Usuario o contraseña inválido.";
                        
                    }
                } else {
                    $this->view->modalClass = "bg-danger";
                    $this->view->mensaje = "Usuario o contraseña inválido.";
                    
                }
            } else {
                $this->view->modalClass = "bg-danger";
                $this->view->mensaje = "Datos de inicio de sesión no proporcionados.";
                
            }
            $this->loginServices();
        }

        function logOut(){

            // Eliminar todas las variables de sesión
            $_SESSION = array();

            // Destruir la cookie de sesión si es necesario
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            // Destruir la sesión
            session_destroy();

            $this->loginServices();
        }
        
    }
?>
