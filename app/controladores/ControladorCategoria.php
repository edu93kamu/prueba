<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorCategoria
 *
 * @author CALIDAD
 */
class ControladorCategoria {
    public function cargar_categorias(){
        $obj_categoria= new Categoria;
        $categorias=$obj_categoria->obtener();
        unset($obj_categoria);
        return $categorias;
    }
    public function insertar_categoria(){
        $obj_categoria= new Categoria;
        if($categorias=$obj_categoria->insertar($_POST)){
            unset($obj_categoria);
            echo "ok";
        }else{
            unset($obj_categoria);
            echo "error";
        }
    }
    public function consultar(){
        $obj_categoria= new Categoria;
        $categorias=$obj_categoria->obtener();
        unset($obj_categoria);
        if(!$categorias){
           echo('error');
       }else{
           echo json_encode($categorias);
       }
    }
    public function datos(){
        $obj_categoria= new Categoria;
        $categorias=$obj_categoria->coger_por_id($_POST['id']);
        unset($obj_categoria);
        if(!$categorias){
           echo('error');
       }else{
           echo json_encode($categorias);
       }
    }
    public function actualizar(){
        $obj_categoria= new Categoria;
        $categorias=$obj_categoria->actualizar($_POST);
        unset($obj_categoria);
        if(!$categorias){
            MensajeFlash::guardar_mensaje("error al actualizar");
           header('location: consultar_datos');
       }else{
           header('location: consultar_datos');
       }
    }
    public function borrar(){
        $obj_categoria= new Categoria();
        $categorias=$obj_categoria->borrar($_POST['id']);
        unset($obj_categoria);
        if(!$categorias){
           echo('error');
       }else{
           echo ('ok');
       }
    }
}
