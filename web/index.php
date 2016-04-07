<?php

//Incluimos librerías, configuración, modelos y controladores
require_once '../app/config.php';
require_once '../app/funciones.php';
require_once '../app/modelos/DBAbstractModel.php';
require_once '../app/controladores/ControladorUsuario.php';
require_once '../app/controladores/ControladorPublico.php';
require_once '../app/controladores/ControladorPrivado.php';
require_once '../app/controladores/ControladorErrores.php';
require_once '../app/controladores/ControladorProducto.php';
require_once '../app/controladores/ControladorCategoria.php';
require_once '../app/controladores/ControladorPedido.php';
require_once '../app/controladores/ControladorPresupuesto.php';
require_once '../app/modelos/SesionUsuario.php';
require_once '../app/modelos/Usuario.php';
require_once '../app/modelos/Categoria.php';
require_once '../app/modelos/Producto.php';
require_once '../app/modelos/Pedido.php';
require_once '../app/modelos/Presupuesto.php';
require_once '../app/modelos/MensajeFlash.php';
// Mapa de enrutamiento
$map = array(
    'pagina_no_encontrada' => array('controlador'=>'ControladorErrores','metodo'=>'pagina_no_encontrada', 'tipo_acceso' =>'publico'),
    'inicio' => array('controlador'=>'ControladorPublico','metodo'=>'inicio', 'tipo_acceso' =>'publico'),
    'productos' => array('controlador'=>'ControladorPublico','metodo'=>'productos', 'tipo_acceso' =>'publico'),
    'quien_somos' => array('controlador'=>'ControladorPublico','metodo'=>'quien_somos', 'tipo_acceso' =>'publico'),
    'contacto' => array('controlador'=>'ControladorPublico','metodo'=>'contacto', 'tipo_acceso' =>'publico'),
    'login' => array('controlador'=>'ControladorUsuario','metodo'=>'login', 'tipo_acceso' =>'publico'),
    'logout' => array('controlador'=>'ControladorUsuario','metodo'=>'logout', 'tipo_acceso' =>'privado'),
    'inicio_logueado' => array('controlador'=>'ControladorPrivado','metodo'=>'inicio_logueado', 'tipo_acceso' =>'privado'),
    'registros' => array('controlador'=>'ControladorPrivado','metodo'=>'registros', 'tipo_acceso' =>'privado'),
    'insertar_categoria' => array('controlador'=>'ControladorCategoria','metodo'=>'insertar_categoria', 'tipo_acceso' =>'privado'),
    'insertar_producto' => array('controlador'=>'ControladorProducto','metodo'=>'insertar_producto', 'tipo_acceso' =>'privado'),
    'insertar_usuario' => array('controlador'=>'ControladorUsuario','metodo'=>'insertar_Usuario', 'tipo_acceso' =>'privado'),
    'insertar_pedido' => array('controlador'=>'ControladorPedido','metodo'=>'insertar', 'tipo_acceso' =>'privado'),
    'consultar_datos' => array('controlador'=>'ControladorPrivado','metodo'=>'consultar_datos', 'tipo_acceso' =>'privado'),
    'comprobar_correo' => array('controlador'=>'ControladorUsuario','metodo'=>'comprobar_correo', 'tipo_acceso' =>'privado'),
    'ver_categorias' => array('controlador'=>'ControladorCategoria','metodo'=>'consultar', 'tipo_acceso' =>'privado'),
    'ver_productos' => array('controlador'=>'ControladorProducto','metodo'=>'consultar', 'tipo_acceso' =>'privado'),
    'ver_usuarios' => array('controlador'=>'ControladorUsuario','metodo'=>'consultar', 'tipo_acceso' =>'privado'),
    'ver_pedidos' => array('controlador'=>'ControladorPedido','metodo'=>'consultar', 'tipo_acceso' =>'privado'),
    'ver_presupuestos' => array('controlador'=>'ControladorPresupuesto','metodo'=>'consultar', 'tipo_acceso' =>'privado'),
    'datos_categoria' => array('controlador'=>'ControladorCategoria','metodo'=>'datos', 'tipo_acceso' =>'privado'),
    'datos_producto' => array('controlador'=>'ControladorProducto','metodo'=>'datos', 'tipo_acceso' =>'privado'),
    'datos_pedido' => array('controlador'=>'ControladorPedido','metodo'=>'datos', 'tipo_acceso' =>'privado'),
    'datos_usuario' => array('controlador'=>'ControladorUsuario','metodo'=>'datos', 'tipo_acceso' =>'privado'),
    'actualizar_categoria' => array('controlador'=>'ControladorCategoria','metodo'=>'actualizar', 'tipo_acceso' =>'privado'),
    'actualizar_producto' => array('controlador'=>'ControladorProducto','metodo'=>'actualizar', 'tipo_acceso' =>'privado'),
    'actualizar_usuario' => array('controlador'=>'ControladorUsuario','metodo'=>'actualizar', 'tipo_acceso' =>'privado'),
    'borrar_categoria' => array('controlador'=>'ControladorCategoria','metodo'=>'borrar', 'tipo_acceso' =>'privado'),
    'borrar_producto' => array('controlador'=>'ControladorProducto','metodo'=>'borrar', 'tipo_acceso' =>'privado'),
    'borrar_usuario' => array('controlador'=>'ControladorUsuario','metodo'=>'borrar', 'tipo_acceso' =>'privado'),
    'borrar_pedido' => array('controlador'=>'ControladorPedido','metodo'=>'borrar', 'tipo_acceso' =>'privado'),
    'borrar_articulo' => array('controlador'=>'ControladorPedido','metodo'=>'borrar_articulo', 'tipo_acceso' =>'privado'),
    'busquedas' => array('controlador'=>'ControladorProducto','metodo'=>'buscar', 'tipo_acceso' =>'privado'),
    'anadir_carro' => array('controlador'=>'ControladorProducto','metodo'=>'anadir', 'tipo_acceso' =>'privado'),
    'ver_carro' => array('controlador'=>'ControladorPrivado','metodo'=>'carro', 'tipo_acceso' =>'privado'),
    'vaciar' => array('controlador'=>'ControladorPrivado','metodo'=>'vaciar_carro', 'tipo_acceso' =>'privado'),
    'ver_articulos' => array('controlador'=>'ControladorPrivado','metodo'=>'ver_articulos', 'tipo_acceso' =>'privado'),
);

