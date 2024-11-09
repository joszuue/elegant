<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ELEGANT | Administrador</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="<?php echo constant('URL') ?>public/imagenes/icono.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/normalize.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/estilosAdmin.css">
</head>
<body>
    <header class="hero2">
        <nav class="nav container">
            <div>
                <br>
                <img src="<?php echo constant('URL') ?>public/imagenes/logo.png" width="175px" height="155px"">  
            </div>
            <ul class="nav__link nav__link--menu">
                <li class="nav__items">
                    <a href="#" class="nav__links">Inicio</a>
                </li>
                <li class="nav__items">
                    <a href="<?php echo constant('URL') ?>Producto/panelProductos" class="nav__links">Productos</a>
                </li>
                <li class="nav__items">
                    <a href="<?php echo constant('URL') ?>Categoria/panelCategorias" class="nav__links">Categorias</a>
                </li>
                <li class="nav__items">
                    <a href="<?php echo constant('URL') ?>Login/logOut" class="nav__links">Cerrar Sesión</a>
                </li>
                <img src="<?php echo constant('URL') ?>public/imagenes/close.svg" class="nav__close">
            </ul>

            <div class="nav__menu">
                <img src="<?php echo constant('URL') ?>public/imagenes/menu.svg" class="nav__img">
            </div>
        </nav>
        <section class="hero__container container">
            <h1 class="hero__title">!Hola, <?php echo $_SESSION['nombre1'] . " ". $_SESSION['apellido1'];?>!</h1>
            <p class="hero__paragraph">¡Bienvenid@ al panel de administración de ELEGANT! 
            Aquí podrás gestionar productos, gestionar el categorias y realizar muchas otras funciones.</p>
            
        </section>
    </header>
    <script src="<?php echo constant('URL') ?>public/js/menu.js"></script>
</body>

</html>