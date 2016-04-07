$(document).ready(function(e){
    $("textarea").jqte();
    $('#editar_categoria').dialog({
	autoOpen:false,
	heigh:300,
	width:300,
	modal:true,
	title:"Datos de categoria",
	hide:{effect:"fade",duration: 700},
	show:{effect:"fade",duration: 700}
    });
    $('#editar_producto').dialog({
	autoOpen:false,
	heigh:300,
	width:500,
	modal:true,
	title:"Datos de producto",
	hide:{effect:"fade",duration: 700},
	show:{effect:"fade",duration: 700}
    });
    $('#editar_usuario').dialog({
	autoOpen:false,
	heigh:300,
	width:500,
	modal:true,
	title:"Datos de usuario",
	hide:{effect:"fade",duration: 700},
	show:{effect:"fade",duration: 700}
    });
    $('#editar_pedido').dialog({
	autoOpen:false,
	heigh:300,
	width:500,
	modal:true,
	title:"Datos de pedido",
	hide:{effect:"fade",duration: 700},
	show:{effect:"fade",duration: 700}
    });
    $('#editar_presupuesto').dialog({
	autoOpen:false,
	heigh:300,
	width:500,
	modal:true,
	title:"Datos de presupuesto",
	hide:{effect:"fade",duration: 700},
	show:{effect:"fade",duration: 700}
    });
    /////////////////////////////
    /////DATOS DE CATEGORIA/////
    ///////////////////////////
    $("#ver_1").click(function(e){
        $.ajax({
            url:'ver_categorias',
            type:'POST',
            success: function(respuesta){
                if(respuesta=='error'){
                    $("#tabla1").html("<div class='tabla' id='tabla_categoria'><div class='fila'><div class='columna_primera'>Nombre</div><div class='columna_primera'>Eliminar</div></div></div>");
                }else{
                    var resp = JSON.parse(respuesta);
                    $("#tabla1").html("<div class='tabla' id='tabla_categoria'><div class='fila'><div class='columna_primera'>Nombre</div><div class='columna_primera'>Eliminar</div></div></div>");
                    for(var i=0;i<resp.length;i++){
                        $("#tabla_categoria").append("<div data-id='"+resp[i].idcategorias+"' class='fila' id='cat"+i+"'><div class='columna'>"+resp[i].nombre+"</div><div class='columna'><img id='borrarcat"+i+"' data-id='"+resp[i].idcategorias+"' data-fila='cat"+i+"' src='web/img/borrar.png'></div></div>");
                        $("#borrarcat"+i).click(function(e){
                            idfila=$(this).attr("data-fila");
                            id=$(this).attr("data-id");
                            $.ajax({
                                url:'borrar_categoria',
                                data: 'id='+id,
                                type:'POST',
                                success: function(respuesta){
                                    if(respuesta=="error"){
                                        alert("error al borrar");
                                    }else{
                                        $('#'+idfila).hide("slow");
                                    }
                                }
                            });
                            return false;
                        });
                        $('#cat'+i).click(function(e) {
                            var id=$(this).attr("data-id");
                            $.ajax({
                                url:'datos_categoria',
                                data: 'id='+id,
                                type:'POST',
                                success: function(respuesta){
                                    if(respuesta=="error"){
                                        alert("error al cargar los datos");
                                    }else{
                                        var resp = JSON.parse(respuesta);
                                        $("#id1").val(resp.idcategorias);
                                        $("#nombre").val(resp.nombre);
                                    }
                                }
                            });
                            $('#editar_categoria').dialog("open");
                        });
                    }
                }
                $("#tabla1").slideDown("slow");
            }//cierre succes
        });
    });
    $("#no_1").click(function(e){
        $("#tabla1").hide("slow");
    });
    /////////////////////////////
    /////DATOS DE PRODUCTO//////
    ///////////////////////////
    $("#ver_2").click(function(e){
        $.ajax({
            url:'ver_productos',
            type:'POST',
            success: function(respuesta){
                if(respuesta=='error'){
                    $("#tabla2").html("<div class='tabla' id='tabla_productos'><div class='fila'><div class='columna_primera'>Nombre</div><div class='columna_primera'>categoria</div><div class='columna_primera'>foto</div><div class='columna_primera'>Eliminar</div></div></div>");
                }else{
                    var resp = JSON.parse(respuesta);
                    $("#tabla2").html("<div class='tabla' id='tabla_productos'><div class='fila'><div class='columna_primera'>Nombre</div><div class='columna_primera'>categoria</div><div class='columna_primera'>foto</div><div class='columna_primera'>Eliminar</div></div></div>");
                    for(var i=0;i<resp.length;i++){
                        $("#tabla_productos").append("<div class='fila' data-id='"+resp[i].id+"' id='pro"+i+"'><div class='columna'>"+resp[i].nombrepro+"</div><div class='columna'>"+resp[i].nombrecat+"</div><div class='columna'><img src='web/img/productos/"+resp[i].foto+"' style='height:40px;'></div><div class='columna'><img id='borrarpro"+i+"' data-id='"+resp[i].id+"' data-fila='pro"+i+"' src='web/img/borrar.png'></div></div>");
                        $("#borrarpro"+i).click(function(e){
                            idfila=$(this).attr("data-fila");
                            id=$(this).attr("data-id");
                            $.ajax({
                                url:'borrar_producto',
                                data: 'id='+id,
                                type:'POST',
                                success: function(respuesta){
                                    if(respuesta=="error"){
                                        alert("error al borrar");
                                    }else{
                                        $('#'+idfila).hide("slow");
                                    }
                                }
                            });
                            return false;
                        });
                        $('#pro'+i).click(function(e) {
                            var id=$(this).attr("data-id");
                            $.ajax({
                                url:'datos_producto',
                                data: 'id='+id,
                                type:'POST',
                                success: function(respuesta){
                                    if(respuesta=="error"){
                                        alert("error al cargar los datos");
                                    }else{
                                        var resp = JSON.parse(respuesta);
                                        $("#id2").val(resp.idproductos);
                                        $("#nombre2").val(resp.nombre);
                                        $(".jqte_editor").html(resp.descripcion);
                                        $("#previa").attr("src","web/img/productos/"+resp.foto);
                                        $("#cate").val(resp.categorias_idcategorias);
                                    }
                                }
                            });
                            $('#editar_producto').dialog("open");
                        });
                    }
                }
                $("#tabla2").slideDown("slow");
            }//cierre succes
        });
    });
    $("#no_2").click(function(e){
        $("#tabla2").hide("slow");
    });
    /////////////////////////////
    /////DATOS DE USUARIO///////
    ///////////////////////////
    $("#ver_3").click(function(e){
        $.ajax({
            url:'ver_usuarios',
            type:'POST',
            success: function(respuesta){
                if(respuesta=='error'){
                    $("#tabla3").html("<div class='tabla' id='tabla_usuarios'><div class='fila'><div class='columna_primera'>Nombre</div><div class='columna_primera'>Tipo</div><div class='columna_primera'>Telefono</div><div class='columna_primera'>Eliminar</div></div></div>");
                }else{
                    var resp = JSON.parse(respuesta);
                    $("#tabla3").html("<div class='tabla' id='tabla_usuarios'><div class='fila'><div class='columna_primera'>Nombre</div><div class='columna_primera'>Tipo</div><div class='columna_primera'>Telefono</div><div class='columna_primera'>Eliminar</div></div></div>");
                    for(var i=0;i<resp.length;i++){
                        $("#tabla_usuarios").append("<div class='fila' data-id='"+resp[i].idusuarios+"' id='usu"+i+"'><div class='columna'>"+resp[i].nombre+"</div><div class='columna'>"+resp[i].rol+"</div><div class='columna'>"+resp[i].telefono+"</div><div class='columna'><img id='borrarusu"+i+"' data-id='"+resp[i].idusuarios+"' data-fila='usu"+i+"' src='web/img/borrar.png'></div></div>");
                        $("#borrarusu"+i).click(function(e){
                            idfila=$(this).attr("data-fila");
                            id=$(this).attr("data-id");
                            $.ajax({
                                url:'borrar_usuario',
                                data: 'id='+id,
                                type:'POST',
                                success: function(respuesta){
                                    if(respuesta=="error"){
                                        alert("error al borrar");
                                    }else{
                                        $('#'+idfila).hide("slow");
                                    }
                                }
                            });
                            return false;
                        });
                        $('#usu'+i).click(function(e) {
                            var id=$(this).attr("data-id");
                            $.ajax({
                                url:'datos_usuario',
                                data: 'id='+id,
                                type:'POST',
                                success: function(respuesta){
                                    if(respuesta=="error"){
                                        alert("error al cargar los datos");
                                    }else{
                                        var resp = JSON.parse(respuesta);
                                        $("#id3").val(resp.idusuarios);
                                        $("#nombre3").val(resp.nombre);
                                        $("#correo").val(resp.correo);
                                        $("#correo2").val(resp.correo);
                                        $("#calle").val(resp.calle);
                                        $("#num").val(resp.numero);
                                        $("#provincia").val(resp.provincia);
                                        $("#poblacion").val(resp.poblacion);
                                        $("#rol").val(resp.rol);
                                        $("#telefono").val(resp.telefono);
                                    }
                                }
                            });
                            $('#editar_usuario').dialog("open");
                        });
                    }
                }
                $("#tabla3").slideDown("slow");
            }//cierre succes
        });
    });
    $("#no_3").click(function(e){
        $("#tabla3").hide("slow");
    });
    /////////////////////////////
    /////DATOS DE PEDIDO////////
    ///////////////////////////
    $("#ver_4").click(function(e){
        $.ajax({
            url:'ver_pedidos',
            type:'POST',
            success: function(respuesta){
                if(respuesta=='error'){
                    $("#tabla4").html("<div class='tabla' id='tabla_pedidos'><div class='fila'><div class='columna_primera'>Demandante</div><div class='columna_primera'>ID Pedido</div><div class='columna_primera'>Fecha</div><div class='columna_primera'>Comentario</div><div class='columna_primera'>Eliminar</div></div></div>");
                }else{
                    var resp = JSON.parse(respuesta);
                    $("#tabla4").html("<div class='tabla' id='tabla_pedidos'><div class='fila'><div class='columna_primera'>Demandante</div><div class='columna_primera'>ID Pedido</div><div class='columna_primera'>Fecha</div><div class='columna_primera'>Comentario</div><div class='columna_primera'>Eliminar</div></div></div>");
                    for(var i=0;i<resp.length;i++){
                        $("#tabla_pedidos").append("<div class='fila' data-id='"+resp[i].id+"' id='ped"+i+"'><div class='columna'>"+resp[i].nombre+"</div><div class='columna'>"+resp[i].id+"</div><div class='columna'>"+resp[i].fecha+"</div><div class='columna'>"+resp[i].comentario+"</div><div class='columna'><img id='borrarpedido"+i+"' data-id='"+resp[i].id+"' data-fila='ped"+i+"' src='web/img/borrar.png'></div></div>");
                        $("#borrarpedido"+i).click(function(e){
                            idfila=$(this).attr("data-fila");
                            id=$(this).attr("data-id");
                            $.ajax({
                                url:'borrar_pedido',
                                data: 'id='+id,
                                type:'POST',
                                success: function(respuesta){
                                    if(respuesta=="error"){
                                        alert("error al borrar");
                                    }else{
                                        $('#'+idfila).hide("slow");
                                    }
                                }
                            });
                            return false;
                        });
                        $('#ped'+i).click(function(e) {
                            var id=$(this).attr("data-id");
                            $.ajax({
                                url:'datos_pedido',
                                data: 'id='+id,
                                type:'POST',
                                success: function(respuesta){
                                    if(respuesta=="error"){
                                        alert("error al cargar los datos");
                                    }else{
                                        var resp = JSON.parse(respuesta);
                                        $("#numpedido").html(resp[0].pedido);
                                        $("#nombrecliente").html(resp[0].nombre+"("+resp[0].correo+")");
                                        $("#telefonocliente").html(resp[0].telefono);
                                        $("#tabla_productos").html("<div class='fila'><div class='columna_primera'>Foto</div><div class='columna_primera'>Producto</div><div class='columna_primera'>Cantidad</div><div class='columna_primera'>Eliminar</div></div>");
                                        for(var i=0;i<resp.length;i++){
                                            $("#tabla_productos").append("<div id='art"+i+"' class='fila'><div class='columna'><img src='web/img/productos/"+resp[i].foto+"' style='height:30px'></div><div class='columna'>"+resp[i].nombrepro+"</div><div class='columna'>"+resp[i].cantidad+"</div><div class='columna'><img id='borrararticulo"+i+"' data-id='"+resp[i].id+"' data-fila='art"+i+"' src='web/img/borrar.png'></div></div>");
                                            $("#borrararticulo"+i).click(function(e){
                                                idfila=$(this).attr("data-fila");
                                                id=$(this).attr("data-id");
                                                $.ajax({
                                                    url:'borrar_articulo',
                                                    data: 'id='+id,
                                                    type:'POST',
                                                    success: function(respuesta){
                                                        if(respuesta=="error"){
                                                            alert("error al borrar");
                                                        }else{
                                                            $('#'+idfila).hide("slow");
                                                        }
                                                    }
                                                });
                                                return false;
                                            });
                                        }
                                    }
                                }
                            });
                            $('#editar_pedido').dialog("open");
                        });
                    }
                }
            $("#tabla4").slideDown("slow");
            }//cierre succes
        });
    });
    $("#no_4").click(function(e){
        $("#tabla4").hide("slow");
    });
    /////////////////////////////
    ////DATOS DE PRESUPUESTO////
    ///////////////////////////
    $("#ver_5").click(function(e){
        $.ajax({
            url:'ver_presupuestos',
            type:'POST',
            success: function(respuesta){
                if(respuesta=='error'){
                    $("#tabla5").html("<div class='tabla' id='tabla_presupuestos'><div class='fila'><div class='columna_primera'>ID pedido</div><div class='columna_primera'>Mensaje</div><div class='columna_primera'>Presupuestado</div><div class='columna_primera'>Eliminar</div></div></div>");
                }else{
                    var resp = JSON.parse(respuesta);
                    $("#tabla5").html("<div class='tabla' id='tabla_presupuestos'><div class='fila'><div class='columna_primera'>ID pedido</div><div class='columna_primera'>Mensaje</div><div class='columna_primera'>Presupuestado</div><div class='columna_primera'>Eliminar</div></div></div>");
                    for(var i=0;i<resp.length;i++){
                        $("#tabla_presupuestos").append("<div class='fila' data-id='"+resp[i].idpresupuestos+"' id='pre"+i+"'><div class='columna'>"+resp[i].idpresupuestos+"</div><div class='columna'>"+resp[i].mensaje+"</div><div class='columna'>"+resp[i].presupuestado+"</div><div class='columna'><img src='web/img/borrar.png'></div></div>");
                        $('#pre'+i).click(function(e) {
                            $('#editar_presupuesto').dialog("open");
                        });
                    }
                }
            $("#tabla5").slideDown("slow");
            }//cierre succes
        });
    });
    $("#no_5").click(function(e){
        $("#tabla5").hide("slow");
    });
});