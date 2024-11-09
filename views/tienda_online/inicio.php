<!DOCTYPE html>
<?php require "views/templates/header.php"; ?>


        <section class="hero__container container">
            <?php if(isset($_SESSION['nombre1'])){
                echo "<h1 class='hero__title'>¡Holaa, " . $_SESSION['nombre1'] . " " . $_SESSION['apellido1'] . "!</h1>";
            }else{
                echo "<h1 class='hero__title'>Tu destino para relojes de calidad y estilo.</h1>";
            }
            ?>
            <p class="hero__paragraph">Nos enorgullece ofrecer una amplia selección de productos de calidad que no solo complementan tu estilo, 
                sino que también garantizan durabilidad y confianza.
                </p>
            <a href="#" class="cta">El Estilo En Tú Tiempo</a>
        </section>
    </header>
<style>
    .hero::before {
        background-image: linear-gradient(180deg, #0000008c 0%, #0000008c 100%), url('<?php echo constant("URL") . "public/imagenes/fondo.jpg"?>');
    }
</style>
    <main>
        <section class="price container">
            <h2 class="subtitle">Nuestros Productos</h2>
            <div class="price__table ">
                <?php
                foreach ($this->listaRand as $lista) {
                ?>
                    <div class="price__element">
                        <div class="price__img-container">
                            <img src="<?php echo constant("URL") . "public/imgProductos/" . $lista->getImagen()?>" class="price__img">
                        </div>
                        <h3 class="price__price"><?php echo $lista->getNombre()?></h3>
                        <div class="price__items">
                            <p class="price__features"></p>Precio: $<?php echo $lista->getPrecio() . "<br><br>" . $lista->getDescripcion() . "<br><br>Categoria: " . $lista->getNombreCategoria()?></p>
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
                                    <p>¿No tienes una cuenta? <a href="<?php echo constant('URL') ?>Tienda_Online/registro">Regístrate</a></p>
                                    </center>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <form action="<?php echo constant('URL') ?>Tienda_Online/carrito" method="post">
                            <div style="display: flex; align-items: center;">
                                <input type="hidden" name="id" value="<?php echo $lista->getIdProducto()?>">
                                <input type="hidden" name="precio" value="<?php echo $lista->getPrecio()?>">
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
        </section>
        <section class="testimony">
            <div class="testimony__container container">
                <?php
                $cont = 1;
                foreach ($this->listaCates as $listaC) {
                ?>
                <section class="testimony__body <?php if ($cont == 1){echo 'testimony__body--show';}?>" data-id="<?php echo $cont++;?>">
                    <div class="testimony__texts">
                        <h2 class="subtitle" style="color: #F5F5F5;"><?php echo $listaC->getNombre()?><br>
                            <span class="testimony__course">$<?php echo $listaC->getPrecio()?></span></h2>
                        <p class="testimony__review"><?php echo $listaC->getDescripcion() . "<br><br>Categoria: " . $listaC->getNombreCategoria()?></p>
                    </div>

                    <figure class="testimony__picture">
                        <img src="<?php echo constant("URL") . "public/imgProductos/" . $listaC->getImagen()?>" class="testimony__arrow testimony__img" id="next">
                    </figure>
                </section>
                <?php
                }
                ?>
                <img src="<?php echo constant('URL') ?>public/imagenes/rightarrow.svg" class="testimony__arrow" id="before">
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
</body>
</html>