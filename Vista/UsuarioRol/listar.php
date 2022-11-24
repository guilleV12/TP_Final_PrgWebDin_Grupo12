<?php
include_once ('../../configuracion.php');
$data = data_submitted();
$objControl = new AbmUsuarioRol();
$lista = $objControl->buscar(null);
$arreglo_salida =  array();
foreach ($lista as $elem ){
    $nuevoElem['idusuario'] = $elem->getIdUsuario()->getIdUsuario();
    $nuevoElem['usnombre'] = $elem->getIdUsuario()->getUsNombre();
    $nuevoElem["idrol"]=$elem->getIdRol()->getIdRol();
    $nuevoElem['rodescripcion']= $elem->getIdRol()->getRoDescripcion();
       
    array_push($arreglo_salida,$nuevoElem);
}
//verEstructura($arreglo_salida);
echo json_encode($arreglo_salida,null,2);

?>