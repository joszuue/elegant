<?php
session_start();
    class ProductoController extends Controller{//extenderemos de controller para poder acceder a sus funciones
        public $view;
        public $model;
        private $nombreImg;

        function __construct(){
            parent::__construct();
            $this->loadModel('Produc');
        }
 
        function panelProductos(){
        
            // Verificar si las variables de sesión están definidas y si el usuario tiene rol de "Admin"
            if (isset($_SESSION['codigo']) && $_SESSION['rol'] == "Admin") {
                $this->view->modalShow = true;
                $this->view->listaProductos= $this->model->listaProductos();//enviamos arreglos de objetos a las vistas
                $this->view->listaCategorias= $this->model->listaCategorias();
                $this->view->listaOcultos= $this->model->listaProductosOcultos();
                $this->view->renderView('adminServices/productos.php');
            } else {
                $this->view->renderView('error/Error403.php');
            }
        }
        
        function agregarProducto() {
            if($this->guardarImagen()){
                $nombre = $_POST["nombre"];
                $categoria = $_POST["categoria"];
                $descri = $_POST["descri"];
                $precio = $_POST["precio"];
                $gender = $_POST['gender'];
                $estado = $_POST['estado'];
                 // Invocar el método del modelo
                if($this->model->agregarProductos($nombre, $categoria, $descri, $precio,  $this->nombreImg, $gender, $estado)){
                    $this->view->modalClass= "bg-success";
                    $this->view->mensaje = "¡El producto " . $nombre ." se ha añadido con éxito!";
                }else{
                    $this->view->modalClass= "bg-danger";
                    $this->view->mensaje = "¡Ha ocurrido un error al añadir el producto.!";
                }
            }else{
                $this->view->modalClass= "bg-danger";
                $this->view->mensaje = "¡El formato de la imagen es incorrecto, los formatos permitidos son JPG y PNG.!";
            }
            $this->panelProductos();
        }

        function modificarProducto() {
            $nombre = $_POST["nombre"];
            $categoria = $_POST["categoria"];
            $descri = $_POST["descri"];
            $precio = $_POST["precio"];
            $gender = $_POST['gender'];
            $estado = $_POST['estado'];
            $id = $_POST['id'];

            // Invocar el método del modelo
            if($this->model->modificarProductos($nombre, $categoria, $descri, $precio,  $gender, $estado, $id)){
                $this->view->modalClass= "bg-success";
                $this->view->mensaje = "¡El producto " . $nombre ." se ha modificado con éxito!";
            }else{
                $this->view->modalClass= "bg-danger";
                $this->view->mensaje = "¡Ha ocurrido un error al modificar el producto.!";
            }
            $this->panelProductos();
        }

        function eliminarProducto(){
            $this->eliminarImagen();
            if($this->model->eliminarProducto($_POST["id"])){
                $this->view->modalClass= "bg-success";
                $this->view->mensaje = "¡El producto " . $_POST["nombre"] ." se ha eliminado con éxito!";
            }else{
                $this->view->modalClass= "bg-danger";
                $this->view->mensaje = "¡Ha ocurrido un error al eliminar el producto.!";
            }
            $this->panelProductos();
        }
 
        function guardarImagen(){
            // Inicio de validación de archivos tipo imagenes
            $imagen  = $_FILES["imagen"]["name"]; // Extrae el nombre de la imagen
        
            // Verifica si la imagen fue subida correctamente
            if (!empty($imagen) && isset($_FILES['imagen']['tmp_name'])) {
                $extension = explode(".", $imagen); // Separa el nombre y la extensión
                $exte = strtolower(end($extension)); // Obtiene la extensión en minúsculas
        
                // Validar si la extensión es permitida
                if ($exte == "jpg" || $exte == "png") {
                    $this->nombreImg = mt_rand(1, 10000).".".$exte;
                    $ruta = $_FILES['imagen']['tmp_name'];
        
                    // Verifica si el archivo temporal existe
                    if (!empty($ruta) && file_exists($ruta)) {
                        // Obtener el directorio raíz de la aplicación
                        $rootDir = realpath(__DIR__ . '/..'); // Ajusta según la estructura de tus carpetas
                        $destino = $rootDir . "/public/imgProductos/" . $this->nombreImg;
        
                        // Copia la imagen al destino
                        if (copy($ruta, $destino)) {
                            return true; // La imagen fue guardada exitosamente
                        } else {
                            echo "Error: No se pudo copiar el archivo.";
                            return false;
                        }
                    } else {
                        echo "Error: El archivo temporal no existe.";
                        return false;
                    }
                } else {
                    echo "Error: Formato de imagen no permitido. Solo se aceptan JPG y PNG.";
                    return false;
                }
            } else {
                echo "Error: No se ha seleccionado ningún archivo.";
                return false;
            }
        }
        

        function eliminarImagen(){
            $currentDir = dirname(__FILE__);

            // Encontrar el directorio raíz de la aplicación
            $rootDir = realpath(__DIR__ . '/..'); // ajusta según la estructura de tus carpetas

            $relativePath = $rootDir . "/" . $_POST["imagen"];
            $absolutePath = realpath($relativePath);

            if ($absolutePath === false) {
                
            } else {
                // Verifica si el archivo existe
                if (file_exists($absolutePath)) {
                    // Intenta eliminar el archivo
                    if (unlink($absolutePath)) {
                       
                    }
                }
            }
        }



    
    }
?>
