<?php
include_once ('../../configuracion.php');
$data = data_submitted();
$objControl = new AbmRol();
$lista = $objControl->buscar(null);
$arreglo_salida =  array();
foreach ($lista as $elem ){
    
    $nuevoElem['idrol'] = $elem->getIdRol();
    $nuevoElem["rodescripcion"]=$elem->getRoDescripcion();
       
    array_push($arreglo_salida,$nuevoElem);
}
//verEstructura($arreglo_salida);
echo json_encode($arreglo_salida,null,2);

?>