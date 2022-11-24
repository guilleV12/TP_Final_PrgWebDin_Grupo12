<?php
    header('Content-type:application/json;charset=utf-8');
    include_once '../../configuracion.php';
    $objSession = new Session();
    $datos = data_submitted();
    $objUsuario = new AbmUsuario();
    $resp = 0;

   
    if(!$objSession->validar()){
        if(isset($datos['usnombre']) and isset($datos['uspass']) ){

            $resp = $objSession->iniciar($datos['usnombre'],$datos['uspass']);
    
            if($objSession->validar()){
                $_SESSION['rol'] = $objSession->getRol()->getRoDescripcion();
                $resp=array(
                    'exito'=>1
                );
                //echo "Usuario y/o contraseña correctos";
                //echo "<script>location.href = 'paginaSegura.php';</script>" ;
            }else{
                $resp=array(
                    'exito'=>0
                );
                $mensaje = "Usuario y/o contraseña incorrectos";
                //echo "<script>location.href = 'index.php?error=1';</script>" ;
            }
        }else{
            $resp=array(
                'exito'=>0
            );
            //echo "Los paramentros no existen";
        }

    }else{
        $resp=array(
            'exito'=>0
        );
        //echo "Ya hay una sesion iniciada";
    }

    echo json_encode($resp);
    

   
?>