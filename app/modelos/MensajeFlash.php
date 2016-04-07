<?php

/**
 * Clase para guardar y mostrar mensajes al usuario
 *
 * @author Usuario1
 */
class MensajeFlash {
    /**
     * Función que guarda un mensaje de texto para mostrarlo en la siguiente página que llame a mostrar_mensaje()
     * @param type $mensaje Mensaje de texto a guardar
     */
    public static function guardar_mensaje($mensaje){
        $_SESSION['Mensaje_flash']=$mensaje;
    }
    /**
     * Función que excribe en la pantalla el mensaje de texto guardado y lo borra de la memoria.
     * El mensaje tendrá el id="Mensaje_flash"
     */
    public static function mostrar_mensaje(){
        if(isset($_SESSION['Mensaje_flash'])){
            echo '<span id="mensaje_flash">'. $_SESSION['Mensaje_flash'].'</span>';
            unset($_SESSION['Mensaje_flash']);
        }
    }
}