//Parseo de la ruta, recogemos la acción que quiere realizar el usuario o ponemos una por
//defecto  (inicio). El parámetro que se recibirá será ?accion= y se recibe por GET

if($_GET['accion']!=''){ //Comprobamos si se ha recibido el parámetro acción
    if(isset($map[$_GET['accion']])){   //Comprobamos si la acción recibida está en el mapa
        $accion = $_GET['accion'];  //Si todo está bien guardamos la acción en $accion
        //Si no existe la acción en el mapa redirigimos a una página de error
    }else{
        header('location: pagina_no_encontrada');
        die();
    }
    //Si no se ha recibido ninguna acción se pone por defecto la acción "inicio".
}else{
    $accion = 'inicio';
}

//Si la acción es privada y el usuario no ha iniciado sesión, lo "echamos" a inicio
if($map[$accion]['tipo_acceso']=='privado' && !SesionUsuario::existe_sesion()){
    header('location: inicio');
    die();
}
//Si ha iniciado sesión y quiere entrar a inicio lo redirigimos a ultimas_publicaciones
/*if($accion=='inicio' && SesionUsuario::existe_sesion())
{
    header('location: logueado');
    die();
}*/

//Recogemos del mapa el nombre de la clase del controlador que tenemos que instanciar
$nombre_clase_controlador  = $map[$accion]['controlador'];
//Recogemos del mapa el nombrel del método que tenemos que llamar.
$nombre_metodo  = $map[$accion]['metodo'];

//Creamos la clase y llamamos al método del controlador
$obj = new $nombre_clase_controlador();
$obj->$nombre_metodo();








