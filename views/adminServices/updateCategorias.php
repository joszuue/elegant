<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sweet Girl | Administrador</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="shortcut icon" href="<?php echo constant('URL') ?>public/imagenes/logoSweetGirl.png" type="image/x-icon">
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
              <img src="<?php echo constant('URL') ?>public/imagenes/letraSweetGirl.png" width="145px" height="125px" style="margin-left: 60%;">
            </div>

            <ul class="nav__link nav__link--menu">
                <li class="nav__items">
                    <a href="<?php echo constant('URL') ?>Login/panelAdmin" class="nav__links">Inicio</a>
                </li>
                <li class="nav__items">
                    <a href="<?php echo constant('URL') ?>Categoria/panelCategorias" class="nav__links">Regresar</a>
                </li>
                <img src="<?php echo constant('URL') ?>public/imagenes/close.svg" class="nav__close">
            </ul>

            <div class="nav__menu">
                <img src="<?php echo constant('URL') ?>public/imagenes/menu.svg" class="nav__img">
            </div>
        </nav>

    </header>
<main>
    <div class="container">
        <br><br>
        <section class="price container">
            <div class="jumbotron">
                <h1 class="text-center titulo">Modificar Categoria</h1>
                <hr class="my-4" style="background-color: white;">
                <form class="needs-validation" id="formCate" novalidate role="form" action="<?php echo constant("URL")?>Categoria/modificarCategoria" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="inputAddress" class="col-sm-2 col-form-label">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $this->id; ?>">
                            <input type="text" class="form-control" id="inputAddress" placeholder="Digite el nombre de la categoria." required name="nombre" value="<?php echo $this->nombre; ?>">
                            <div class="invalid-feedback">El nombre de la categoria no puede quedar vacío.</div>
                        </div>
                    </div>  
                    <button type="submit" class="btn btn-outline-light" id="boton">Modificar Categoria</button>
                </form>
            </div>
        </section>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-white" id="modalHeader">
                        <p class="modal-title"><?php echo $this->mensaje;?></p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        // Variable PHP pasada a JavaScript
        var modalClass = <?php echo json_encode($this->modalClass); ?>;
        var modalShow = <?php echo json_encode($this->modalShow); ?>;

        if(modalShow){
            // Cambiar la clase del encabezado del modal
            $('#modalHeader').addClass(modalClass);
            $('#myModal').modal('show');
        }
    });
</script>
    <script src="<?php echo constant('URL') ?>public/js/menu.js"></script>
    <script src="<?php echo constant('URL') ?>public/js/validaciones.js"></script>
</body>
</html>
