$(document).ready(function(e){
    $("textarea").jqte();
    
    //TODO LO REFERENTE AL REGISTRO DE CATEGORIAS
    $('#reg_categoria').dialog({
	autoOpen:false,
	heigh:300,
	width:300,
	modal:true,
	title:"Registro de categorias",
	hide:{effect:"fade",duration: 700},
	show:{effect:"fade",duration: 700}
    });
    $('#num1').click(function(e) {
        $('#reg_categoria').dialog("open");
    });
    $('#formulario_categoria').submit(function(e){
        e.preventDefault();//parar la ejecucion de el evento del formulario de enviar
        var datos_formulario=$('#formulario_categoria').serialize();
        $.ajax({
            url:'insertar_categoria',
            data: datos_formulario,
            type:'POST',
            success: function(respuesta){
                if(respuesta=='error'){
                    alert('error al insertar');
                }else{
                    document.getElementById("formulario_categoria").reset();
                    $('#reg_categoria').dialog("close");
                }
            }//cierre succes
        });
        return false;
    });
    
    //TODO LO REFERENTE AL REGISTRO DE PRODUCTOS
    $('#reg_producto').dialog({
	autoOpen:false,
	heigh:300,
	width:500,
	modal:true,
	title:"Registro de productos",
	hide:{effect:"fade",duration: 700},
	show:{effect:"fade",duration: 700}
    });
    $('#num2').click(function(e) {
        $('#reg_producto').dialog("open");
    });
    $('#formulario_producto').submit(function(e){
        e.preventDefault();//parar la ejecucion de el evento del formulario de enviar
        var datos_formulario= new FormData($("#formulario_producto")[0]);
        $.ajax({
            url:'insertar_producto',
            data: datos_formulario,
            type:'POST',
            contentType: false,
            processData: false,
            success: function(respuesta){
                if(respuesta=='error'){
                    alert('error al insertar');
                }else{
                    document.getElementById("formulario_producto").reset();
                    $('#reg_producto').dialog("close");
                }
            }//cierre succes
        });
        return false;
    });
    
    function archivo(evt) {
    	$("#previa").attr("src", "web/img/preloader.gif");
        setTimeout(function(){
            var files = evt.target.files; // FileList object
            // Obtenemos la imagen del campo "file".
            for (var i = 0, f; f = files[i]; i++) {
                //Solo admitimos imágenes.
                if (!f.type.match('image.*')) {
                    continue;
                }
                var reader = new FileReader();
                reader.onload = (function(theFile) {
                    return function(e) {
                        // Insertamos la imagen
                        document.getElementById("list").innerHTML = ['<br><img class="previa" id="previa" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                    };
                })(f);
                reader.readAsDataURL(f);
            }
      	},3000);
    }
    $('#list').click(function(e){
    	$('#files').click();
    });
    document.getElementById("files").addEventListener("change", archivo, false);
    
    //TODO LO REFERENTE AL REGISTRO DE USUARIOS
    $('#reg_usuario').dialog({
	autoOpen:false,
	heigh:300,
	width:500,
	modal:true,
	title:"Registro de usuarios",
	hide:{effect:"fade",duration: 700},
	show:{effect:"fade",duration: 700}
    });
    $('#num3').click(function(e) {
        $('#reg_usuario').dialog("open");
    });
    $('#formulario_usuario').submit(function(e){
        e.preventDefault();//parar la ejecucion de el evento del formulario de enviar
        var correo1=$("#correo").val();
        var correo2=$("#correo2").val();
        var clave1=$("#clave").val();
        var clave2=$("#clave2").val();
        if(correo1!=correo2){
            alert("los correos no coinciden");
        }else{
            $.ajax({
                url:'comprobar_correo',
                data: 'correo='+correo1,
                type:'POST',
                success: function(respuesta){
                    alert(respuesta);
                    if(respuesta=='existe'){
                        var error="error";
                    }else{
                        var error="no";
                    }
            if(error=="error"){
                alert("el correo ya existe");
            }else{
                if(clave1!=clave2){
                    alert("las contraseñas no coinciden");
                }else{
                    var datos_formulario=$('#formulario_usuario').serialize();
                    $.ajax({
                        url:'insertar_usuario',
                        data: datos_formulario,
                        type:'POST',
                        success: function(respuesta){
                            if(respuesta=='error'){
                                alert('error al insertar');
                            }else{
                                document.getElementById("formulario_usuario").reset();
                                $('#reg_usuario').dialog("close");
                            }
                        }//cierre succes
                    });
                }
            }
            
                }//cierre succes
            });
        }
    });
});