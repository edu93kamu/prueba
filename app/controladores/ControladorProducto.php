<?php

class ControladorProducto {
    public function insertar_producto(){
        $obj_producto= new Producto();
        if($_FILES['files']['tmp_name']!=""){
            $foto=$obj_producto->subir_foto($_FILES['files']);
            if($foto){
                if($obj_producto->insertar($_POST,$foto)){
                    echo "ok";
                }else{
                    echo "error1".$obj_producto->error_sql;
                }
            }
        }else{
            if($obj_producto->insertar($_POST,"default.png")){
                echo "ok";
            }else{
                echo "error2".$obj_producto->error_sql;
            }
	}
    }
    public function consultar(){
        $obj_producto= new Producto();
        $productos=$obj_producto->obtener();
        unset($obj_producto);
        if(!$productos){
           echo('error');
       }else{
           echo json_encode($productos);
       }
    }
    public function buscar(){
        $obj_ControladorCategoria= new ControladorCategoria();
        $categorias= $obj_ControladorCategoria->cargar_categorias();
        unset($obj_ControladorCategoria);
        $obj_producto= new Producto();
        $productos=$obj_producto->buscar($_POST['buscado']);
        unset($obj_producto);
        //Incluimos la vista
        include '../app/vistas/busqueda.php';
        //Incluimos la plantilla
        include '../app/vistas/plantilla_privada.php';
    }
    public function datos(){
        $obj_producto= new Producto();
        $productos=$obj_producto->coger_por_id($_POST['id']);
        unset($obj_producto);
        if(!$productos){
           echo('error');
       }else{
           echo json_encode($productos);
       }
    }
    public function actualizar(){
        $obj_producto= new Producto();
        $productos=$obj_producto->actualizar($_POST);
        unset($obj_producto);
        if(!$productos){
            MensajeFlash::guardar_mensaje("Error al actualizar");
            header('location: consultar_datos');
        }else{
            header('location: consultar_datos');
        }
    }
    public function borrar(){
        $obj_producto= new Producto();
        $productos=$obj_producto->borrar($_POST['id']);
        unset($obj_producto);
        if(!$productos){
           echo('error');
       }else{
           echo ('ok');
       }
    }
    public function anadir(){
        $producto=$_POST["id"];
        $cantidad=$_POST["cantidad"];
        if(SesionUsuario::anadir_carro($producto, $cantidad)){
            echo "ok";
        }else{
            echo "error";
        }
        
        
        //array_push($carro,array("Perro", "Gato"));
    }
}
