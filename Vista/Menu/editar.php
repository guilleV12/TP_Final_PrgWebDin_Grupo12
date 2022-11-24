<?php
include_once "../../configuracion.php";
$data = data_submitted();
$respuesta = false;
if (isset($data['idmenu'])){
    $objC = new AbmMenu();
    $objEliminar = $objC->buscar($data);
    
    if (!isset($data['idpadre']) || $data['idpadre']=="") {
        $data['idpadre']='null';
    }
    $arrEliminar[0] = ['idmenu'=>$data['idmenu'],
                        'menombre'=>$data['menombre'],
                        'medescripcion'=>$data['medescripcion'],
                        'idpadre'=>$data['idpadre'],
                        'medeshabilitado'=>$objEliminar[0]->getMeDeshabilitado()];
    $respuesta = $objC->modificacion($arrEliminar[0]);
    
    if (!$respuesta){

        $sms_error = " La accion  MODIFICACION No pudo concretarse";
        
    }else $respuesta =true;
    
}
$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
    
    $retorno['errorMsg']=$sms_error;
    
}
echo json_encode($retorno);
?>