<!DOCTYPE html>
<?php
if(SesionUsuario::existe_sesion()){
    header("location: ver_conversaciones");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>tsecurity</title>
        <link href="web/css/estilos.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="web/js/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="web/js/funciones_publica.js"></script>
        <base href="/tiendaSecurity/"> <!-- para indicar desde donde tomar siempre las rutas relativas-->
        <link rel="shortcut icon" href="web/img/favicon.ico">
    </head>
    <body>
    	<div id="contenedor">
            <div id="cabecera">
                <a href="inicio"><img src="web/img/logo_tsecurity.png"></a>
                <form id="formulario_login" action="login" method="post" autocomplete="off">
                    <input type="text" name="email" id="email" placeholder="Correo electrónico" class="formulario">
                    <input type="password" name="password" id="password" placeholder="Contraseña" class="formulario">
                    <input type="submit" class="boton" name="button" id="button" value="Entrar">
                    <?php MensajeFlash::mostrar_mensaje(); ?>
                </form>
                <br>
                <?php if($_GET['accion']=="quien_somos"){ ?>
                <a href="quien_somos" class="enlaces_index_pulsado">QUIENES SOMOS</a>
                <?php }else{ ?>
                <a href="quien_somos" class="enlaces_index">QUIENES SOMOS</a>
                <?php } ?>
                <?php if($_GET['accion']=="productos"){ ?>
                <a href="productos" class="enlaces_index_pulsado">PRODUCTOS</a>
                <?php }else{ ?>
                <a href="productos" class="enlaces_index">PRODUCTOS</a>
                <?php } ?>
                <?php if($_GET['accion']=="contacto"){ ?>
                <a href="contacto" class="enlaces_index_pulsado">CONTACTO</a>
                <?php }else{ ?>
                <a href="contacto" class="enlaces_index">CONTACTO</a>
                <?php } ?>
            </div>
            <div class="contenedor">
                <div class="contenido">
                    <div class="linea"></div>
                    <br>
                        <?php
                        // Aquí va la vista
                            echo $contenido;
                        ?>
                </div>
            </div>
            <div class="pie">
                <div class="contenido">
                    <br>
                    <hr>
                    <span> Tecnove Security by Eduardo Escribano Alberca</span>
                </div>
            </div>
        </div>
    </body>
</html>
