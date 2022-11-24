<?php
include_once "../../configuracion.php";
$data = data_submitted();
$respuesta = false;
if (isset($data['idcompraestado'])){
    $objC = new AbmCompraEstado();
    $objEliminar = $objC->buscar($data);
    if ($objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo() == 1){
        if ($data['idcompraestadotipo'] == 2){
            $arrEliminar[0] = ['idcompraestado'=>$data['idcompraestado'],
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>$data['idcompraestadotipo'],
                            'cefechaini'=>$objEliminar[0]->getCeFechaIni(),
                            'cefechafin'=>$objEliminar[0]->getCeFechaFin()];
            $respuesta = $objC->modificacion($arrEliminar[0]);

            $objP = new AbmProducto(); 
            $objCI = new AbmCompraItem();
            $listaCI = $objCI->buscar(null);

            for ($compi=0; $compi < count($listaCI); $compi++) { 
                if ($listaCI[$compi]->getIdCompra()->getIdCompra() == $arrEliminar[0]['idcompra']){
                    $buscarProd['idproducto'] = $listaCI[$compi]->getIdProducto()->getIdProducto();
                }
            }
            $listaP = $objP->buscar($buscarProd);

            $modProd[0]['procantstock'] = ($listaP[0]->getProCantStock())-($listaCI[0]->getCiCantidad());
            $modProd[0]['idproducto'] = $listaP[0]->getIdProducto();
            $modProd[0]['pronombre'] = $listaP[0]->getPronombre();
            $modProd[0]['prodetalle'] = $listaP[0]->getProDetalle();
            $objP->modificacion($modProd[0]);
            if (!$objP->modificacion($modProd[0])) {
                $mensaje = " La accion MODIFICACION de stock no pudo ccretarse";
            }
            if (!$respuesta){
                $mensaje = " La accion MODIFICACION No pudo ccretarse";
            }
        } elseif ($data['idcompraestadotipo'] == 4){
            $arrEliminar[0] = ['idcompraestado'=>$data['idcompraestado'],
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>$data['idcompraestadotipo'],
                            'cefechaini'=>$objEliminar[0]->getCeFechaIni(),
                            'cefechafin'=>date("Y-m-d h:i:sa")];
            $respuesta = $objC->modificacion($arrEliminar[0]);
            if (!$respuesta){
                $mensaje = " La accion MODIFICACION No pudo ccretarse";
            }
        }else{
            $mensaje = " Una compra iniciada(1) solo puede aceptarse(2) o cancelarse(4)";
        }
    } else if($objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo() == 2){
        if ($data['idcompraestadotipo'] == 3){
            $arrEliminar[0] = ['idcompraestado'=>$data['idcompraestado'],
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>$data['idcompraestadotipo'],
                            'cefechaini'=>$objEliminar[0]->getCeFechaIni(),
                            'cefechafin'=>date("Y-m-d h:i:sa")];
            $respuesta = $objC->modificacion($arrEliminar[0]);

            if (!$respuesta){
                $mensaje = " La accion MODIFICACION No pudo ccretarse";
            }
        }elseif ($data['idcompraestadotipo'] == 4){

            $arrEliminar[0] = ['idcompraestado'=>$data['idcompraestado'],
                                'idcompra'=>$data['idcompra'],
                                'idcompraestadotipo'=>$data['idcompraestadotipo'],
                                'cefechaini'=>$objEliminar[0]->getCeFechaIni(),
                                'cefechafin'=>date("Y-m-d h:i:sa")];
            $respuesta = $objC->modificacion($arrEliminar[0]);

            $objP = new AbmProducto();
            $objCI = new AbmCompraItem();
            $listaCI = $objCI->buscar($data);
            for ($compi=0; $compi < count($listaCI); $compi++) { 
                if ($listaCI[$compi]->getIdCompra()->getIdCompra() == $arrEliminar[0]['idcompra']){
                    $buscarProd['idproducto'] = $listaCI[$compi]->getIdProducto()->getIdProducto();
                }
            }
            $listaP = $objP->buscar($buscarProd);

            $modProd[0]['procantstock'] = ($listaP[0]->getProCantStock())+($listaCI[0]->getCiCantidad());
            $modProd[0]['idproducto'] = $listaP[0]->getIdProducto();
            $modProd[0]['pronombre'] = $listaP[0]->getPronombre();
            $modProd[0]['prodetalle'] = $listaP[0]->getProDetalle();
            $objP->modificacion($modProd[0]);

            if (!$respuesta){
                $mensaje = " La accion MODIFICACION No pudo ccretarse";
            }
        } else{
            $mensaje = 'Una compra aceptada(2) solo puede enviarse (3) o cancelarse(4)';
        }
    } else if ($objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo() == 3){
        if ($data['idcompraestadotipo'] == 4){
            $arrEliminar[0] = ['idcompraestado'=>$data['idcompraestado'],
                            'idcompra'=>$data['idcompra'],
                            'idcompraestadotipo'=>$data['idcompraestadotipo'],
                            'cefechaini'=>$objEliminar[0]->getCeFechaIni(),
                            'cefechafin'=>$objEliminar[0]->getCeFechaFin()];
            $respuesta = $objC->modificacion($arrEliminar[0]);

            $objP = new AbmProducto();
            $objCI = new AbmCompraItem();
            $listaCI = $objCI->buscar($data);
            $paramprod['idproducto'] = $listaCI[0]->getIdProducto()->getIdProducto();
            $listaP = $objP->buscar($paramprod);

            $modProd[0]['procantstock'] = ($listaP[0]->getProCantStock())+($listaCI[0]->getCiCantidad());
            $modProd[0]['idproducto'] = $listaP[0]->getIdProducto();
            $modProd[0]['pronombre'] = $listaP[0]->getPronombre();
            $modProd[0]['prodetalle'] = $listaP[0]->getProDetalle();
            $objP->modificacion($modProd[0]);

            if (!$respuesta){
                $mensaje = " La accion MODIFICACION de No pudo ccretarse";
            }
        } else {
            $mensaje = "Una compra enviada(3) solo puede cancelarse(4)";
        }
    } else{
        $mensaje = "La compra ya fue cancelada(4)";
    }
} 
    
    


$retorno['respuesta'] = $respuesta;
$retorno['data'] =  $modProd[0]['pronombre'];
if (isset($mensaje)){
   
    $retorno['errorMsg']=$mensaje;

}
    echo json_encode($retorno);
?>