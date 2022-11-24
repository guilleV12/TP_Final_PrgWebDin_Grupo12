<?php
include_once ('../../configuracion.php');
$objSession = new Session();
$data = data_submitted();

$respuesta = false;
if (isset($data['idproducto'])){
if ($objSession->validar()){
    $objControl = new AbmCompra();
    $listaC = $objControl->buscar(null);

    $compra['cofecha'] = date("Y-m-d h:i:sa");
    $compra['idusuario'] = $_SESSION['idusuario'];
    $compra['idcompra'] = count($listaC)+1;
    $respuesta = $objControl->alta($compra);
    if (!$respuesta){
        $mensaje = " La accion  de realizar compra no pudo concretarse";

    }else{
        $objCI = new AbmCompraItem();
        $listaCI = $objCI->buscar(null);

        $compraitem['idcompraitem'] = count($listaCI)+1;
        $compraitem['idproducto'] = $data['idproducto'];
        $compraitem['idcompra'] = $compra['idcompra'];
        $compraitem['cicantidad'] = 1;
        $respuesta2 = $objCI->alta($compraitem);
        if (!$respuesta2) {
            $mensaje = " La accion  de realizar compra item no pudo concretarse";

        }else{
            $objCE = new AbmCompraEstado();
            $listaCE = $objCE->buscar(null);

            $compraestado['idcompraestado'] = count($listaCE)+1;
            $compraestado['idcompra'] = $compraitem['idcompra'];
            $compraestado['idcompraestadotipo'] = 1;
            $compraestado['cefechaini'] = date("Y-m-d h:i:sa");
            $compraestado['cefechafin'] = '0000-00-00 00:00:00';
            $respuesta3 = $objCE->alta($compraestado);
            if (!$respuesta3) {
                $mensaje = " La accion  de realizar compra estado no pudo concretarse";
    
            }
        }
       
    }
}else {
    $mensaje = " Debe iniciar sesion para comprar";
}
}





$retorno['respuesta'] = $respuesta;
$retorno['obj'] = $data;
if (isset($mensaje)){
    
    $retorno['errorMsg']=$mensaje;
   
}
 echo json_encode($retorno);
?>