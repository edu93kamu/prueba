 <?php 
 //ob_start() hace que el código html y php ya ejecutado no se envíe al usuario sino
 //que se guarda en un buffer
 ob_start() ?>
<script type="text/javascript" src="web/js/funciones_registros.js"></script>
<div class="secciones" id="num1"><img src="web/img/categoria.png" class="imagen">Categoria nueva</div>
<div class="secciones" id="num2"><img src="web/img/producto.png" class="imagen">Producto nuevo</div>
<div class="secciones" id="num3"><img src="web/img/cliente.png" class="imagen">Usuario/Cliente</div>
<!-- dialogo de registro de productos -->
<div class="dialogos" id="reg_producto">
    <div id="foto_producto">Foto:<output id="list"><br><img src="web/img/productos/default.png" id="previa" class="previa"></output></div>
    <form action="" method="post" enctype="multipart/form-data" name="formulario_producto" id="formulario_producto" autocomplete="off">
        Nombre:<br>
        <input type="text" name="nombre2" class="formulario" id="nombre2" placeholder="nombre..." required="required">
        <br><br>
        Descripcion:
        <textarea name="descripcion" id="descripcion"></textarea>
        <input type="file" name="files" id="files" class="dialogos" accept="image/*">
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
<!-- dialogo de registro de categorias -->
<div class="dialogos" id="reg_categoria">
    <form action="" method="post" name="formulario_categoria" id="formulario_categoria" autocomplete="off">
        <input type="text" name="nombre" class="formulario" id="nombre" placeholder="nombre..." required="required">
        <input type="submit" name="enviar_categoria" class="boton" value="guardar">
    </form>
</div>
<!-- dialogo de registro de usuarios -->
<div class="dialogos" id="reg_usuario">
    <form action="" method="post" name="formulario_usuario" id="formulario_usuario" autocomplete="off">
        <input type="text" name="nombre3" class="formulario" id="nombre3" placeholder="nombre completo..." required="required">
        <br><br>
        <input type="email" name="correo" class="formulario" id="correo" placeholder="correo..." required="required">
        <input type="email" name="correo2" class="formulario" id="correo2" placeholder="repita correo..." required="required">
        <br><br>
        <input type="password" name="clave" class="formulario" id="clave" placeholder="contraseña..." required="required">
        <input type="password" name="clave2" class="formulario" id="clave2" placeholder="repita contraseña..." required="required">
        <br><br>
        <input type="text" name="calle" class="formulario" id="calle" placeholder="calle..." required="required">
        <input type="text" name="numero" class="formulario" id="numero" placeholder="numero..." required="required">
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
<?php 
//ob_get_clean() devuelve el código html del buffer y lo limpia. Todo el código lo
//guardamos en $contenido que lo escribiremos dentro de plantilla.php
$contenido= ob_get_clean(); 
?>