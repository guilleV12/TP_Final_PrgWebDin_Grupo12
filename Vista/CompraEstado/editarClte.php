<?php
include_once "../../configuracion.php";
$data = data_submitted();
$respuesta = false;
if (isset($data['idcompraestado'])){
    $objC = new AbmCompraEstado();
    $objEliminar = $objC->buscar($data);
    if ($objEliminar[0]->getIdCompraEstadoTipo()->getIdCompraEstadoTipo() == 1){
        
        if ($data['idcompraestadotipo'] == 4){
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
            $mensaje = " El cliente solo puede cancelar su compra";
        }
    } else {
        $mensaje = " El cliente solo puede cancelar su compra si esta en en estado 'iniciada'";
    }
    
    
}

$retorno['respuesta'] = $respuesta;
$retorno['data'] = $data;
if (isset($mensaje)){
   
    $retorno['errorMsg']=$mensaje;

}
    echo json_encode($retorno);
?>