$(document).ready(function(e){
    $('#fotodialogo').dialog({
	autoOpen:false,
	heigh:300,
	width:500,
	modal:true,
	title:"Fotografia ampliada",
	hide:{effect:"fade",duration: 700},
	show:{effect:"fade",duration: 700}
    });
    $('.imagen_pequena').click(function(e) {
        ruta=$(this).attr("src");
        $("#imagen_grande").attr("src",ruta);
        $('#fotodialogo').dialog("open");
    });
    $(".categorias").click(function(e){
        var id=$(this).attr("data-id");
        $("#buscado").val(id);
        $("#fomrbusqueda").submit();
    });
    $(".menos").click(function(e){
        cuadro=$(this).attr("data-id");
        cantidad=$("#"+cuadro).val();
        if(cantidad>0){
            $("#"+cuadro).val(cantidad-1);
        }
    });
    $(".mas").click(function(e){
        cuadro=$(this).attr("data-id");
        cantidad=$("#"+cuadro).val();
        if(cantidad<999){
            $("#"+cuadro).val(parseInt(cantidad)+1);
        }
    });
    $(".cantidad").change(function(e){
        if($(this).val()<1||$(this).val()>998){
            $(this).val(1);
        }
    });
    $(".anadir_carrito").click(function(e){
       id_producto=$(this).attr("data-id");
       cantidad=$("#cant"+id_producto).val();
       $.ajax({
            url:'anadir_carro',
            data: 'id='+id_producto+'&cantidad='+cantidad,
            type:'POST',
            success: function(respuesta){
                if(respuesta=="error"){
                    alert("error al añadir");
                }else{
                    alert("articulos agregados");
                }
            }
        });
    });
    $("#elcarrodelacompra").click(function(e){
        window.location.href = "ver_carro";
    });
    setInterval(function(){
        $.ajax({
            url:'ver_articulos',
            type:'POST',
            success: function(respuesta){
                $("#numero").html(respuesta);
            }
        });
    }, 1000);
});
function justNumbers(e){
   var keynum = window.event ? window.event.keyCode : e.which;
   if ((keynum == 8) || (keynum == 46))
        return true;
    return /\d/.test(String.fromCharCode(keynum));
}