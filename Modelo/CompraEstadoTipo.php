<?php
class CompraEstadoTipo extends BaseDatos{
    private $idcompraestadotipo;
    private $cetdescripcion;
    private $cetdetalle;
 
    public function __construct(){
        $this->idcompraestadotipo = "";
        $this->cetdescripcion = "";
        $this->cetdetalle = "";
    }

    public function setear($idce, $cetdesc, $cetdet){
        $this->setIdCompraEstadoTipo($idce);
        $this->setCetDescripcion($cetdesc);
        $this->setCetDetalle($cetdet);
    }

    public function setIdCompraEstadoTipo($valor){
        $this->idcompraestadotipo = $valor;
    }

    public function setCetDescripcion($valor){
        $this->cetdescripcion = $valor;
    }

    public function setCetDetalle($valor){
        $this->cetdetalle = $valor;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function getIdCompraEstadoTipo(){
        return $this->idcompraestadotipo;
    }

    public function getCetDescripcion(){
        return $this->cetdescripcion;
    }

    public function getCetDetalle(){
        return $this->cetdetalle;
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
        $sql="SELECT * FROM compraestadotipo WHERE idcompraestadotipo = '".$this->getIdCompraEstadoTipo()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                }
            }
        } else {
            $this->setmensajeoperacion("CompraEstadoTipo->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    

	public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestadotipo ";
        if ($parametro!="") {
            $sql.=' WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj = new CompraEstadoTipo();
                    $obj->setear($row['idcompraestadotipo'],$row['cetdescripcion'],$row['cetdetalle']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setMensajeoperacion("CompraEstadoTipo->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

	
	
	public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraestadotipo(idcompraestadotipo,cetdescripcion,cetdetalle) 
		 VALUES('".$this->getIdCompraEstadoTipo()."','".$this->getCetDescripcion()."','"
         .$this->getCetDetalle()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("CompraEstadoTipo->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraEstadoTipo->insertar: ".$base->getError());
        }
        return $resp;
    }
    
   public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE compraestadotipo SET cetdescripcion='".$this->getCetDescripcion()."',cetdetalle='".$this->getCetDetalle()
        ."' WHERE idcompraestadotipo='".$this->getIdCompraEstadoTipo()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("CompraEstadoTipo->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraEstadoTipo->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraestadotipo WHERE idcompraestadotipo='".$this->getIdCompraEstadoTipo()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("CompraEstadoTipo->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraEstadoTipo->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "id compra estado tipo: ".$this->getIdCompraEstadoTipo()."\ncet descripcion: ".$this->getCetDescripcion().
        "\ncet detalle: ".$this->getCetDetalle()."\n<<>>\n";
			
	}
}
?>