<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="shortcut icon" href="<?php echo constant('URL') ?>public/imagenes/icono.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/styleAdmin.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/normalize.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/estilosAdmin.css">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="hero2">
        <nav class="nav">
            <br>
            <div>
                <br>
                <img src="<?php echo constant('URL') ?>public/imagenes/logo.png" width="175px" height="155px" style="margin-left: 40px;">  
            </div>
        </nav>
        <section class="hero__container container">
            <br><br><br>
            <div class="container">
                <div class="jumbotron">
                    <form action="<?php echo constant("URL")?>Login/login" method="post">
                        <div class="form-group">
                            <h1 class="display-4 text-center">Inicio de Sesión</h1>
                            <br>
                            <input type="text" placeholder="Ingrese su código" class="form-control" name="codigo">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Ingrese su contraseña" class="form-control" name="contra">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-light btn-block mb-2">Iniciar Sesión</button>
                            <!--<button type="submit" class="btn btn-outline-danger btn-block">Olvide mi contraseña</button>-->
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </header>
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
</body>
</html>
