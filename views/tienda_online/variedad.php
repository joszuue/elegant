<!DOCTYPE html>
<?php require "views/templates/header.php"; ?>


        <section class="hero__container container">
            <h1 class="hero__title">Variedad de Productos</h1>
            <p class="hero__paragraph">
            <p class="hero__paragraph">Nos enorgullece ofrecer una amplia selección de productos de calidad que no solo complementan tu estilo, sino que también garantizan durabilidad y confianza.</p>
            <a href="#" class="cta">El Estilo En Tú Tiempo</a>
        </section>
    </header>
    <style>
    .hero::before {
        background-image: linear-gradient(180deg, #0000008c 0%, #0000008c 100%), url('<?php echo constant("URL") . "public/imagenes/fondo4.jpg"?>');
    }
    </style>
    <main>
        <section class="price container">
            <br><br>
            <ul class="tab-menu">
            <?php 
                if($this->listaMujeres != null){
                    ?>
                    <li><a href="#home" class="active">Para Dama</a></li>
                    <?php
                }
                ?>
                <?php 
                if($this->listaHombres != null){
                    ?>
                    <li><a href="#profile">Para Caballero</a></li>
                    <?php
                }
                ?>
            </ul>

            <div class="tab-content active" id="home">
                <h2 class="subtitle">Productos para Dama</h2>
                <div class="price__table ">
                    <?php
                    foreach ($this->listaMujeres as $listaM) {
                    ?>
                        <div class="price__element">
                            <div class="price__img-container">
                                <img src="<?php echo constant("URL") . "public/imgProductos/" . $listaM->getImagen()?>" class="price__img">
                            </div>
                            <h3 class="price__price"><?php echo $listaM->getNombre()?></h3>
                            <div class="price__items">
                                <p class="price__features"></p>Precio: $<?php echo $listaM->getPrecio() . "<br><br>" . $listaM->getDescripcion() . "<br><br>Categoria: " . $listaM->getNombreCategoria()?></p>
                            </div>
                            <?php if(!isset($_SESSION['codigo'])){ ?>
                                <label for="modal-toggle-2" class="button price__cta">Agregar <i class="fa-solid fa-cart-shopping"></i></label>
                                <input type="checkbox" id="modal-toggle-2" class="modal-toggle">
                                <div class="modal" id="modal-2">
                                    <div class="modal-content">
                                        <label for="modal-toggle-2" class="close">&times;</label>
                                        <center>
                                            <h2 class="subtitle">Iniciar Sesión</h2>
                                            <img src="<?php echo constant('URL') ?>public/imagenes/logoSweetGirl.png" width="155px" height="145px">
                                        </center>
                                        <br>
                                        <p>¡Para agregar elementos al carro de compras, por favor inicia sesión en tu cuenta o <a href="<?php echo constant('URL') ?>Tienda_Online/registro">crea una</a>!</p>
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
                            <?php }else{ ?>
                                <form action="<?php echo constant('URL') ?>Tienda_Online/carrito" method="post">
                                <div style="display: flex; align-items: center;">
                                    <input type="hidden" name="id" value="<?php echo $listaM->getIdProducto()?>">
                                    <input type="hidden" name="precio" value="<?php echo $listaM->getPrecio()?>">
                                    <input type="hidden" name="codigo" value="<?= isset($_SESSION['codigo']) ? $_SESSION['codigo'] : null; ?>">
                                    <input type="number" min="1" max="100" value="1" class="button price__cta2" name="cantidad">
                                    <button type="submit" class="button price__cta">Agregar <i class="fa-solid fa-cart-shopping"></i></button>
                                </div>
                                </form>
                            <?php } ?>
                        </div>   
                    <?php
                    }
                    ?>     
                </div>

            </div>
            <div class="tab-content" id="profile">
                <h2 class="subtitle">Productos para Caballero</h2>
                <div class="price__table ">
                    <?php
                    foreach ($this->listaHombres as $listaH) {
                    ?>
                        <div class="price__element">
                            <div class="price__img-container">
                                <img src="<?php echo constant("URL") . "public/imgProductos/" . $listaH->getImagen()?>" class="price__img">
                            </div>
                            <h3 class="price__price"><?php echo $listaH->getNombre()?></h3>
                            <div class="price__items">
                                <p class="price__features"></p>Precio: $<?php echo $listaH->getPrecio() . "<br><br>" . $listaH->getDescripcion() . "<br><br>Categoria: " . $listaH->getNombreCategoria()?></p>
                            </div>
                            <?php if(!isset($_SESSION['codigo'])){ ?>
                                <label for="modal-toggle-2" class="button price__cta">Agregar <i class="fa-solid fa-cart-shopping"></i></label>
                                <input type="checkbox" id="modal-toggle-2" class="modal-toggle">
                                <div class="modal" id="modal-2">
                                    <div class="modal-content">
                                        <label for="modal-toggle-2" class="close">&times;</label>
                                        <center>
                                            <h2 class="subtitle">Iniciar Sesión</h2>
                                            <img src="<?php echo constant('URL') ?>public/imagenes/logoNegro.png" width="175px" height="155px">
                                        </center>
                                        <br>
                                        <p>¡Para agregar elementos al carro de compras, por favor inicia sesión en tu cuenta o <a href="<?php echo constant('URL') ?>Tienda_Online/registro">crea una</a>!</p>
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
                                        <a href="<?php echo constant('URL') ?>Tienda_Online/registro">Crear Cuenta</a>
                                        </center>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <form action="<?php echo constant('URL') ?>Tienda_Online/carrito" method="post">
                                <div style="display: flex; align-items: center;">
                                    <input type="hidden" name="id" value="<?php echo $listaH->getIdProducto()?>">
                                    <input type="hidden" name="precio" value="<?php echo $listaH->getPrecio()?>">
                                    <input type="hidden" name="codigo" value="<?= isset($_SESSION['codigo']) ? $_SESSION['codigo'] : null; ?>">
                                    <input type="number" min="1" max="100" value="1" class="button price__cta2" name="cantidad">
                                    <button type="submit" class="button price__cta">Agregar <i class="fa-solid fa-cart-shopping"></i></button>
                                </div>
                                </form>
                            <?php } ?>
                        </div>   
                    <?php
                    }
                    ?>     
                </div>
            </div>
        </section>   
    </main>
    <footer class="footer" style="background-color: #0074D9;">
        <section class="footer__copy container">
            <div class="footer__social">
            <a class="footer__icons" style="text-decoration: none;" href="https://www.tiktok.com/@elegant.sv" target="_blank">
                <i class="fab fa-facebook" style="color: white; font-size: 1.9em;"></i>
            </a>
            <a class="footer__icons" style="text-decoration: none;" href="https://www.instagram.com/elegant.sv503/?igsh=MW04dDlsM3BmYWUyZw%3D%3D" target="_blank">
                <i class="fab fa-instagram" style="color: white; font-size: 1.9em;"></i>
            </a>
            <a class="footer__icons" style="text-decoration: none;" href="https://www.tiktok.com/@elegant.sv" target="_blank">
                <i class="fab fa-tiktok" style="color: white; font-size: 1.9em;"></i>
            </a>
            </div>

            <h3 class="footer__copyright">Siguenos en nuestras redes sociales.</h3>
        </section>
    </footer>
    <script src="<?php echo constant('URL') ?>public/js/slider.js"></script>
    <script src="<?php echo constant('URL') ?>public/js/questions.js"></script>
    <script src="<?php echo constant('URL') ?>public/js/menu.js"></script>
    <script src="<?php echo constant('URL') ?>public/js/nav.js"></script>
</body>
</html>