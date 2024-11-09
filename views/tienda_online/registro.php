<!DOCTYPE html>
<?php require "views/templates/header.php"; ?>
        <section class="hero__container container">
            <h1 class="hero__title">Registro de Usuarios</h1>
            <p class="hero__paragraph">¡Bienvenido! Completa los siguientes campos para crear tu cuenta 
                y comenzar a añadir productos a tu carrito de compras.</p>
            <a href="#" class="cta">El Estilo En Tú Tiempo</a>
        </section>
    </header>
    <style>
    .hero::before {
        background-image: linear-gradient(180deg, #0000008c 0%, #0000008c 100%), url('<?php echo constant("URL") . "public/imagenes/fondo5.jpg"?>');
    }
    </style>
    <main>
        <section class="price container">
            <div class="price__table" >
                <div class="price__element">
                    <div style="width:235px; height:225px;">
                        <img src="<?php echo constant("URL") . "public/imagenes/logo.png"?>" class="price__img" >
                    </div>
                    <div class="price__items" style="width: 270px;">
                        <form method="POST" action="<?php echo constant("URL")?>Tienda_Online/registrer">
                            <div class="form-group">
                                <label for="nombre" style="color: white;">Nombre:</label>
                                <input type="text" id="email" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido" style="color: white;">Apellido:</label>
                                <input type="text" id="email" name="apellido" required>
                            </div>
                            <div class="form-group">
                                <label for="email" style="color: white;">Correo Electrónico:</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password" style="color: white;">Contraseña:</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="price__cta">Registrarse</button>
                            </div>
                        </form>
                    </div>
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