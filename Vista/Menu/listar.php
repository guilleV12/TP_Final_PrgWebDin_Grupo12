<?php
include_once ('../../configuracion.php');
$data = data_submitted();
$objControl = new AbmMenu();
$lista = $objControl->buscar(null);
$arreglo_salida =  array();
foreach ($lista as $elem ){
    
    $nuevoElem['idmenu'] = $elem->getIdMenu();
    $nuevoElem["menombre"]=$elem->getMeNombre();
    $nuevoElem["medescripcion"]=$elem->getMeDescripcion();
    $nuevoElem["idpadre"]=$elem->getIdPadre();
    if($elem->getIdPadre()!=null){
        $nuevoElem["idpadre"]=$elem->getIdPadre()->getIdMenu();
    }
    $nuevoElem["medeshabilitado"]=$elem->getMeDeshabilitado();

    array_push($arreglo_salida,$nuevoElem);
}
//verEstructura($arreglo_salida);
echo json_encode($arreglo_salida,null,2);

?>