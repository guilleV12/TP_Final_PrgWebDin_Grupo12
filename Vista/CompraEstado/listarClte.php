<?php
include_once ('../../configuracion.php');
$data = data_submitted();
$objControl = new AbmCompraEstado();
$objSession = new Session();
$objCompra = new AbmCompra();
$listaCom = $objCompra->buscar(null);
$lista = $objControl->buscar(null);
$arreglo_salida =  array();
foreach ($lista as $elem ){
    for ($compU=0; $compU < count($listaCom); $compU++) { 
        if ($elem->getIdCompra()->getIdCompra() == $listaCom[$compU]->getIdCompra()) {
            if ($listaCom[$compU]->getIdUsuario()->getIdUsuario() == $objSession->getUsuario()->getIdUsuario()) {
                $nuevoElem['idcompraestado'] = $elem->getIdCompraEstado();
                $nuevoElem['idcompra'] = $elem->getIdCompra()->getIdCompra();
                $nuevoElem["idcompraestadotipo"]=$elem->getIdCompraEstadoTipo()->getCetDescripcion();
                $nuevoElem['cefechaini']= $elem->getCeFechaIni();
                $nuevoElem['cefechafin']= $elem->getCeFechaFin();
                array_push($arreglo_salida,$nuevoElem);

            }
            
        }
    }
    

}
echo json_encode($arreglo_salida,null,2);

?>