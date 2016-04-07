<?php


class ControladorPresupuesto {
    public function consultar(){
        $obj_presupuesto= new Presupuesto();
        $presupuestos=$obj_presupuesto->obtener();
        unset($obj_presupuesto);
        if(!$presupuestos){
           echo('error');
       }else{
           echo json_encode($presupuestos);
       }
    }
}
