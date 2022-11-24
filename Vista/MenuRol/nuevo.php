<?php
include_once "../../configuracion.php";
$data = data_submitted();
$respuesta = false;
if (isset($data['idmenu'])){
        $objC = new AbmMenuRol();
        $respuesta = $objC->alta($data);
        if (!$respuesta){
            $mensaje = " La accion  ALTA No pudo concretarse";
            
        }
}
$retorno['respuesta'] = $respuesta;
$retorno['obj'] = $data;
if (isset($mensaje)){
    
    $retorno['errorMsg']=$mensaje;
   
}
 echo json_encode($retorno);
?>