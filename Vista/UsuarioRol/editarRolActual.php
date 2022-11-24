<?php
include_once "../../configuracion.php";
$data = data_submitted();
$session = new Session();
$objR = new AbmRol();
$listaR = $objR->buscar(null);

if (isset($data['idusuario'])){
    
    $param['idrol'] = $data['idrol'];
    $respuesta = $session->cambiarRol($param);
      
    if (!$respuesta){
        $mensaje = " La accion MODIFICACION No pudo concretarse";
    }
}

$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
   
    $retorno['errorMsg']=$mensaje;

}
    echo json_encode($retorno);
?>