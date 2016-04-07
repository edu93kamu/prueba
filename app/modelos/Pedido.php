<?php


class Pedido extends DBAbstractModel {
    public function insertar($datos){
        $usuario=  SesionUsuario::obtener_id();
        $comentario=  limpiar_datos($datos['comentario']);
        $sql = "INSERT INTO pedidos (usuario,fecha,comentario) VALUES ($usuario, now(), '$comentario')";
        //Ejecutamos la query
        $resultado = $this->con->query($sql);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        return $this->con->insert_id;
    }
    public function insertar_articulos_pedidos($id){
        $carro=  SesionUsuario::obtener_carro();
        foreach ($carro as $k => $producto) {
            $articulo=$producto[0];
            $cantidad=$producto[1];
            $sql = "INSERT INTO articulos_pedidos (pedidos_idpedidos,productos_idproductos,cantidad) VALUES ($id, $articulo, $cantidad)";
            //Ejecutamos la query
            $resultado = $this->con->query($sql);
        }
        return true;
    }
    public function obtener(){
        $sql = "SELECT usuarios.nombre as nombre, pedidos.idpedidos as id, pedidos.fecha as fecha, pedidos.comentario as comentario FROM pedidos, usuarios WHERE usuarios.idusuarios=pedidos.usuario order by pedidos.fecha desc";
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
        $sql2 = "SELECT usuario as nombre, idpedidos as id, fecha as fecha, comentario as comentario FROM pedidos WHERE usuario is null";
        //Ejecutamos la query
        $resultado2 = $this->con->query($sql2);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado2){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        $filas2 = false;
        while($fila2=$resultado2->fetch_assoc()){
            $filas2[]=$fila2;
        }
        if($filas2!=null){
            for ($k=0;$k<count($filas2);$k++) {
                array_push($filas, $filas2[$k]);
            }
        }
        return $filas;
    }
    public function ver_un_pedido($id){
        $sql="select articulos_pedidos.idarticulos_pedidos as id, usuarios.nombre as nombre, usuarios.correo "
        . "as correo, usuarios.telefono as telefono, pedidos.idpedidos as pedido, "
        . "productos.nombre as nombrepro, productos.foto as foto, articulos_pedidos.cantidad "
        . "as cantidad from usuarios, productos, pedidos, articulos_pedidos where "
        . "usuarios.idusuarios=pedidos.usuario and pedidos.idpedidos=articulos_pedidos.pedidos_idpedidos "
        . "and articulos_pedidos.productos_idproductos=productos.idproductos and "
        . "articulos_pedidos.pedidos_idpedidos=$id";
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
    public function borrar($id){
        $sql = "DELETE FROM pedidos WHERE idpedidos=$id";
        //Ejecutamos la query
        $resultado = $this->con->query($sql);
        //Si ocurre un error en la sql lo guardamos en la propiedad error_sql
        if(!$resultado){
            $this->error_sql="Error en la SQL: " . $this->con->error;
            return false;
        }
        return true;
    }
    public function borrar_articulo($id){
        $sql = "DELETE FROM articulos_pedidos WHERE idarticulos_pedidos=$id";
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
