<?php 
 //ob_start() hace que el código html y php ya ejecutado no se envíe al usuario sino
 //que se guarda en un buffer
 ob_start() ?>
<?php
    if($carro){
?>
<div id="tabla_carro">
    <div class='tabla' id='tabla_productos'>
        <div class='fila'>
            <div class='columna_primera'>Foto</div>
            <div class='columna_primera'>Producto</div>
            <div class='columna_primera'>cantidad</div>
            <div class='columna_primera'>Eliminar</div>
        </div>
        <?php foreach ($carro2 as $pro): ?>
        <div class='fila'>
            <div class='columna'><img src="web/img/productos/<?php echo $pro["foto"]; ?>" style="height:40px;"></div>
            <div class='columna'><?php echo $pro["nombre"]; ?></div>
            <div class='columna'><?php echo $pro["cantidad"]; ?></div>
            <div class='columna'><img id="borrarpro2" data-id="" src="web/img/borrar.png"></div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<form action="insertar_pedido" method="post" id="pedidos">
    <br><textarea id="comentario" name="comentario" class="formulario_caja" placeholder="introduzca un comentario"></textarea><br>
    <br><a href="vaciar" id="vaciado" class="boton"> Vaciar Carrito</a><br>
    <br><input type="submit" id="pedir" class="boton" value="Confirmar Pedido"> <br>
</form>
<?php
    }else{
?>
    <h1> No hay articulos</h1>
<?php
    }
?>
<?php
//ob_get_clean() devuelve el código html del buffer y lo limpia. Todo el código lo
//guardamos en $contenido que lo escribiremos dentro de plantilla.php
$contenido= ob_get_clean(); 
?>