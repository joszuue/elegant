<?php
ob_start();
session_start();
    class Tienda_OnlineController extends Controller{//extenderemos de controller para poder acceder a sus funciones
        public $view;
        public $model;
        function __construct(){
            //$this->loadModel('Produc');
        }
 
        function principal(){
            parent::__construct();//llamamos el constructor de Controller, para poder acceder a la instancia de view
            $this->view->listaCategorias= $this->model->listaCategoriasMenu();
            $this->view->listaRand= $this->model->productosRand();
            $this->view->listaCates= $this->model->productosCate();
            $this->view->mensaje = "";
            $this->view->listaCarro = $this->mostrarCarro();
            $this->view->renderView('tienda_online/inicio.php');//llamando al metodo renderView para pintar la vista
        }

        function inicio(){
            parent::__construct();
            $this->loadModel('Produc');
            $this->view->listaCategorias= $this->model->listaCategoriasMenu();
            $this->view->listaRand= $this->model->productosRand();
            $this->view->listaCates= $this->model->productosCate();
            $this->view->mensaje = "";
            $this->view->listaCarro = $this->mostrarCarro();
            $this->view->renderView('tienda_online/inicio.php');//llamando al metodo renderView para pintar la vista
        }

        function catalogo(){
            parent::__construct();
            $this->loadModel('Produc');
            $this->view->listaCategorias= $this->model->listaCategoriasMenu();
            $this->view->mensaje = "";
            $this->view->listaCarro = $this->mostrarCarro();
            $this->view->renderView('tienda_online/catalogo.php');
        }

        function variedadProductos(){
            parent::__construct();
            $this->loadModel('Produc');
            $this->view->listaCategorias= $this->model->listaCategoriasMenu();
            $this->view->listaHombres= $this->model->listaHombres();
            $this->view->listaMujeres= $this->model->listaMujeres();
            $this->view->mensaje = "";
            $this->view->listaCarro = $this->mostrarCarro();
            $this->view->renderView('tienda_online/variedad.php');
        }

        function categoria(){
            parent::__construct();
            $this->loadModel('Produc');
            $this->view->listaCategorias= $this->model->listaCategoriasMenu();
            $this->view->listaHombresCate= $this->model->listaHombresCate($_GET["id"]);
            $this->view->listaMujeresCate= $this->model->listaMujeresCate($_GET["id"]);
            $this->view->nombre= $_GET["nombre"];
            $this->view->mensaje = "";
            $this->view->listaCarro = $this->mostrarCarro();
            $this->view->renderView('tienda_online/categoria.php');
        }

        function carrito(){
            parent::__construct();
            $this->loadModel('Produc');
            $cantidad = $_POST["cantidad"];
            $idProducto = $_POST["id"];
            $precio = $_POST["precio"];
            $codigo = $_POST["codigo"];
            date_default_timezone_set('America/El_Salvador');
            $fecha = new DateTime();
            $estado = "carrito";
            $this->model->agregarCarro($codigo,$idProducto,$cantidad,$fecha->format('Y-m-d H:i:s'), $precio, $estado);
            //$this->inicio();
            if(isset($_SERVER['HTTP_REFERER'])) {
                $this->view->mensaje = "";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                $this->inicio();
            }
            exit;
        }

        function mostrarCarro(){
            if (isset($_SESSION['codigo'])) {
                // Si el usuario ha iniciado sesión, obtener los datos del carrito
                $codigoUsuario = $_SESSION['codigo'];
                $listaCarro = $this->model->mostrarCarro($codigoUsuario);
            } else {
                // Si el usuario no ha iniciado sesión, el carrito es null
                $listaCarro = null;
            }
            return $listaCarro;
        }

        function enviarMensaje(){
            parent::__construct();
            $this->loadModel('Produc');
            $mensaje = "Hola! Estoy interesado en los siguientes productos:\n\n";
            $codigoUsuario = $_SESSION['codigo'];
            $listaCarro = $this->model->mostrarCarro($codigoUsuario);
            // Iterar sobre la lista de productos del carrito
            $cont = 0;
            $mensaje = "Cliente: " . $_SESSION['nombre1'] . " " . $_SESSION['apellido1'] . "\n";
            foreach ($listaCarro as $listaCa) {
                $cont = $cont + $listaCa->getCantidad() * $listaCa->getTotal();
                // Agregar cada producto al mensaje
                $mensaje .= "Nombre: " . $listaCa->getProducto()->getNombre() . "\n"; // Suponiendo que el nombre del producto está en la columna 'nombre'
                $mensaje .= "Descripción: " . $listaCa->getProducto()->getDescripcion() . "\n";
                $mensaje .= "Cantidad: " . $listaCa->getCantidad() . "\n";
                $mensaje .= "Precio Unitario: $" . $listaCa->getTotal() . "\n";
                $mensaje .= "Subtotal: $" . $listaCa->getCantidad() * $listaCa->getTotal() . "\n";
                $mensaje .= "-------------------------\n";
            }
            $mensaje .= "TOTAL: $" . $cont;
            // Codificar el mensaje para que sea una URL válida
            $mensajeCodificado = urlencode($mensaje);
        
            // Construir la URL con el mensaje codificado
            $url = "mailto:elegant.sv503@gmail.com?subject=Orden de Compra " . $_SESSION['nombre1'] . " " . $_SESSION['apellido1'] . "&body=$mensajeCodificado";
            //$url = "https://api.whatsapp.com/send?phone=71612691&text=$mensajeCodificado";
            $this->model->modificarCarro($codigoUsuario, "carrito");
            // Verificar si los encabezados ya se han enviado
            if (headers_sent($file, $line)) {
                echo "Headers already sent in $file on line $line";
                exit;
            }
            // Redirigir al usuario a la URL de WhatsApp
            header("Location: $url");
            exit();
        }

        function eliminarCarrito(){
            parent::__construct();
            $this->loadModel('Produc');
            $idOrden = $_POST["id"];
            $this->model->eliminarCarro($idOrden);
            //$this->inicio();
            if(isset($_SERVER['HTTP_REFERER'])) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                $this->inicio();
            }
            exit;
        }

        
        function registro(){
            parent::__construct();
            $this->loadModel('Produc');
            $this->view->listaCategorias= $this->model->listaCategoriasMenu();
            $this->view->mensaje = "";
            $this->view->listaCarro = $this->mostrarCarro();
            $this->view->renderView('tienda_online/registro.php');//llamando al metodo renderView para pintar la vista
        }

        function registroError($mensajee){
            parent::__construct();
            $this->loadModel('Produc');
            $this->view->listaCategorias= $this->model->listaCategoriasMenu();
            $this->view->mensaje = $mensajee;
            $this->view->listaCarro = $this->mostrarCarro();
            $this->view->renderView('tienda_online/registro.php');//llamando al metodo renderView para pintar la vista
        }

        /*function registrer(){
            parent::__construct();
            $this->loadModel('Usu');
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $correo = $_POST["email"];
            $contra = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $codigo = $this->generarCodigo($nombre, $apellido);
            $mensa = "";
            if($this->model->validarCorreo($correo) == false){
                if($this->model->agregarUser($codigo, $contra, $nombre, $apellido, $correo, "User")){
                    $usu = $this->model->findUserMarket($correo, $contra);
        
                    if ($usu !== null) {
                        $_SESSION['codigo'] = $usu->getCodigo();
                        $_SESSION['nombre1'] = $usu->getNombre1();
                        $_SESSION['apellido1'] = $usu->getApellido1();
                        $_SESSION['correo'] = $usu->getCorreo();
                        $_SESSION['rol'] = $usu->getRol();
                    }
                    $this->inicio();
                    return;
                }else{
                    $mensa = "¡Ha ocurrido un error al añadir al usuario!";
                }
            }else{
                $mensa = "¡El correo " . $correo ." ya se encuentra registrado, intenta con otro correo!";
            }
            $this->registroError($mensa);
        }*/

        function registrer() {
            parent::__construct();
            $this->loadModel('Usu');
        
            // Verificar si los campos están vacíos
            if(empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["email"]) || empty($_POST["password"])) {
                $mensa = "¡Por favor completa todos los campos!";
                $this->registroError($mensa);
                return;
            }
        
            // Continuar con el proceso de registro si no están vacíos
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $correo = $_POST["email"];
            $contra = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $codigo = $this->generarCodigo($nombre, $apellido);
            $mensa = "";
        
            if($this->model->validarCorreo($correo) == false) {
                if($this->model->agregarUser($codigo, $contra, $nombre, $apellido, $correo, "User")) {
                    $usu = $this->model->findUserMarket($correo, $contra);
        
                    if ($usu !== null) {
                        $_SESSION['codigo'] = $usu->getCodigo();
                        $_SESSION['nombre1'] = $usu->getNombre1();
                        $_SESSION['apellido1'] = $usu->getApellido1();
                        $_SESSION['correo'] = $usu->getCorreo();
                        $_SESSION['rol'] = $usu->getRol();
                    }
                    $this->inicio();
                    return;
                } else {
                    $mensa = "¡Ha ocurrido un error al añadir al usuario!";
                }
            } else {
                $mensa = "¡El correo " . $correo ." ya se encuentra registrado, intenta con otro correo!";
            }
        
            $this->registroError($mensa);
        }
        

        function inicioError($mensaje){
            parent::__construct();
            $this->loadModel('Produc');
            $this->view->listaCategorias= $this->model->listaCategoriasMenu();
            $this->view->listaRand= $this->model->productosRand();
            $this->view->listaCates= $this->model->productosCate();
            $this->view->mensaje = $mensaje;
            $this->view->listaCarro = $this->mostrarCarro();
            $this->view->renderView('tienda_online/inicio.php');//llamando al metodo renderView para pintar la vista
        }

        function login(){
            parent::__construct();
            $this->loadModel('Usu');
            $mensa = "";
            // Validar si las variables POST están definidas
            if (isset($_POST["correo"]) && isset($_POST["contra"])) {
                $correo = $_POST["correo"];
                $pass = $_POST["contra"];
        
                // Obtener la contraseña de la base de datos
                $contraBdd = $this->model->findPassUser($correo);
        
                if ($contraBdd !== null && password_verify($pass, $contraBdd)) {
                    $usu = $this->model->findUserMarket($correo, $contraBdd);
        
                    if ($usu !== null) {
                        // Iniciar sesión y guardar los datos del usuario en la sesión
                        $_SESSION['codigo'] = $usu->getCodigo();
                        $_SESSION['nombre1'] = $usu->getNombre1();
                        $_SESSION['apellido1'] = $usu->getApellido1();
                        $_SESSION['correo'] = $usu->getCorreo();
                        $_SESSION['rol'] = $usu->getRol();

                        $this->inicio();
                        return;
                    } else {
                        $mensa = "Usuario o contraseña inválido.";
                        
                    }
                } else {
                    $mensa = "Usuario o contraseña inválido.";
                    
                }
            } else {
                if(session_status() == PHP_SESSION_NONE){
                    $mensa = "Datos de inicio de sesión no proporcionados.";
                }
            }
            $this->inicioError($mensa);    
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

            $this->inicio();
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
    ob_end_flush();
?>
