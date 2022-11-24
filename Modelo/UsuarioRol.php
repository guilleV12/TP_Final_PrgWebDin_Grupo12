<?php
class UsuarioRol extends BaseDatos{
    private $idusuario;
    private $idrol;
    
    public function __construct(){
        $this->idusuario = "";
        $this->idrol = "";
    }

    public function setear($idu, $idr){
        $this->setIdUsuario($idu);
        $this->setIdRol($idr);
    }

    public function setIdUsuario($valor){
        $this->idusuario = $valor;
    }

    public function setIdRol($valor){
        $this->idrol = $valor;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function getIdUsuario(){
        return $this->idusuario;
    }

    public function getIdRol(){
        return $this->idrol;
    }

    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

       /**
	 * Recupera los datos de un auto por patente
	 * @param int $patente
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
	public function Buscar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol WHERE idrol = '".$this->getIdRol()->getIdRol()."' AND idusuario='".$this->getIdUsuario()->getIdUsuario()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $usuario = new Usuario();
                    $rol = new Rol();
                    $usuario->setIdUsuario($row['idusuario']);
                    $rol->setIdRol($row['idrol']);
                    $usuario->Buscar();
                    $rol->Buscar();
                    $this->setear($usuario, $rol);
                }
            }
        } else {
            $this->setmensajeoperacion("UsuarioRol->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    

	public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $usuarioRol = new UsuarioRol();
                    $usuario = new Usuario();
                    $rol = new Rol();
                    $usuario->setIdUsuario($row['idusuario']);
                    $rol->setIdRol($row['idrol']);
                    $usuario->Buscar();
                    $rol->Buscar();
                    $usuarioRol->setear($usuario, $rol);
                    array_push($arreglo, $usuarioRol);
                }
               
            }
            
        } else {
            $this->setMensajeoperacion("UsuarioRol->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

	
	
	public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuariorol(idusuario, idrol) 
		 VALUES('".$this->getIdUsuario()."','".$this->getIdRol()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("UsuarioRol->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("UsuarioRol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE usuariorol SET idrol='".$this->getIdRol()
        ."' WHERE idusuario='".$this->getIdUsuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("UsuarioRol->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("UsuarioRol->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuariorol WHERE idrol='".$this->getIdRol()."' AND idusuario ='".$this->getIdusuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("UsuarioRol->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("UsuarioRol->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "id rol: ".$this->getIdRol()->getIdRol()."\nidusuario: ".$this->getIdUsuario()->getIdusuario()."\n<<>>\n";
			
	}
}