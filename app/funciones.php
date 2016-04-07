<?php

function limpiar_datos($datos){
	$datos = trim($datos); 	//Quita los espacios en blanco del principio y del final
	$datos = htmlentities($datos);	//Quita caracteres con algún significado para HTML (<,>,...)
	$con = new mysqli(Config::$bd_host, Config::$bd_user , 
                Config::$bd_password, Config::$bd_schema);
	$datos =  $con->real_escape_string($datos); //"escapa" las comillas para BD.
	return $datos;
}
function limpiar_datos_textos($datos){
        $datos = str_replace('<style', '&lt;style', $datos);
	$datos = str_replace('</style', '&lt;/style', $datos);
        $datos = str_replace('<script', '&lt;script', $datos);
	$datos = str_replace('</script', '&lt;/script', $datos);
        $datos = str_replace('<div', '&lt;div', $datos);
	$datos = str_replace('</div', '&lt;/div', $datos);
	return $datos;
}
