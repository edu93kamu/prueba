<?php
/**
 * Modelo de SesionUsuario. Gestiona las conexiones a base de datos a la hora
 * de iniciar y cerrar sesion
 */
class SesionUsuario {
    /**
     * Inicia la sesión de un usuario con el email pasado por parámetro. Guarda en la
     * sesión el email y el id de usuario
     * @param string $email email del usuario con el que se inicia sesión
     * @return boolean Devuelve true si el email existe y se ha podido iniciar sesión, 
     * y false en caso contrario
     */
    public static function iniciar_sesion($email){
        $usuario = new Usuario();
        $datos_usuario = $usuario->obtener_por_email($email);
        if(!$datos_usuario){
            return false;  
        }else{
            $_SESSION['idusuario']=$datos_usuario['idusuarios'];
            $_SESSION['email']=$email;
            $_SESSION['rol']=$datos_usuario['rol'];
            $carro=array();
            //array_push($carro,array("Perro", "Gato"));
            $_SESSION['carro']=$carro;
            return true;
        }
    }
    /**
     * Cierra la sesión de usuario
     */
    public static function cerrar_sesion(){
        session_destroy();
    }
    
    /**
     * Comprueba si el usuario ha iniciado sesión o no
     * @return boolean Devuelve true si el usuario ha iniciado sesión y false en caso
     * contrario
     */
    public static function existe_sesion(){
        return isset($_SESSION['email']);
    }
    
    public static function obtener_email(){
        if(self::existe_sesion()){
            return $_SESSION['email'];
        }else{
            return false;
        }
    }
    
    public static function obtener_id(){
        if(self::existe_sesion()){
            return $_SESSION['idusuario'];
        }else{
            return false;
        }
    }
    
    public static function obtener_rol(){
        if(self::existe_sesion()){
            return $_SESSION['rol'];
        }else{
            return false;
        }
    }
    public static function obtener_carro(){
        if(self::existe_sesion()){
            return $_SESSION['carro'];
        }else{
            return false;
        }
    }
    public static function anadir_carro($id, $cantidad){
        if(self::existe_sesion()){
            $cont=0;
            $carro=$_SESSION["carro"];
            $longitud=count($carro);
            for($i=0;$i<$longitud;$i++){
                if($carro[$i][0]==$id){
                    $_SESSION["carro"][$i][1]=$cantidad;
                    $cont=1;
                }
            }
            if($cont==0){
                array_push($_SESSION['carro'],array($id, $cantidad));
            }
            return true;
        }else{
            return false;
        }
    }
    public static function resetear_carro(){
        unset($_SESSION['carro']);
        $carro=array();
        $_SESSION['carro']=$carro;
    }
}