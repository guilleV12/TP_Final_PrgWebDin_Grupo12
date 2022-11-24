<?php
class Rol extends BaseDatos{
    private $idrol;
    private $rodescripcion;
    
    public function __construct(){
        $this->idrol = "";
        $this->rodescripcion = "";
    }

    public function setear($idr, $desc){
        $this->setIdRol($idr);
        $this->setRoDescripcion($desc);
    }

    public function setIdRol($valor){
        $this->idrol = $valor;
    }

    public function setRoDescripcion($valor){
        $this->rodescripcion = $valor;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function getIdRol(){
        return $this->idrol;
    }

    public function getRoDescripcion(){
        return $this->rodescripcion;
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
        $sql="SELECT * FROM rol WHERE idrol = '".$this->getIdRol()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idrol'], $row['rodescripcion']);
                }
            }
        } else {
            $this->setmensajeoperacion("Rol->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    

	public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM rol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $rol = new Rol();
                    $rol->setear($row['idrol'], $row['rodescripcion']);
                    array_push($arreglo, $rol);
                }
               
            }
            
        } else {
            $this->setMensajeoperacion("Rol->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

	
	
	public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO rol(idrol, rodescripcion) 
		 VALUES('".$this->getIdRol()."','".$this->getRoDescripcion()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Rol->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Rol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE rol SET rodescripcion='".$this->getRoDescripcion()
        ."' WHERE idrol='".$this->getIdRol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Rol->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Rol->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM rol WHERE idrol='".$this->getIdRol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("Rol->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Rol->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "id rol: ".$this->getIdRol()."\ndescripcion: ".$this->getRoDescripcion()."\n<<>>\n";
			
	}
}