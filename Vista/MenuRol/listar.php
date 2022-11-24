<?php
include_once ('../../configuracion.php');
$data = data_submitted();
$objControl = new AbmMenuRol();
$lista = $objControl->buscar(null);
$arreglo_salida =  array();
foreach ($lista as $elem ){
    $nuevoElem['idmenu'] = $elem->getIdMenu()->getIdMenu();
    $nuevoElem['idrol'] = $elem->getIdRol()->getIdRol();
    $nuevoElem["menombre"]=$elem->getIdMenu()->getMeNombre();
    $nuevoElem['rodescripcion']= $elem->getIdRol()->getRoDescripcion();
       
    array_push($arreglo_salida,$nuevoElem);
}
//verEstructura($arreglo_salida);
echo json_encode($arreglo_salida,null,2);

?>