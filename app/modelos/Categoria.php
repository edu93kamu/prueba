<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categoria
 *
 * @author CALIDAD
 */
class Categoria extends DBAbstractModel {
    public function obtener(){
        $sql = "SELECT * FROM categorias order by nombre";
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
        $id=  limpiar_datos($id);
        $sql = "SELECT * FROM categorias WHERE idcategorias=$id";
        //Ejecutamos la query
        $resultado = $this->con->query($sql);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        return $resultado->fetch_assoc();
    }
    public function insertar($datos){
        foreach($datos as $k=>$v){
            $$k= limpiar_datos($v);
        }
        $sql = "INSERT INTO categorias (nombre) VALUES ('$nombre')";
        //Ejecutamos la query
        $resultado = $this->con->query($sql);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        return true;
    }
    public function actualizar($datos){
        foreach($datos as $k=>$v){
            $$k= limpiar_datos($v);
        }
        $sql = "UPDATE categorias SET nombre = '$nombre' WHERE idcategorias=$id1";
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
        $sql = "DELETE FROM categorias WHERE idcategorias=$id";
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
