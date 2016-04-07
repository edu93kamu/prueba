<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Producto
 *
 * @author CALIDAD
 */
class Producto extends DBAbstractModel {
    public function subir_foto($foto){
        $origen=$foto['tmp_name'];
	$destino='img/productos/'.$foto['name'];
	$cont=0;
	while(file_exists($destino)){
		$destino="img/productos/$cont".$foto['name'];
		$cont++;
	}
	if(move_uploaded_file($origen,$destino)){
		$destino=  explode("/", $destino);
		return $destino[2];
	}else{
		return false;
	}
    }
    public function insertar($datos,$image){
        foreach($datos as $k=>$v){
            $$k= limpiar_datos($v);
        }
        $descripcion=  limpiar_datos_textos($descripcion);
        $sql = "INSERT INTO productos (nombre,descripcion,foto,categorias_idcategorias) VALUES ('$nombre2','$descripcion','$image',$cate)";
        //Ejecutamos la query
        $resultado = $this->con->query($sql);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        return true;
    }
    public function obtener(){
        $sql = "SELECT productos.idproductos as id, productos.nombre as nombrepro, categorias.nombre as nombrecat, productos.foto as foto FROM productos, categorias WHERE categorias.idcategorias=productos.categorias_idcategorias order by productos.nombre";
        //Ejecutamos la query
        $resultado = $this->con->query($sql);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        //Cogemos la primera fila de la SQL o false si no hay ninguna fila y lo devolvemos
        $filas = false;
        while($fila=$resultado->fetch_assoc()){
            $filas[]=$fila;
        }
        $sql2 = "SELECT idproductos as id, nombre as nombrepro, categorias_idcategorias as nombrecat, foto as foto FROM productos WHERE categorias_idcategorias is null";
        //Ejecutamos la query
        $resultado2 = $this->con->query($sql2);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado2){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        $filas2 = false;
        while($fila2=$resultado2->fetch_assoc()){
            $filas2[]=$fila2;
        }
        if($filas2!=null){
            for ($k=0;$k<count($filas2);$k++) {
                array_push($filas, $filas2[$k]);
            }
        }
        return $filas;
    }
    public function buscar($criterio){
        if($criterio==""){
            $sql="SELECT * FROM productos";
        }else{
            if(is_numeric($criterio)) {
                $sql = "SELECT * FROM productos WHERE categorias_idcategorias=$criterio";
            }else{
                $sql = "SELECT * FROM productos WHERE nombre LIKE '%$criterio%' OR descripcion LIKE '%$criterio%'";
            }
        }
        //Ejecutamos la query
        $resultado = $this->con->query($sql);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        //Cogemos la primera fila de la SQL o false si no hay ninguna fila y lo devolvemos
        $filas = false;
        while($fila=$resultado->fetch_assoc()){
            $filas[]=$fila;
        }
        return $filas;
    }
    public function coger_por_id($id){
        $sql = "SELECT * FROM productos WHERE idproductos=$id";
        //Ejecutamos la query
        $resultado = $this->con->query($sql);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        return $resultado->fetch_assoc();
    }
    public function actualizar($datos){
        foreach($datos as $k=>$v){
            $$k= limpiar_datos($v);
        }
        $descripcion=  limpiar_datos_textos($descripcion);
        $sql = "UPDATE productos SET nombre = '$nombre2', descripcion='$descripcion', categorias_idcategorias=$cate WHERE idproductos=$id2";
        //Ejecutamos la query
        $resultado = $this->con->query($sql);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        return true;
    }
    public function borrar($id){
        $sql = "DELETE FROM productos WHERE idproductos=$id";
        //Ejecutamos la query
        $resultado = $this->con->query($sql);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        return true;
    }
}
