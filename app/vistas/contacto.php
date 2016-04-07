 <?php 
 //ob_start() hace que el código html y php ya ejecutado no se envíe al usuario sino
 //que se guarda en un buffer
 ob_start() ?>
 
 PARTE DESTINADA A CONTACTO
<?php 
//ob_get_clean() devuelve el código html del buffer y lo limpia. Todo el código lo
//guardamos en $contenido que lo escribiremos dentro de plantilla.php
$contenido= ob_get_clean(); 
require '../app/vistas/plantilla_publica.php';
?>