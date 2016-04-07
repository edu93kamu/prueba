<?php


class Presupuesto extends DBAbstractModel{
    public function obtener(){
        $sql = "SELECT * FROM presupuestos";
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
}
