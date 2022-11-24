<?php
include_once "../../configuracion.php";
$data = data_submitted();

if (isset($data['idusuario'])){
    $objC = new AbmUsuarioRol();
    $objEliminar = $objC->buscar($data);
    $arrEliminar[0] = ['idusuario'=>$data['idusuario'],
                        'idrol'=>$data['idrol']];
    $respuesta = $objC->modificacion($arrEliminar[0]);
    if (!$respuesta){
        $mensaje = " La accion MODIFICACION No pudo concretarse";
    }
}

$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
   
    $retorno['errorMsg']=$mensaje;

}
    echo json_encode($retorno);
?>