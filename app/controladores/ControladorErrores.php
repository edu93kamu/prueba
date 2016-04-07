<?php

/**
 * Description of ControladorErrores
 *
 * @author Usuario1
 */
class ControladorErrores {
    
    /**
     * funcion para redireccionar a pagina no encontrada si no existe la url 
     * introducida
     */
    function pagina_no_encontrada()
    {
        echo '<h1>pagina no encontrada</h1><br><br><br>';
        echo '<a href="inicio"> volver a inicio </a>';
    }
}
