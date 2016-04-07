<?php

class ControladorUsuario {
    /**
     * funcion para registrar un nuevo usuario
     */
    public function insertar_usuario(){
        //Para acceder al modelo Usuario creamos un objeto de esa clase
        $usuario = new Usuario();
        if($usuario->insertar($_POST)){
            unset($usuario);
            echo "ok";
        }else{
            unset($usuario);
            echo "error";
        }
    }
    
    public function comprobar_correo(){
        //Creamos un objeto de la clase Usuario (modelo)
        $usuario = new Usuario();
        //Obtenemos los datos del usuario, si devuelve false es que no existe
        $datos = $usuario->comprobar_correo($_POST['correo']);
        unset($usuario);
        if($datos){
            echo ("existe");
        }else{
            echo ("error");
        }
    }
    
    /**
     * funcion para hacer el login de usuario 
     */
    public function login(){
        //Comprobamos el login y redirigimos a ultimas_publicaciones
        $usuario = new Usuario();
        if($usuario->comprobar_login($_POST['email'], $_POST['password'])){
            unset($usuario);
            //El usuario es correcto
            SesionUsuario::iniciar_sesion($_POST['email']);
            header('location: inicio_logueado');
        }else{
            unset($usuario);
            //Si el usuario es incorrecto volvemos a inicio
            MensajeFlash::guardar_mensaje('Usuario o clave incorrecto.');
            header('location: inicio');
        }
    }
    
    /**
     * funcion para cerrar la sesion y volver al indice
     */
    public function logout(){
        SesionUsuario::cerrar_sesion();
        header('location: inicio');
    }  
    
    public function consultar(){
        $obj_usuario= new Usuario();
        $usuarios=$obj_usuario->obtener();
        unset($obj_usuario);
        if(!$usuarios){
           echo('error');
       }else{
           echo json_encode($usuarios);
       }
    }
    public function datos(){
        $obj_usuario= new Usuario();
        $usuarios=$obj_usuario->coger_por_id($_POST['id']);
        unset($obj_usuario);
        if(!$usuarios){
           echo('error');
       }else{
           echo json_encode($usuarios);
       }
    }
    public function actualizar(){
        $obj_usuario= new Usuario();
        $usuarios=$obj_usuario->actualizar($_POST);
        unset($obj_usuario);
        if(!$usuarios){
            MensajeFlash::guardar_mensaje("Error al actualizar");
            header('location: consultar_datos');
        }else{
            header('location: consultar_datos');
        }
    }
    public function borrar(){
        $obj_usuario= new Usuario();
        $usuarios=$obj_usuario->borrar($_POST['id']);
        unset($obj_usuario);
        if(!$usuarios){
           echo('error');
       }else{
           echo ('ok');
       }
    }
}
