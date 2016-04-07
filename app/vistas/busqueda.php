 <?php 
 //ob_start() hace que el código html y php ya ejecutado no se envíe al usuario sino
 //que se guarda en un buffer
 ob_start() ?>
<?php
if($productos){
    foreach($productos as $pro){
?>
<div class="producto">
    <span class="span_productos">Nombre: </span><?php echo $pro['nombre'];?><br>
    <img class="imagen_pequena" style="height: 50px;" src="web/img/productos/<?php echo $pro['foto'];?>"><br>
    <span class="span_productos">Categoria: </span>
    <?php 
    if($pro['categorias_idcategorias']==null){
        echo "Sin Categoria";
    }else{
        $objeto= new Categoria();
        $categ=$objeto->coger_por_id($pro['categorias_idcategorias']);
        unset($objeto);
        echo $categ['nombre'];
    }?>
    </span><br>
    <span class="span_productos">Descripcion: </span><?php echo html_entity_decode($pro['descripcion']);?><br>
    <div style="margin:auto; padding: auto;">
        <span style="display: inline-block; margin: 10px;">
            <button class="menos" data-id="cant<?php echo $pro['idproductos'];?>">-</button>
            <input onkeypress="return justNumbers(event);" type="text" class="cantidad" id="cant<?php echo $pro['idproductos'];?>" name="cantidad" value="1" maxlength="3">
            <button data-id="cant<?php echo $pro['idproductos'];?>" class="mas">+</button>
        </span>
        <div class="anadir_carrito" data-id="<?php echo $pro['idproductos'];?>" title="Añadir"></div>
    </div>
</div>
<?php
    }
}else{
?>
    <h1> no se han encontrado resultados</h1>
<?php } ?>
    <div class="dialogos" id="fotodialogo">
        <img id="imagen_grande" src="" style="height: 300px">
    </div>
<?php
//ob_get_clean() devuelve el código html del buffer y lo limpia. Todo el código lo
//guardamos en $contenido que lo escribiremos dentro de plantilla.php
$contenido= ob_get_clean(); 
?>