<?php
class Usuario extends BaseDatos{
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdeshabilitado;
    
    public function __construct(){
        $this->idusuario = "";
        $this->usnombre = "";
        $this->uspass = "";
        $this->usmail = "";
        $this->usdeshabilitado = "";
    }

    public function setear($idu, $usn, $usp, $usm, $usd){
        $this->setIdUsuario($idu);
        $this->setUsNombre($usn);
        $this->setUsPass($usp);
        $this->setUsMail($usm);
        $this->setUsdeshabilitado($usd);
    }

    public function setIdUsuario($valor){
        $this->idusuario = $valor;
    }

    public function setUsNombre($valor){
        $this->usnombre = $valor;
    }

    public function setUsPass($valor){
        $this->uspass = $valor;
    }

    public function setUsMail($valor){
        $this->usmail = $valor;
    }

    public function setUsDeshabilitado($valor){
        $this->usdeshabilitado = $valor;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function getIdUsuario(){
        return $this->idusuario;
    }

    public function getUsNombre(){
        return $this->usnombre;
    }

    public function getUsPass(){
        return $this->uspass;
    }

    public function getUsMail(){
        return $this->usmail;
    }

    public function getUsDeshabilitado(){
        return $this->usdeshabilitado;
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
        $sql="SELECT * FROM usuario WHERE idusuario = '".$this->getIdusuario()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idusuario'],$row['usnombre'],$row['uspass'],$row['usmail'],$row['usdeshabilitado']);
                }
            }
        } else {
            $this->setmensajeoperacion("Usuario->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    

	public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuario ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $usuario = new Usuario();
                    $usuario->setear($row['idusuario'],$row['usnombre'],$row['uspass'],$row['usmail'],$row['usdeshabilitado']);
                    array_push($arreglo, $usuario);
                } 
               
            }
            
        } else {
            $this->setMensajeoperacion("Usuario->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

	
	
	public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuario(idusuario, usnombre, uspass, usmail, usdeshabilitado) 
		 VALUES('".$this->getIdUsuario()."','".$this->getUsNombre()."','".$this->getUsPass()."','".$this->getUsMail()."','"
         .$this->getUsdeshabilitado()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Usuario->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Usuario->insertar: ".$base->getError());
        }
        return $resp;
    }
    
   public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE usuario SET usnombre='".$this->getUsNombre()."',uspass='".$this->getUsPass()."',usmail='".$this->getUsMail()
        ."',usdeshabilitado='".$this->getUsdeshabilitado()
        ."' WHERE idusuario='".$this->getIdusuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Usuario->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Usuario->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuario WHERE idusuario='".$this->getIdusuario()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("Usuario->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Usuario->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "id usuario: ".$this->getIdUsuario()."\nus nombre: ".$this->getUsNombre()."\n<<>>\n";
			
	}

    public function esDeshabilitado(){
        $resp = true;
        if($this->getUsDeshabilitado() == NULL || $this->getUsDeshabilitado() == "0000-00-00 00:00:00"){
            $resp = false;
        }
        return $resp;
    }


    public function deshabilitar(){
        $unaFecha = date("Y-m-d h:i:sa");
        echo $unaFecha;
        $this->setUsDeshabilitado($unaFecha);
        $resp=$this->modificar();

        return $resp;
    }
}