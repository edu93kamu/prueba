 <?php 
 //ob_start() hace que el código html y php ya ejecutado no se envíe al usuario sino
 //que se guarda en un buffer
 ob_start() ?>
<script type="text/javascript" src="web/js/funciones_datos.js"></script>
<script type="text/javascript" src="web/js/funciones_publica.js"></script>
<?php MensajeFlash::mostrar_mensaje(); ?>
<div class="noprint">
<div class="secciones" id="num1"><img src="web/img/categoria.png" class="imagen">Ver Categorias<div style="float: right;"><button id="ver_1"><img src="web/img/abajo.gif"></button><button id="no_1"><img src="web/img/arriba.gif"></button></div></div>
<div class="dialogos" id="tabla1">
    
</div>
<div class="secciones" id="num2"><img src="web/img/producto.png" class="imagen">Ver Productos<div style="float: right;"><button id="ver_2"><img src="web/img/abajo.gif"></button><button id="no_2"><img src="web/img/arriba.gif"></button></div></div>
<div class="dialogos" id="tabla2">
    
</div>
<div class="secciones" id="num3"><img src="web/img/cliente.png" class="imagen">Ver Usuarios<div style="float: right;"><button id="ver_3"><img src="web/img/abajo.gif"></button><button id="no_3"><img src="web/img/arriba.gif"></button></div></div>
<div class="dialogos" id="tabla3">
    
</div>
<div class="secciones" id="num4"><img src="web/img/pedido.png" class="imagen">Ver Pedidos<div style="float: right;"><button id="ver_4"><img src="web/img/abajo.gif"></button><button id="no_4"><img src="web/img/arriba.gif"></button></div></div>
<div class="dialogos" id="tabla4">
    
</div>
<div class="secciones" id="num5"><img src="web/img/presupuesto.png" class="imagen">Ver Presupuestos<div style="float: right;"><button id="ver_5"><img src="web/img/abajo.gif"></button><button id="no_5"><img src="web/img/arriba.gif"></button></div></div>
<div class="dialogos" id="tabla5">
    
</div>
</div>
<!-- dialogo de edicion de productos -->
<div class="dialogos" id="editar_producto">
    <div id="foto_producto">Foto:<output id="list"><br><img src="web/img/productos/default.png" id="previa" class="previa"></output></div>
    <form action="actualizar_producto" method="post" enctype="multipart/form-data" name="formulario_producto" id="formulario_producto" autocomplete="off">
        <input type="hidden" name="id2" id="id2">
        Nombre:<br>
        <input type="text" name="nombre2" class="formulario" id="nombre2" placeholder="nombre..." required="required">
        <br><br>
        Descripcion:
        <textarea name="descripcion" id="descripcion"></textarea>
        <br>
        Categoria:
        <br>
        <select class="formulario" name="cate" id="cate">
            <?php
                if($categorias){
                    foreach ($categorias as $cat1):
            ?>
            <option value="<?php echo $cat1['idcategorias']; ?>"><?php echo $cat1['nombre']; ?></option>
            <?php
                    endforeach;
                }
            ?>
        </select>
        <br>
        <br>
        <input type="submit" name="enviar_categoria" class="boton" value="guardar">
    </form>
</div>
<!-- dialogo de edicion de categorias -->
<div class="dialogos" id="editar_categoria">
    <form action="actualizar_categoria" method="post" name="formulario_categoria" id="formulario_categoria" autocomplete="off">
        <input type="hidden" name="id1" id="id1" placeholder="nombre...">
        <input type="text" name="nombre" class="formulario" id="nombre" placeholder="nombre..." required="required">
        <input type="submit" name="enviar_categoria" class="boton" value="guardar">
    </form>
</div>
<!-- dialogo de edicion de usuarios -->
<div class="dialogos" id="editar_usuario">
    <form action="actualizar_usuario" method="post" name="formulario_usuario" id="formulario_usuario" autocomplete="off">
        <input type="hidden" name="id3" id="id3">
        <input type="text" name="nombre3" class="formulario" id="nombre3" placeholder="nombre completo..." required="required">
        <br><br>
        <input type="email" name="correo" class="formulario" id="correo" disabled="disabled">
        <input type="email" name="correo2" class="formulario" id="correo2" disabled="disabled">
        <br><br>
        <input type="password" name="clave" class="formulario" id="clave" placeholder="*****" disabled="disabled">
        <input type="password" name="clave2" class="formulario" id="clave2" placeholder="*****" disabled="disabled">
        <br><br>
        <input type="text" name="calle" class="formulario" id="calle" placeholder="calle..." required="required">
        <input type="text" name="numero" class="formulario" id="num" placeholder="numero..." required="required">
        <br><br>
        <input type="text" name="provincia" class="formulario" id="provincia" placeholder="provincia..." required="required">
        <input type="text" name="poblacion" class="formulario" id="poblacion" placeholder="poblacion..." required="required">
        <br><br>
        <input type="tel" name="telefono" class="formulario" id="telefono" placeholder="telefono..." required="required">
        <br><br>
        ROL: <select name="rol" id="rol" class="formulario">
            <option value="Cliente">Cliente</option>
            <option value="Administrador">Administrador</option>
        </select>
        <br><br>
        <input type="submit" name="enviar_usuario" class="boton" value="guardar">
    </form>
</div>
<!-- dialogo de edicion de pedidos -->
<div class="dialogos" id="editar_pedido">
    
        Nº de pedido: <span id="numpedido"></span><br>
        Cliente: <span id="nombrecliente"></span><br>
        Telefono: <span id="telefonocliente"></span><br>
        <div class='tabla' id='tabla_productos'>
            
        </div>
        <br><br>
</div>
<!-- dialogo de edicion de presupuestos -->
<div class="dialogos" id="editar_presupuesto">
    <form action="actualizar_presupuesto" method="post" name="formulario_presupuesto" id="formulario_presupuesto" autocomplete="off">
        <input type="hidden" name="id5" id="id5">
        <input type="submit" name="enviar_presupuesto" class="boton" value="guardar">
    </form>
</div>
<?php 
//ob_get_clean() devuelve el código html del buffer y lo limpia. Todo el código lo
//guardamos en $contenido que lo escribiremos dentro de plantilla.php
$contenido= ob_get_clean(); 
?>