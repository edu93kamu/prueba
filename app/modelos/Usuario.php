<?php
/**
 * Modelo de Usuario. Gestiona las conexiones a base de datos de login, registro y
 * todas las referentes a explotar la tabla de usuarios. Extiende de DBAbstractModel
 */
class Usuario extends DBAbstractModel {
    public function insertar($datos){
        foreach($datos as $k=>$v){
            $$k= limpiar_datos($v);
        }
        $pass = md5($clave);
        $sql = "INSERT INTO usuarios (nombre, correo, clave ,calle, numero, provincia, poblacion, telefono, rol) VALUES ('$nombre3','$correo', '$pass', '$calle', $numero, '$provincia','$poblacion',$telefono,'$rol')";
        if($this->con->query($sql)){
            return $this->con->insert_id;
        }else{
            $this->error_sql = $this->con->error;
            return false;
        }
    }
    /**
     * funcion para comprobar que no exista el email en la base de datos al registrar
     * 
     * @param $email correo que se comprueba
     * @return false si no esta o la fila si existe
     */
    
    public function obtener_por_email($email){
        $email=$email;
        $sql = "SELECT * FROM usuarios WHERE correo='$email'";
        //Ejecutamos la query
        $resultado = $this->con->query($sql);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        //Cogemos la primera fila de la SQL o false si no hay ninguna fila y lo devolvemos
        $fila = $resultado->fetch_assoc();
        return $fila;
    }
    public function comprobar_correo($email){
        $sql = "SELECT * FROM usuarios WHERE correo='$email'";
        //Ejecutamos la query
        if(!$this->con->query($sql)){
            //Si no se ejecuta bien guardamos el error en la propiedad error_sql
            $this->error_sql = $this->con->error;
        }
        //Si el número de filas afectadas es 1 es que el email/password existe
        if($this->con->affected_rows == 1){
            return true;
        }else{
            return false;
        }
    }
    public function coger_por_id($id){
        $sql = "SELECT * FROM usuarios WHERE idusuarios='$id'";
        //Ejecutamos la query
        $resultado = $this->con->query($sql);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        //Cogemos la primera fila de la SQL o false si no hay ninguna fila y lo devolvemos
        $fila = $resultado->fetch_assoc();
        return $fila;
    }
   
    /**
     * Comprueba el email y clave en la base de datos y que el usuario esté validado
     * @param type $email el email del usuario
     * @param type $password el password del usuario 
     * @return boolean Devuelve true si se encuenta el email/password y está validado 
     * en la base de datos y false si no lo encuentra.
     */
    public function comprobar_login($email,$password){
        $email=  limpiar_datos($email);
        $password=$password;
        $sql="Select * from usuarios where correo='$email' and clave=md5('$password')";
        //Ejecutamos la sql.
        if(!$this->con->query($sql)){
            //Si no se ejecuta bien guardamos el error en la propiedad error_sql
            $this->error_sql = $this->con->error;
        }
        //Si el número de filas afectadas es 1 es que el email/password existe
        if($this->con->affected_rows == 1){
            return true;
        }else{
            return false;
        }
    }
    public function obtener(){
        $sql = "SELECT * FROM usuarios order by nombre";
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
    
    public function actualizar($datos){
        foreach($datos as $k=>$v){
            $$k= limpiar_datos($v);
        }
        $sql = "UPDATE usuarios SET nombre = '$nombre3', calle='$calle', numero=$numero, provincia='$provincia', poblacion='$poblacion', telefono=$telefono, rol='$rol' WHERE idusuarios=$id3";
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
        $sql = "DELETE FROM usuarios WHERE idusuarios=$id";
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
