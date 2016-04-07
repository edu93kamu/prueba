<?php

class ControladorPublico {
    
    public function inicio(){
        require '../app/vistas/inicio.php';
    }
    public function productos(){
        require '../app/vistas/productos.php';
    }
    public function quien_somos(){
        require '../app/vistas/quien_somos.php';
    }
    public function contacto(){
        require '../app/vistas/contacto.php';
    }
    
}
