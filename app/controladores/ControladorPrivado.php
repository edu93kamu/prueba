<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorPrivado
 *
 * @author CALIDAD
 */
class ControladorPrivado {
    public function inicio_logueado(){
        $obj_ControladorCategoria= new ControladorCategoria();
        $categorias= $obj_ControladorCategoria->cargar_categorias();
        unset($obj_ControladorCategoria);
        //Incluimos la vista
        include '../app/vistas/inicio_logueado.php';
        //Incluimos la plantilla
        include '../app/vistas/plantilla_privada.php';
    }
    public function registros(){
        $obj_ControladorCategoria= new ControladorCategoria();
        $categorias= $obj_ControladorCategoria->cargar_categorias();
        unset($obj_ControladorCategoria);
        //Incluimos la vista
        include '../app/vistas/registros.php';
        //Incluimos la plantilla
        include '../app/vistas/plantilla_privada.php';
    }
    public function consultar_datos(){
        $obj_ControladorCategoria= new ControladorCategoria();
        $categorias= $obj_ControladorCategoria->cargar_categorias();
        unset($obj_ControladorCategoria);
        //Incluimos la vista
        include '../app/vistas/datos.php';
        //Incluimos la plantilla
        include '../app/vistas/plantilla_privada.php';
    }
    public function carro(){
        //recogida de datos de productos
        
        $carro=SesionUsuario::obtener_carro();
        $obj_producto=new Producto();
        $carro2=array();
        foreach ($carro as $k => $producto) {
            $recogido=$obj_producto->coger_por_id($producto[0]);
            $recogido['cantidad']=$producto[1];
            array_push($carro2, $recogido);
        }
        unset($obj_producto);
        
        //cargado de categorias
        $obj_ControladorCategoria= new ControladorCategoria();
        $categorias= $obj_ControladorCategoria->cargar_categorias();
        unset($obj_ControladorCategoria);
        //Incluimos la vista
        include '../app/vistas/carro.php';
        //Incluimos la plantilla
        include '../app/vistas/plantilla_privada.php';
    }
    public function vaciar_carro(){
        //borrado del carro
        SesionUsuario::resetear_carro();
        $carro=false;
        //cargado de categorias
        $obj_ControladorCategoria= new ControladorCategoria();
        $categorias= $obj_ControladorCategoria->cargar_categorias();
        unset($obj_ControladorCategoria);
        //Incluimos la vista
        include '../app/vistas/carro.php';
        //Incluimos la plantilla
        include '../app/vistas/plantilla_privada.php';
    }
    public function ver_articulos(){
        echo count(SesionUsuario::obtener_carro());
    }
}
