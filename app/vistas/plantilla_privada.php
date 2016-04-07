<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tienda-tsecurity</title>
        
        <base href="/tiendaSecurity/"> <!-- para indicar desde donde tomar siempre las rutas relativas-->
        <script src="web/js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="web/js/jquery-te-1.4.0.min.js" type="text/javascript"></script>
        <script type="text/jscript" src="web/js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
        <script type="text/jscript" src="web/js/cliente.js"></script>
        <link href="web/css/estilos.css" type="text/css" rel="stylesheet">
        <link href="web/css/jquery-te-1.4.0.css" type="text/css" rel="stylesheet">
        <link href="web/js/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="web/css/imprimir.css" media="print" />
        <link rel="shortcut icon" href="web/img/favicon.ico">
    </head>
    <body>
    	<div id="contenedor">
            <div id="cabecera">
                <a href="inicio_logueado"><img src="web/img/logo_tsecurity.png"></a>
                <h4>bienvenido, <?php echo SesionUsuario::obtener_email(); ?><a href="logout" class="boton">cerrar sesion</a></h4>
               
            </div>
            <div class="contenedor">
                <div class="contenido">
                    <!-- linea oscura que se ve debajo de la cabecera -->
                    <div class="linea"></div>
                    <br>
                    <!-- div general 1 que tiene encabezado y carrito -->
                    <div id="general1">
                        <div id="carrito">
                            <img src="web/img/carro.png" class="carrito" id="elcarrodelacompra"><br>
                            Articulos: 
                            <span id="numero">
                                <?php 
                                    echo count(SesionUsuario::obtener_carro());
                                ?>
                            </span>
                        </div>
                        <div id="titulo"></div>
                    </div>
                    <!-- div general 2 con el menu y el contenido -->
                    <div id="general2">
                        <div id="categorias">
                            <br>
                            <form action="busquedas" id="fomrbusqueda" name="formbusqueda" method="post">
                                <input type="text" name="buscado" id="buscado" class="formulario" placeholder="buscar">
                                <input type="submit" name="enviar" id="enviar" value="buscar" class="boton">
                            </form>
                            <br>
                                <?php
                                    if($categorias){
                                        foreach ($categorias as $cat):
                                ?>
                                <span class="categorias" data-id="<?php echo $cat['idcategorias'] ?>"><?php echo $cat['nombre'] ?></span><br>
                                <?php
                                        endforeach;
                                    }
                                ?>  
                                <?php
                                    if(SesionUsuario::obtener_rol()=="Administrador"){
                                ?>
                                <a href="registros" class="cat_admin"> Registro de contenido </a><br>
                                <a href="presupuestar" class="cat_admin"> Presupuestar </a><br>
                                <a href="consultar_datos" class="cat_admin"> Consulta de datos </a><br>
                                <?php
                                    }
                                ?>
                        </div>
                        <div id="datos">
                            <?php
                        // Aquí va la vista
                            echo $contenido;
                        ?>
                        </div>
                    </div>
                </div>
                <br><br>
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
