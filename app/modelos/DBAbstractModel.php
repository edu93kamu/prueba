<?php
require_once '../app/config.php';
/**
 * Description of db_abstract_model
 *
 */
class DBAbstractModel {

    public $error_conexion;
    protected $con;
    public $error_sql;




    /**
     * Constructor de DBAbstractModel. Conecta con la base de datos y guarda la conexión,
     * si ocurre un error de conexión éste se guarda en la propiedad $error_conexion
     * 
     */
    public function __construct() {
        $con = new mysqli(Config::$bd_host,  Config::$bd_user, 
                          Config::$bd_password, Config::$bd_schema);
        if(!$con)
        {
            $this->error_conexion = $con->connect_error;
        }
        
        //Guardamos la conexión en la propiedad $con del objeto.
        $this->con = $con;
    }
    
    /**
     * Destructor de DBAbstractModel, cierra la conexión mysql
     */
    public function __destruct() {
        $this->con->close();
    }
    
    
}
