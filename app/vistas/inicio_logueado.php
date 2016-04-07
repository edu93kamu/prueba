 <?php 
 //ob_start() hace que el código html y php ya ejecutado no se envíe al usuario sino
 //que se guarda en un buffer
 ob_start() ?>
<script type="text/jscript" src="web/js/cliente.js"></script>
<?php MensajeFlash::mostrar_mensaje(); ?>
    CONTENIDO INDICE LOGUEADO
<?php 
//ob_get_clean() devuelve el código html del buffer y lo limpia. Todo el código lo
//guardamos en $contenido que lo escribiremos dentro de plantilla.php
$contenido= ob_get_clean(); 
?>