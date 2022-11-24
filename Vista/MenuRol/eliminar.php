<?php
include_once "../../configuracion.php";
$data = data_submitted();

if (isset($data['idmenu'])){
    $objC = new AbmMenuRol();
    $objEliminar = $objC->buscar($data);
    $arrEliminar[0] = ['idmenu'=>$data['idmenu'],
                        'idrol'=>$objEliminar[0]->getIdRol()->getIdrol()];
    $respuesta = $objC->baja($arrEliminar[0]);
    if (!$respuesta){
        $mensaje = " La accion BAJA no pudo concretarse";
    }
}

$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
   
    $retorno['errorMsg']=$mensaje;

}
    echo json_encode($retorno);
?>