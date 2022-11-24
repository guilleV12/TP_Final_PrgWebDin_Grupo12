<?php
include_once "../../configuracion.php";
$data = data_submitted();

if (isset($data['idusuario'])){
    $objC = new AbmUsuario();
    $objEliminar = $objC->buscar($data);
    $arrEliminar[0] = ['idusuario'=>$objEliminar[0]->getIdUsuario(),
                        'usnombre'=>$objEliminar[0]->getUsNombre(),
                        'uspass'=>$objEliminar[0]->getUsPass(),
                        'usmail'=>$objEliminar[0]->getUsMail(),
                        'usdeshabilitado'=>'0000-00-00 00:00:00'];
    if (!isset($data['habilitar'])){
        $respuesta = $objC->deshabilitar($arrEliminar[0]);
        if (!$respuesta){
            $mensaje = " La accion  DESHABILITAR no pudo concretarse";
        }
    }else{
        $respuesta = $objC->modificacion($arrEliminar[0]);
        if (!$respuesta){
            $mensaje = " La accion  HABILITAR no pudo concretarse";
        }
    }
    
}

$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
   
    $retorno['errorMsg']=$mensaje;

}
    echo json_encode($retorno);
?>