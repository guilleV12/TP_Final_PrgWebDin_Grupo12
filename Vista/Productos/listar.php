<?php
include_once ('../../configuracion.php');
$data = data_submitted();
$objControl = new AbmProducto();
$lista = $objControl->buscar(null);
$arreglo_salida =  array();
foreach ($lista as $elem ){
    
    $nuevoElem['idproducto'] = $elem->getIdProducto();
    $nuevoElem["prodetalle"]=$elem->getProDetalle();
    $nuevoElem["procantstock"]=$elem->getProCantStock();
    $nuevoElem["pronombre"]=$elem->getProNombre();

    array_push($arreglo_salida,$nuevoElem);
}
//verEstructura($arreglo_salida);
echo json_encode($arreglo_salida,null,2);

?>