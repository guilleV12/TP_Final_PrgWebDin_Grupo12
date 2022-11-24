<?php
include_once "../../configuracion.php";
$data = data_submitted();
$respuesta = false;
$objC = new AbmMenu();
$lista = $objC->buscar(null);
$data['idmenu'] = count($lista)+1;
if (isset($data['menombre'])){
        $data['medeshabilitado']='0000-00-00 00:00:00';
        if (!isset($data['idpadre']) || $data['idpadre']=="") {
            $data['idpadre']='null';
        }
        $respuesta = $objC->alta($data);
        if (!$respuesta){
            $mensaje = " La accion  ALTA No pudo concretarse";
            
        }
}
$retorno['respuesta'] = $respuesta;
$retorno['mens'] = $data;
if (isset($mensaje)){
    
    $retorno['errorMsg']=$mensaje;
   
}
 echo json_encode($retorno);
?>