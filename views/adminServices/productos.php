<!DOCTYPE html>
<?php require "views/templates/menuAdmin.php";?>
<main>
    <div class="container">
        <br><br>
        <section class="price container">
            <div class="">
                <div class="jumbotron">
                    <h1 class="text-center titulo">Gestión de Productos</h1>
                    <hr class="my-4" style="background-color: white;">
                    <div class="text-right">
                        <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#exampleModalLong">Agregar producto</button>
                    </div>
                    <br><br>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Disponibles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ocultos</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-container">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $cont = 1;
                                        foreach ($this->listaProductos as $lista) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cont++; ?></td>
                                            <td><?php echo $lista->getNombre(); ?></td>
                                            <td><?php echo $lista->getNombreCategoria(); ?></td>
                                            <td>
                                                <div class="modal fade text-dark" id="exampleModal<?php echo $lista->getIdProducto(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Eliminar Producto</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="<?php echo constant("URL")?>Producto/eliminarProducto" style="display:inline;">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?php echo $lista->getIdProducto(); ?>">
                                                            <input type="hidden" name="nombre" value="<?php echo $lista->getNombre(); ?>">
                                                            <input type="hidden" name="imagen" value="<?php echo "public/imgProductos/" . $lista->getImagen()?>">
                                                            <p>¿Realmente deseas eliminar el producto '<?php echo $lista->getNombre(); ?>'?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                                        </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" style="background:none; border:none; color:inherit; padding:0; font:inherit; cursor:pointer;" data-toggle="modal" data-target="#exampleModal<?php echo $lista->getIdProducto(); ?>">
                                                    <i class="fa-solid fa-trash icon mr-2"></i>
                                                </button>
                                                <button type="button" style="background:none; border:none; color:inherit; padding:0; font:inherit; cursor:pointer;" data-toggle="modal" data-target="#editar<?php echo $lista->getIdProducto(); ?>">
                                                    <i class="fas fa-edit icon mr-2"></i>
                                                </button>
                                                <button type="button" style="background:none; border:none; color:inherit; padding:0; font:inherit; cursor:pointer;" data-toggle="modal" data-target="#mostrar<?php echo $lista->getIdProducto(); ?>">
                                                <i class="fa-solid fa-eye icon"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade text-dark text-left" id="editar<?php echo $lista->getIdProducto(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modificar Producto</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="needs-validation" novalidate role="form" action="<?php echo constant("URL")?>Producto/modificarProducto" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="inputAddress">Nombre:</label>
                                                                <input type="hidden" value="<?php echo $lista->getIdProducto(); ?>" name="id">
                                                                <input type="text" class="form-control" placeholder="Digite el nombre del producto." required name="nombre" value="<?php echo $lista->getNombre(); ?>">
                                                                <div class="invalid-feedback">El nombre del producto no puede quedar vacío.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress">Categoria:</label>
                                                                <select class="custom-select" id="validationCustom04" required name="categoria">
                                                                    
                                                                    <?php
                                                                    foreach ($this->listaCategorias as $listaC) {
                                                                    ?>
                                                                    <option value="<?php echo $listaC->getIdCategoria(); ?>" <?php echo ($lista->getIdCategoria() == $listaC->getIdCategoria()) ? 'selected' : ''; ?>><?php echo $listaC->getNombre(); ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <div class="invalid-feedback">Debe de seleccionar una categoria para este producto.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress">Descripción:</label>
                                                                <textarea class="form-control" id="validationTextarea" placeholder="Descripción del producto." required name="descri"><?php echo $lista->getDescripcion(); ?></textarea>
                                                                <div class="invalid-feedback">Debe de digitar una descripción para este producto.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress">Precio:</label>
                                                                <input type="number" class="form-control" step="0.01" min="0" placeholder="Digite el precio del producto." required pattern="^\d+(\.\d{1,2})?$" name="precio" value="<?php echo $lista->getPrecio(); ?>">
                                                                <div class="invalid-feedback">El precio del producto no puede quedar vacío.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress">Estado:</label>
                                                                <select class="custom-select" id="validationCustom04" required name="estado">
                                                                    <option value="Mostrar" selected>Mostrar</option>
                                                                    <option value="Ocultar" >Ocultar</option>
                                                                </select>
                                                                <div class="invalid-feedback">Debe de seleccionar una categoria para este producto.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress">El producto es para:</label>
                                                                <br>
                                                                <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                    <input type="radio" id="customRadioInline1" name="gender" value="Hombre" class="custom-control-input" required <?php echo ($lista->getSexo() == 'Hombre') ? 'checked' : ''; ?>>
                                                                    <label class="custom-control-label" for="customRadioInline1">Hombre</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                    <input type="radio" id="customRadioInline2" name="gender" value="Mujer" class="custom-control-input" required <?php echo ($lista->getSexo() == 'Mujer') ? 'checked' : ''; ?>>
                                                                    <label class="custom-control-label" for="customRadioInline2">Mujer</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="customRadioInline3" name="gender" value="Unisex" class="custom-control-input" required <?php echo ($lista->getSexo() == 'Unisex') ? 'checked' : ''; ?>>
                                                                    <label class="custom-control-label" for="customRadioInline3">Unisex</label>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Modificar Producto</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade text-dark text-left" id="mostrar<?php echo $lista->getIdProducto(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Destalle de <?php echo $lista->getNombre(); ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <center>
                                                        <img src="<?php echo constant("URL") . "public/imgProductos/" . $lista->getImagen()?>" width="200px" height="200px">
                                                        </center>
                                                        <br>
                                                        <p><strong>Id producto: </strong><?php echo $lista->getIdProducto(); ?></p>
                                                        <p><strong>Categoria: </strong><?php echo $lista->getNombreCategoria(); ?></p>
                                                        <p><strong>Nombre: </strong><?php echo $lista->getNombre(); ?></p>
                                                        <p><strong>Descripción: </strong><?php echo $lista->getDescripcion(); ?></p>
                                                        <p><strong>Precio: </strong>$<?php echo $lista->getPrecio(); ?></p>
                                                        <p><strong>El producto es para: </strong><?php echo $lista->getSexo(); ?></p>
                                                        <p><strong>Estado: </strong><?php echo $lista->getEstado(); ?></p>
                                                    </div>


                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        
                                        }
                                    ?>

                                    </tbody>
                                </table>
                            </div>    
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="table-container">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $cont = 1;
                                        foreach ($this->listaOcultos as $listaO) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cont++; ?></td>
                                            <td><?php echo $listaO->getNombre(); ?></td>
                                            <td><?php echo $listaO->getNombreCategoria(); ?></td>
                                            <td>
                                                <div class="modal fade text-dark" id="exampleModal<?php echo $listaO->getIdProducto(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Eliminar Producto</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="<?php echo constant("URL")?>Producto/eliminarProducto" style="display:inline;">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?php echo $listaO->getIdProducto(); ?>">
                                                            <input type="hidden" name="nombre" value="<?php echo $listaO->getNombre(); ?>">
                                                            <input type="hidden" name="imagen" value="<?php echo "public/imgProductos/" . $listaO->getImagen()?>">
                                                            <p>¿Realmente deseas eliminar el producto '<?php echo $listaO->getNombre(); ?>'?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                                        </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" style="background:none; border:none; color:inherit; padding:0; font:inherit; cursor:pointer;" data-toggle="modal" data-target="#exampleModal<?php echo $listaO->getIdProducto(); ?>">
                                                    <i class="fa-solid fa-trash icon mr-2"></i>
                                                </button>
                                                <button type="button" style="background:none; border:none; color:inherit; padding:0; font:inherit; cursor:pointer;" data-toggle="modal" data-target="#editarO<?php echo $listaO->getIdProducto(); ?>">
                                                    <i class="fas fa-edit icon mr-2"></i>
                                                </button>
                                                <button type="button" style="background:none; border:none; color:inherit; padding:0; font:inherit; cursor:pointer;" data-toggle="modal" data-target="#mostrarO<?php echo $listaO->getIdProducto(); ?>">
                                                <i class="fa-solid fa-eye icon"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade text-dark text-left" id="editarO<?php echo $listaO->getIdProducto(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modificar Producto</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="needs-validation" novalidate role="form" action="<?php echo constant("URL")?>Producto/modificarProducto" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="inputAddress">Nombre:</label>
                                                                <input type="hidden" value="<?php echo $listaO->getIdProducto(); ?>" name="id">
                                                                <input type="text" class="form-control" placeholder="Digite el nombre del producto." required name="nombre" value="<?php echo $listaO->getNombre(); ?>">
                                                                <div class="invalid-feedback">El nombre del producto no puede quedar vacío.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress">Categoria:</label>
                                                                <select class="custom-select" id="validationCustom04" required name="categoria">
                                                                    
                                                                    <?php
                                                                    foreach ($this->listaCategorias as $listaC) {
                                                                    ?>
                                                                    <option value="<?php echo $listaC->getIdCategoria(); ?>" <?php echo ($listaO->getIdCategoria() == $listaC->getIdCategoria()) ? 'selected' : ''; ?>><?php echo $listaC->getNombre(); ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <div class="invalid-feedback">Debe de seleccionar una categoria para este producto.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress">Descripción:</label>
                                                                <textarea class="form-control" id="validationTextarea" placeholder="Descripción del producto." required name="descri"><?php echo $listaO->getDescripcion(); ?></textarea>
                                                                <div class="invalid-feedback">Debe de digitar una descripción para este producto.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress">Precio:</label>
                                                                <input type="number" class="form-control" step="0.01" min="0" placeholder="Digite el precio del producto." required pattern="^\d+(\.\d{1,2})?$" name="precio" value="<?php echo $listaO->getPrecio(); ?>">
                                                                <div class="invalid-feedback">El precio del producto no puede quedar vacío.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress">Estado:</label>
                                                                <select class="custom-select" id="validationCustom04" required name="estado">
                                                                    <option value="Mostrar" >Mostrar</option>
                                                                    <option value="Ocultar" selected>Ocultar</option>
                                                                </select>
                                                                <div class="invalid-feedback">Debe de seleccionar una categoria para este producto.</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress">El producto es para:</label>
                                                                <br>
                                                                <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                    <input type="radio" id="customRadioInline1" name="gender" value="Hombre" class="custom-control-input" required <?php echo ($listaO->getSexo() == 'Hombre') ? 'checked' : ''; ?>>
                                                                    <label class="custom-control-label" for="customRadioInline1">Hombre</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline mr-2">
                                                                    <input type="radio" id="customRadioInline2" name="gender" value="Mujer" class="custom-control-input" required <?php echo ($listaO->getSexo() == 'Mujer') ? 'checked' : ''; ?>>
                                                                    <label class="custom-control-label" for="customRadioInline2">Mujer</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="customRadioInline3" name="gender" value="Unisex" class="custom-control-input" required <?php echo ($listaO->getSexo() == 'Unisex') ? 'checked' : ''; ?>>
                                                                    <label class="custom-control-label" for="customRadioInline3">Unisex</label>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Modificar Producto</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade text-dark text-left" id="mostrarO<?php echo $listaO->getIdProducto(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Destalle de <?php echo $listaO->getNombre(); ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <center>
                                                        <img src="<?php echo constant("URL") . "public/imgProductos/" . $listaO->getImagen()?>" width="200px" height="200px">
                                                        </center>
                                                        <br>
                                                        <p><strong>Id producto: </strong><?php echo $listaO->getIdProducto(); ?></p>
                                                        <p><strong>Categoria: </strong><?php echo $listaO->getNombreCategoria(); ?></p>
                                                        <p><strong>Nombre: </strong><?php echo $listaO->getNombre(); ?></p>
                                                        <p><strong>Descripción: </strong><?php echo $listaO->getDescripcion(); ?></p>
                                                        <p><strong>Precio: </strong>$<?php echo $listaO->getPrecio(); ?></p>
                                                        <p><strong>El producto es para: </strong><?php echo $listaO->getSexo(); ?></p>
                                                        <p><strong>Estado: </strong><?php echo $listaO->getEstado(); ?></p>
                                                    </div>


                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        
                                        }
                                    ?>

                                    </tbody>
                                </table>
                            </div>  
                        </div>
                    </div>
                </div>
                
            </div>
        </section>

        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="needs-validation" novalidate role="form" action="<?php echo constant("URL")?>Producto/agregarProducto" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputAddress">Nombre:</label>
                                <input type="text" class="form-control" placeholder="Digite el nombre del producto." required name="nombre">
                                <div class="invalid-feedback">El nombre del producto no puede quedar vacío.</div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Categoria:</label>
                                <select class="custom-select" id="validationCustom04" required name="categoria">
                                    <option selected disabled value="">Seleccione la categoria del producto.</option>
                                    <?php
                                    foreach ($this->listaCategorias as $lista) {
                                    ?>
                                    <option value="<?php echo $lista->getIdCategoria(); ?>"><?php echo $lista->getNombre(); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">Debe de seleccionar una categoria para este producto.</div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Descripción:</label>
                                <textarea class="form-control" id="validationTextarea" placeholder="Descripción del producto." required name="descri"></textarea>
                                <div class="invalid-feedback">Debe de digitar una descripción para este producto.</div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Precio:</label>
                                <input type="number" class="form-control" step="0.01" min="0" placeholder="Digite el precio del producto." required pattern="^\d+(\.\d{1,2})?$" name="precio">
                                <div class="invalid-feedback">El precio del producto no puede quedar vacío.</div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Estado:</label>
                                <select class="custom-select" id="validationCustom04" required name="estado">
                                    <option value="Mostrar" >Mostrar</option>
                                    <option value="Ocultar" selected>Ocultar</option>
                                </select>
                                 <div class="invalid-feedback">Debe de seleccionar una categoria para este producto.</div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">El producto es para:</label>
                                <br>
                                <select class="custom-select" id="validationCustom04" required name="gender">
                                    <option selected value="Mujer">Mujer</option>
                                    <option value="Hombre">Hombre</option>
                                    <option value="Unisex">Unisex</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Imagen:</label>
                                <div class="custom-file">
                                    <input type="file" name="imagen" class="custom-file-input" id="input-imagen" accept="image/*" required>
                                    <label class="custom-file-label" id="textImagen" for="input-imagen">Choosed file</label>
                                    <p id="aa"></p>
                                    <div class="invalid-feedback">Debe de ingresar una imagen del producto</div>
                                </div>
                                <div id="contenedor-miniatura">
                                    <img id="miniatura" class="miniatura" src="#" alt="Miniatura de imagen" width="145px" height="145px">
                                </div>
                            </div>


                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Agregar producto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


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
<script>
  // Función para mostrar la miniatura cuando se selecciona una imagen
  function mostrarMiniatura() {
    const archivo = document.querySelector('#input-imagen').files[0];
    const lector = new FileReader();

    lector.onload = function(evento) {
      document.querySelector('#miniatura').setAttribute('src', evento.target.result);
    }

    lector.readAsDataURL(archivo);
  }

  // Escuchar cambios en el input de imagen
  document.querySelector('#input-imagen').addEventListener('change', mostrarMiniatura);
</script>
    <script src="<?php echo constant('URL') ?>public/js/menu.js"></script>
    <script src="<?php echo constant('URL') ?>public/js/validaciones.js"></script>
</body>
</html>