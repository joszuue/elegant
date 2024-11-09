<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ELEGANT</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo constant('URL') ?>public/imagenes/icono.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/normalize.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/estilos.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/carrito.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/nav.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/modal.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/css/formulario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <style>
    .hero::before {
        background-image: linear-gradient(180deg, #0000008c 0%, #0000008c 100%), url('<?php echo constant("URL") . "public/imagenes/fondo.jpg"?>');
    }
</style>
    <header class="hero">
        <nav class="nav container">
            <br>
            <div>
                <br>
                <img src="<?php echo constant('URL') ?>public/imagenes/logo.png" width="145px" height="125px">
                
            </div>
        </nav>
        <section class="hero__container container">
            <h1 class="hero__title">Lo sentimos, no tienes acceso a esta pagina.</h1>
            <a href="#" onclick="goBack()" class="cta">Regresar</a>
        </section>
    </header>
    <script>
function goBack() {
  window.history.back();
}
</script>
</html>
