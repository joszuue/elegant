<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ELEGANT | Administrador</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="shortcut icon" href="<?php echo constant('URL') ?>public/imagenes/icono.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/normalize.css"> 
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/panelEstilo.css">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <header class="hero">
        <nav class="nav container">
            <br>
            <div>   
              <img src="<?php echo constant('URL') ?>public/imagenes/logo.png" width="175px" height="155px" style="margin-left: 60%;">
            </div>

            <ul class="nav__link nav__link--menu">
                <li class="nav__items">
                    <a href="<?php echo constant('URL') ?>Login/panelAdmin" class="nav__links">Inicio</a>
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

    </header>
   