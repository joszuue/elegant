<!DOCTYPE html>
<?php require "views/templates/menuAdmin.php";?>
<main>
    <div class="container">
        <br>
        <section class="price container">
            <div class="jumbotron">
                <h1 class="text-center titulo">Gestión de Categorias</h1>
                <hr class="my-4" style="background-color: white;">
                <form class="needs-validation" id="formCate" novalidate role="form" action="<?php echo constant("URL")?>Categoria/agregarCategoria" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="inputAddress" class="col-sm-2 col-form-label">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="id" name="id">
                            <input type="text" class="form-control" id="inputAddress" placeholder="Digite el nombre de la categoria." required name="nombre" >

                            <div class="invalid-feedback">El nombre de la categoria no puede quedar vacío.</div>
                        </div>
                    </div>         
                    <button type="submit" class="btn btn-outline-light" id="boton">Agregar Categoria</button>
                </form>
                <br><br>
                <div class="table-container">
                    <table class="table table-sm">
                        <thead>
                            <tr> 
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $cont = 1;
                                foreach ($this->listaCategorias as $lista) {
                                ?>
                                <tr>
                                    <td><?php echo $cont++; ?></td>
                                    <td><?php echo $lista->getNombre(); ?></td>
                                    <td>
                                        <button type="button" style="background:none; border:none; color:inherit; padding:0; font:inherit; cursor:pointer;" data-toggle="modal" data-target="#exampleModal<?php echo $lista->getIdCategoria(); ?>">
                                            <i class="fa-solid fa-trash icon mr-2"></i>
                                        </button>
                                        <div class="modal fade text-dark" id="exampleModal<?php echo $lista->getIdCategoria(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Eliminar Categoria</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" action="<?php echo constant("URL")?>Categoria/eliminarCategoria" style="display:inline;">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="<?php echo $lista->getIdCategoria(); ?>">
                                                    <input type="hidden" name="nombre" value="<?php echo $lista->getNombre(); ?>">
                                                    <p>¿Realmente deseas eliminar la categoria '<?php echo $lista->getNombre(); ?>'?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                                </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="POST" action="<?php echo constant("URL")?>Categoria/categoria" style="display:inline;">
                                            <input type="hidden" name="id" value="<?php echo $lista->getIdCategoria(); ?>">
                                            <input type="hidden" name="nombre" value="<?php echo $lista->getNombre(); ?>">
                                            <button type="submit" style="background:none; border:none; color:inherit; padding:0; font:inherit; cursor:pointer;">
                                                <i class="fas fa-edit icon mr-2"></i>
                                            </button>
                                        </form>
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
