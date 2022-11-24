<?php
include_once "../../configuracion.php";
$data = data_submitted();

if (isset($data['idproducto'])){
    $objCI = new AbmCompraItem();
    $lista = $objCI->buscar(null);
    $enuso = false;
    for ($i=0; $i < count($lista); $i++) {
        if ($lista[$i]->getIdProducto()->getIdProducto() == $data['idproducto']){
            $enuso = true;
        }
    }

    if ($enuso == false) {
        
        $objC = new AbmProducto();
        $objEliminar = $objC->buscar($data);
        $arrEliminar[0] = ['idproducto'=>$data['idproducto'],
                            'pronombre'=>$objEliminar[0]->getProNombre(),
                            'prodetalle'=>$objEliminar[0]->getProDetalle(),
                            'procantstock'=>$objEliminar[0]->getProCantStock()];
        $respuesta = $objC->baja($arrEliminar[0]);
        if (!$respuesta){
            $mensaje = " La accion BAJA no pudo concretarse";
        }
    } else {
        $mensaje = "La accion eliminar no pudo concretarse porque el producto esta en una compra";
    }
}

$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
   
    $retorno['errorMsg']=$mensaje;

}
    echo json_encode($retorno);
?>