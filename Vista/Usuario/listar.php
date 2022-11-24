<?php
include_once ('../../configuracion.php');
$data = data_submitted();
$objControl = new AbmUsuario();
$objSession = new Session();
$objUsRol = new AbmUsuarioRol();
$objRol = new AbmRol();
$listaRol = $objRol->buscar(null);
$listaUsRol = $objUsRol->buscar(null);
$lista = $objControl->buscar(null);
$arreglo_salida =  array();
foreach ($lista as $elem ){
    
    $nuevoElem['idusuario'] = $elem->getIdUsuario();
    $nuevoElem["usnombre"]=$elem->getUsNombre();
    $nuevoElem["usmail"]=$elem->getUsMail();
    $nuevoElem["usdeshabilitado"]=$elem->getUsDeshabilitado();
    $i=0;
    $resp = true;
    while ( $i < count($listaUsRol) && $resp == true) { 
        if ($listaUsRol[$i]->getIdUsuario()->getIdUsuario() == $nuevoElem['idusuario']){
            for ($j=0; $j < count($listaRol); $j++) {
                if ($listaUsRol[$i]->getIdRol()->getIdRol() == $listaRol[$j]->getIdRol()){
                    $nuevoElem["usrol"]=$listaRol[$j]->getRoDescripcion();
                    $resp = false;
                }
            }
        }
        $i++;
    }

    array_push($arreglo_salida,$nuevoElem);
}
//verEstructura($arreglo_salida);
echo json_encode($arreglo_salida,null,2);

?>