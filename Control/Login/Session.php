<?php
class Session{

    public function __construct(){
        if (!session_start()) {
            return false;
        } else {
            return true;
        }
      }
   
    /**
     * Actualiza las variables de sesión con los valores ingresados.
     */
    public function iniciar($nombreUsuario,$psw){
        $resp = false;
        $obj = new AbmUsuario();
        $param['usnombre']=$nombreUsuario;
        $param['uspass']=$psw;
        
        /* Primera validacion */
       /*  $param['usdeshabilitado']='null';

        $resultado = $obj->buscar(null);
        for ($i=0; $i < count($resultado); $i++) { 
            if ($resultado[$i]->getUsNombre() == $nombreUsuario) {
                $param['idusuario'] = $resultado[$i]->getIdUsuario();
            }
        }
        if(count($resultado) > 0){
            $_SESSION['idusuario']=$param['idusuario'];
            $_SESSION['usnombre']=$param['usnombre'];
            $_SESSION['rol'] = $this->getRol();
            $resp = true;
        } else {
            $this->cerrar();
        } */

        /*  segunda validacion */
        $listar = $obj->buscar($param);
        if(count($listar)>0){
            $objUsuario = $listar[0];
            if($objUsuario->getUsDeshabilitado() == null || $objUsuario->getUsDeshabilitado() == "0000-00-00 00:00:00" ){
                $_SESSION['idusuario']=$objUsuario->getIdUsuario();
                $_SESSION['usnombre']=$param['usnombre'];
                /* $_SESSION['rol'] = $this->getRol(); */
                $resp = true;
            }
        }


        return $resp;
    }
    
    /**
     * Valida si la sesión actual tiene usuario y psw válidos. Devuelve true o false.
     */
    public function validar(){
        $resp = false;
        if($this->activa() && isset($_SESSION['idusuario']))
            $resp=true;
        return $resp;
    }
    
    /**
     *Devuelve true o false si la sesión está activa o no.
     */
    public function activa(){
        $resp = false;
        if ( php_sapi_name() !== 'cli' ) {
            if ( version_compare(phpversion(), '5.4.0', '>=') ) {
                $resp = session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                $resp = session_id() === '' ? FALSE : TRUE;
            }
        }
        return $resp;
    }
   
    /**
     * Devuelve el usuario logeado.
     */
    public function getUsuario(){
        $usuario = null;
        if($this->validar()){
            $obj = new AbmUsuario();
             $param['idusuario']=$_SESSION['idusuario'];
             $resultado = $obj->buscar($param);
            if(count($resultado) > 0){
                $usuario = $resultado[0];
            }
        }
        return $usuario;
    }

     /**
     * Devuelve el rol del usuario logeado si param es null, si no cambia al rol pasado por param.
     */
    public function getRol() {
        $objRol = false;
            if ($this->getUsuario()!==null) {
                $usuarioLog=$this->getUsuario();
                $param['idusuario']=$usuarioLog->getIdUsuario();
                $objTransUsRol=new AbmUsuarioRol();
                $lista=$objTransUsRol->buscar($param);
                $param1['idrol']=$lista[0]->getIdRol()->getIdRol();
                $objTransRol=new AbmRol();
                $rol=$objTransRol->buscar($param1);
                $objRol=$rol[0];
                
            }
        return $objRol;
        }

    public function cambiarRol($param){
        $objTransRol=new AbmRol();
        $rol=$objTransRol->buscar($param);
        $objRol=$rol[0];
        $resp = false;
        if (count($rol)>0){
            $_SESSION["rol"] = $objRol->getRoDescripcion();
            $resp = true;
        }
        return $resp;
    }
    
    /**
     *Cierra la sesión actual.
     */
    public function cerrar() {
	 		
        if ($this->activa()) {
            unset($_SESSION['usnombre']);
            unset($_SESSION['uspass']);
            session_destroy();
        }
    }

   
}
?>