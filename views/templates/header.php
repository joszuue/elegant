<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ELEGANT - Tienda de Relojes en El Salvador</title>
<meta name="description" content="Nos enorgullece ofrecer una amplia selección de relojes de calidad en El Salvador. Encuentra relojes en línea con envío rápido y seguro en ELEGANT503SV.">
<meta name="keywords" content="El Salvador, Relojes en el Salvador, tienda de relojes, relojes en linea, sv, 503, venta de relojes en el salvador, ELEGANT503SV">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo constant('URL') ?>public/imagenes/icono.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/normalize.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/estilos.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/carrito.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/nav.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/modal.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/formulario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<style>
  .hidden-element {
    display: none; /* Oculta el elemento por defecto */
  }

  .oculto:hover .hidden-element {
    display: block; /* Muestra el elemento al hacer hover sobre el contenedor */
    position: fixed;
    background-color: rgba(0, 0, 0, 0.7);
  }
</style>
    <header class="hero">
        <nav class="nav container">
            <br>
            <div>
                <br>
                <a href="<?php echo constant('URL') ?>Tienda_Online/inicio" >
                    <img src="<?php echo constant('URL') ?>public/imagenes/logo.png" width="175px" height="155px">  
                </a>
            </div>

            <ul class="nav__link nav__link--menu">
                <li class="nav__items">
                    <a href="<?php echo constant('URL') ?>Tienda_Online/inicio" class="nav__links">Inicio</a>
                </li>
                <li class="nav__items">
                    <a href="<?php echo constant('URL') ?>Tienda_Online/variedadProductos" class="nav__links">Productos</a>
                </li>
                <li class="nav__items oculto">
                    <a href="#" class="nav__links">Categorías</a>
                    <div class="hidden-element">
                        <ul>
                            <?php
                                foreach ($this->listaCategorias as $listaC) {
                                ?>
                                <br>
                                <li class="nav__items"><a href="<?php echo constant('URL') ?>Tienda_Online/categoria?id=<?php echo $listaC->getIdCategoria(); ?>&nombre=<?php echo $listaC->getNombre(); ?>" class="nav__links"><?php echo $listaC->getNombre(); ?> </a></li>
                                <?php
                                }
                            ?>
                        </ul>
                    </div>
                </li>
                <li class="nav__items">
                    <?php if(isset($_SESSION['nombre1'])){ ?>
                        <a href="<?php echo constant('URL') ?>Tienda_Online/logOut" class="nav__links">Cerrar Sesión</a>
                    <?php }else{ ?>
                        <label for="modal-toggle-1" class="nav__links">Inciar Sesión</label>
                        <input type="checkbox" id="modal-toggle-1" class="modal-toggle">
                    <?php } ?>
                    <div class="modal" id="modal-1">
                        <div class="modal-content">
                            <label for="modal-toggle-1" class="close">&times;</label>
                            <center>
                                <h2 class="subtitle">Iniciar Sesión</h2>
                                <img src="<?php echo constant('URL') ?>public/imagenes/logoNegro.png" width="175px" height="155px">
                            </center>
                            <br>
                            <form action="<?php echo constant('URL') ?>Tienda_Online/login" method="POST">
                                <div class="form-group">
                                    <label for="email">Correo Electrónico:</label>
                                    <input type="email" id="email" name="correo" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña:</label>
                                    <input type="password" id="password" name="contra" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit">Iniciar Sesión</button>
                                </div>
                            </form>
                            <center>
                                <p>¿No tienes una cuenta? <a href="<?php echo constant('URL') ?>Tienda_Online/registro">Regístrate</a></p>
                            </center>
                            
                        </div>
                    </div>
                </li>

                <img src="<?php echo constant('URL') ?>public/imagenes/close.svg" class="nav__close">
            </ul>

            <li class="nav__items" style="margin-left: 65px;">
                <input type="checkbox" id="toggle" class="toggle-checkbox">
                <label for="toggle" class="toggle-label"><?php echo !empty($this->listaCarro) ? count($this->listaCarro) : ''; ?> <i class="fa-solid fa-cart-shopping" style="font-size: 1.5em;"></i></label>
                <div class="slide-panel" style="color: black; overflow-y: auto;">
                    <label for="toggle" class="close-btn">&times;</label>
                    <div class="panel-content">
                        <br>
                        <h2>Carrito de Compras</h2>
                        <br>
                        <?php if(!isset($_SESSION['nombre1'])){ ?>
                            <p>Debes de iniciar sesión o <a href="<?php echo constant('URL') ?>Tienda_Online/registro">crear una cuenta</a> para agregar elementos a tu carrito de compras.</p>
                        <?php }else{ 
                                if($this->listaCarro == null){
                                    echo "<p>Aquí puedes agregar los elementos de tu carrito.</p>";      
                                }else{
                                    $contador = 0;
                                foreach ($this->listaCarro as $listaCa) { $contador = $contador + $listaCa->getCantidad() * $listaCa->getTotal();?>
                                <img src="<?php echo constant('URL') ?>public/imgProductos/<?php echo $listaCa->getProducto()->getImagen(); ?>" width="125px" height="135px">
                                <h4><?php echo $listaCa->getProducto()->getNombre(); ?></h4>
                                <p><?php echo $listaCa->getProducto()->getDescripcion(); ?></p>
                                <p><b>Cantidad: </b><?php echo $listaCa->getCantidad(); ?></p>
                                <p><b>Precio unitario: </b>$<?php echo $listaCa->getTotal(); ?></p>
                                <p><b>Subtotal: </b>$<?php echo $listaCa->getCantidad() * $listaCa->getTotal(); ?></p>
                                <form action="<?php echo constant('URL') ?>Tienda_Online/eliminarCarrito" method="post">
                                    <input type="hidden" name="id" value="<?php echo $listaCa->getIdOrden()?>">
                                    <input type="hidden" name="nombre" value="<?php echo $_SESSION['nombre1'] . " " . $_SESSION['apellido1']?>">
                                    <input type="hidden" name="codigo" value="<?php echo $_SESSION['codigo']?>">
                                    <button type="submit" class="button cta" style="background-color: #E74C3C;"><i class="fas fa-trash-alt"></i></button>
                                </form>
                                <br>
                                <hr style="border: 1px solid #5B3921;">
                                <br>
                        <?php
                        }
                        echo "<h2>Total: $" .  $contador."</h2>";
                        ?>
                        <br><br>
                        <a href="<?php echo constant('URL')?>Tienda_Online/enviarMensaje" class="button cta"><center>Realizar Pedido <i class="fas fa-envelope" style="font-size: 1.5em;"></i></center></a>
                        <?php
                            }
                         } ?>
                    </div>
                    
                </div>
            </li>
            <div class="nav__menu" style="align-items: center;">
                <img src="<?php echo constant('URL') ?>public/imagenes/menu.svg" class="nav__img">
            </div>
        </nav>
        <?php if($this->mensaje != ""){?>
        <div id="myModalError " class="modalError ">
            <!-- Contenido del modal -->
            <div class="modalError-content">
                <span class="closeError">&times;</span>
                <p><?php echo $this->mensaje; ?></p>
            </div>
        </div>
        <?php }?>
        <script>
            // Obtener el modal
            var mensaje = <?php echo json_encode($this->mensaje); ?>;
            var modal = document.getElementById("myModalError ");

            
            // Obtener el <span> que cierra el modal
            var span = document.getElementsByClassName("closeError ")[0];

            // Cuando el usuario haga clic en <span> (x), cierra el modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // Cuando el usuario haga clic en cualquier lugar fuera del modal, ciérralo
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            
        </script>
