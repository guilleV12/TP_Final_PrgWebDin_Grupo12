<?php
class CompraEstado extends BaseDatos{
    private $idcompraestado;
    private $idcompra;
    private $idcompraestadotipo;
    private $cefechaini;
    private $cefechafin;
 
    public function __construct(){
        $this->idcompraestado = "";
        $this->idcompra = "";
        $this->idcompraestadotipo = "";
        $this->cefechaini = "";
        $this->cefechafin = "";
    }

    public function setear($idce, $idc, $idcet, $cefi, $ceff){
        $this->setIdCompraEstado($idce);
        $this->setIdCompra($idc);
        $this->setIdCompraEstadoTipo($idcet);
        $this->setCeFechaIni($cefi);
        $this->setCeFechaFin($ceff);
    }

    public function setIdCompraEstado($valor){
        $this->idcompraestado = $valor;
    }

    public function setIdCompra($valor){
        $this->idcompra = $valor;
    }

    public function setIdCompraEstadoTipo($valor){
        $this->idcompraestadotipo = $valor;
    }

    public function setCeFechaIni($valor){
        $this->cefechaini = $valor;
    }

    public function setCeFechaFin($valor){
        $this->cefechafin = $valor;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function getIdCompraEstado(){
        return $this->idcompraestado;
    }

    public function getIdCompra(){
        return $this->idcompra;
    }

    public function getIdCompraEstadoTipo(){
        return $this->idcompraestadotipo;
    }

    public function getCeFechaIni(){
        return $this->cefechaini;
    }

    public function getCeFechaFin(){
        return $this->cefechafin;
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
        $sql="SELECT * FROM compraestado WHERE idcompraestado = '".$this->getIdCompraEstado()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $compra = new Compra();
                    $compraestadotipo = new CompraEstadoTipo();
                    $compra->setIdCompra($row['idcompra']);
                    $compraestadotipo->setIdCompraEstadoTipo($row['idcompraestadotipo']);
                    $compra->Buscar();
                    $compraestadotipo->Buscar();
                    $this->setear($row['idcompraestado'],$compra, $compraestadotipo, $row['cefechaini'], $row['cefechafin']);
                }
            }
        } else {
            $this->setmensajeoperacion("CompraEstado->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    

	public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraestado ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $compra = new Compra();
                    $compraestadotipo = new CompraEstadoTipo();
                    $compra->setIdCompra($row['idcompra']);
                    $compraestadotipo->setIdCompraEstadoTipo($row['idcompraestadotipo']);
                    $compra->Buscar();
                    $compraestadotipo->Buscar();
                    $obj = new CompraEstado();
                    $obj->setear($row['idcompraestado'],$compra,$compraestadotipo,$row['cefechaini'],$row['cefechafin']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setMensajeoperacion("CompraEstado->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

	
	
	public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraestado(idcompraestado,idcompra,idcompraestadotipo,cefechaini,cefechafin) 
		 VALUES('".$this->getIdCompraEstado()."','".$this->getIdCompra()."','"
         .$this->getIdCompraEstadoTipo()."','".$this->getCeFechaIni()."','".$this->getCeFechaFin()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("CompraEstado->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraEstado->insertar: ".$base->getError());
        }
        return $resp;
    }
    
   public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE compraestado SET cefechaini='".$this->getCeFechaIni()."',cefechafin='".$this->getCeFechaFin()."',idcompraestadotipo='".$this->getIdCompraEstadoTipo()
        ."' WHERE idcompraestado='".$this->getIdCompraEstado()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("CompraEstado->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraEstado->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraestado WHERE idcompraestado='".$this->getIdCompraEstado()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("CompraEstado->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraEstado->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "id compra estado: ".$this->getIdCompraEstado()."\nid compra: ".$this->getIdCompra()->getIdCompra().
        "\nid compraestado tipo: ".$this->getIdCompraEstadoTipo()."\n<<>>\n";
			
	}
}