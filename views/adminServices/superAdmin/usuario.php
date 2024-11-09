<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ELEGANT | Super Administrador</title>

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
<header class="hero2">
        <nav class="nav container">
            <div>
                <br>
                <img src="<?php echo constant('URL') ?>public/imagenes/logo.png" width="175px" height="155px">  
            </div>
            <ul class="nav__link nav__link--menu">
                <li class="nav__items">
                    <p class="nav__links">Super Admin: <b><?php echo $_SESSION['nombre1'] . " ". $_SESSION['apellido1'];?></b></p>
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
<main>
    <div class="container">
        <br>
        <section class="price container">
            <div class="jumbotron">
                <h1 class="text-center titulo">Gestión de Usuarios</h1>
                <hr class="my-4" style="background-color: white;">
                <form class="needs-validation " id="formCate" novalidate role="form" action="<?php echo constant("URL")?>Usuario/agregarUsuario" method="POST">
                    <div class="form-group text-left">
                        <label for="nombre1">Primer Nombre:</label>
                        <input type="text" class="form-control" id="nombre1" placeholder="Primer nombre" name="nombre1" required>
                        <div class="invalid-feedback">El primer nombre no puede quedar vacío.</div>
                    </div>
                    <div class="form-group text-left">
                        <label for="nombre2">Segundo Nombre:</label>
                        <input type="text" class="form-control" id="nombre2" name="nombre2" placeholder="Segundo nombre" required>
                        <div class="invalid-feedback">El segundo nombre no puede quedar vacío.</div>
                    </div>
                    <div class="form-group text-left">
                        <label for="apellido1">Primer Apellido:</label>
                        <input type="text" class="form-control" id="apellido1" name="apellido1" placeholder="Primer apellido" required>
                        <div class="invalid-feedback">El primer apellido no puede quedar vacío.</div>
                    </div>
                    <div class="form-group text-left">
                        <label for="apellido2">Segundo Apellido:</label>
                        <input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Segundo apellido" required>
                        <div class="invalid-feedback">El segundo apellido no puede quedar vacío.</div>
                    </div>
                    <div class="form-group text-left">
                        <label for="correo">Correo:</label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required>
                        <div class="invalid-feedback">El correo no puede quedar vacío.</div>
                    </div>
                    <div class="form-group text-left">
                        <label for="contra1">Contraseña:</label>
                        <input type="password" class="form-control" id="contra1" name="contra" placeholder="Contraseña" required>
                        <div class="invalid-feedback">La contraseña no puede quedar vacía.</div>
                    </div>
                    <button type="submit" class="btn btn-outline-light" id="boton">Agregar Usuario</button>
                </form>
                <br><br>
                <div class="table-container">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Código</th>
                            <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $cont = 1;
                                foreach ($this->listaUsuarios as $lista) {
                                ?>
                                <tr>
                                    <td><?php echo $cont++; ?></td>
                                    <td><?php echo $lista->getNombre1() . " " . $lista->getApellido1(); ?></td>
                                    <td><?php echo $lista->getRol();?></td>
                                    <td><?php echo $lista->getCodigo();?></td>
                                    <td>
                                        <button type="button" style="background:none; border:none; color:inherit; padding:0; font:inherit; cursor:pointer;" data-toggle="modal" data-target="#exampleModal<?php echo $lista->getCodigo(); ?>">
                                            <i class="fa-solid fa-trash icon mr-2"></i>
                                        </button>
                                        <div class="modal fade text-dark" id="exampleModal<?php echo $lista->getCodigo(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Eliminar Usuario</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="<?php echo constant("URL")?>Usuario/eliminarUsuario" style="display:inline;">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="<?php echo $lista->getCodigo(); ?>">
                                                    <input type="hidden" name="nombre" value="<?php echo $lista->getNombre1(); ?>">
                                                    <p>¿Realmente deseas eliminar al usuario '<?php echo $lista->getNombre1() . " " . $lista->getNombre2() . " " .$lista->getApellido1() ." ". $lista->getApellido2() ; ?>'?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                                </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
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
