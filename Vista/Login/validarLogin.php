<?php
    include_once '../../configuracion.php';
    $datos = data_submitted();
    $objSession = new Session();
    $objUsuario = new AbmUsuario();
    $listaUsuarios = $objUsuario->buscar(null);
    $resp = false;
    for ($i=0; $i < count($listaUsuarios); $i++) { 
        if ($listaUsuarios[$i]->getUsNombre() == $datos['usnombre']){
            if ($listaUsuarios[$i]->getUsPass() == $datos['uspass']){
                $resp = true;
            }
        }
    }

    if ($resp == true){
        if ($objSession->activa()){
            $objSession->cerrar();
            $objSession = new Session();
            $objSession->iniciar($datos['usnombre'],$datos['uspass']);
            if ($objSession->validar() == true){
                $_SESSION['rol'] = $objSession->getRol()->getRoDescripcion();
                header('Location:paginaSegura.php');
            }
        }else{
            $objSession->iniciar($datos['usnombre'],$datos['uspass']);
            if ($objSession->validar() == true){
                $_SESSION['rol'] = $objSession->getRol()->getRoDescripcion();
                header('Location:paginaSegura.php');
            }
        }
    } else {
        header ('Location:index.php?error=1');
    }


   
?>