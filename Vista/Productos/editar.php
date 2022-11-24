<?php
include_once "../../configuracion.php";
$data = data_submitted();

if (isset($data['idproducto'])){
    $objC = new AbmProducto();
    $objEliminar = $objC->buscar($data);
    $arrEliminar[0] = ['idproducto'=>$data['idproducto'],
                        'pronombre'=>$data['pronombre'],
                        'prodetalle'=>$data['prodetalle'],
                        'procantstock'=>$data['procantstock']];
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