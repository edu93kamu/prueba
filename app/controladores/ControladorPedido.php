<?php


class ControladorPedido {
    public function insertar(){
        $obj_pedido= new Pedido();
        $pedido=$obj_pedido->insertar($_POST);
        if($pedido){
            $obj_pedido->insertar_articulos_pedidos($pedido);
            unset($obj_pedido);
            MensajeFlash::guardar_mensaje("Pedido realizado");
            SesionUsuario::resetear_carro();
            $correo="edu93kamu@gmail.com";
            $mensaje="pedido nuevo realizado por ".SesionUsuario::obtener_email();
            mail($correo,'Pedido',$mensaje);
            header('location: inicio_logueado');
        }else{
            unset($obj_pedido);
            MensajeFlash::guardar_mensaje("Error al realizar pedido");
            header('location: inicio_logueado');
        }
    }
    public function consultar(){
        $obj_pedido= new Pedido();
        $pedidos=$obj_pedido->obtener();
        unset($obj_pedido);
        if(!$pedidos){
           echo('error');
       }else{
           echo json_encode($pedidos);
       }
    }
    public function borrar(){
        $obj_pedido= new Pedido();
        $pedidos=$obj_pedido->borrar($_POST['id']);
        unset($obj_pedido);
        if(!$pedidos){
           echo('error');
       }else{
           echo ('ok');
       }
    }
    public function borrar_articulo(){
        $obj_pedido= new Pedido();
        $pedidos=$obj_pedido->borrar_articulo($_POST['id']);
        unset($obj_pedido);
        if(!$pedidos){
           echo('error');
       }else{
           echo ('ok');
       }
    }
    public function datos(){
        $obj_pedido=new Pedido();
        $articulos=$obj_pedido->ver_un_pedido($_POST['id']);
        unset($obj_pedido);
        if(!$articulos){
            echo "error";
        }else{
            echo json_encode($articulos);
        }
    }
}
