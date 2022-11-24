<?php
include_once "../../configuracion.php";
$data = data_submitted();

if (isset($data['idrol'])){
    $objC = new AbmRol();
    $objEliminar = $objC->buscar($data);
    $arrEliminar[0] = ['idrol'=>$data['idrol'],
                    'rodescripcion'=>$data['rodescripcion']];
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