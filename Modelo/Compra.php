<?php
class Compra extends BaseDatos{
    private $idcompra;
    private $cofecha;
    private $idusuario;
 
    public function __construct(){
        $this->idcompra = "";
        $this->cofecha = "";
        $this->idusuario = "";
    }

    public function setear($idc, $cof, $idu){
        $this->setIdCompra($idc);
        $this->setCoFecha($cof);
        $this->setIdUsuario($idu);
    }

    public function setIdCompra($valor){
        $this->idcompra = $valor;
    }

    public function setCoFecha($valor){
        $this->cofecha = $valor;
    }

    public function setIdUsuario($valor){
        $this->idusuario = $valor;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function getIdCompra(){
        return $this->idcompra;
    }

    public function getCoFecha(){
        return $this->cofecha;
    }

    public function getIdusuario(){
        return $this->idusuario;
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
        $sql="SELECT * FROM compra WHERE idcompra = '".$this->getIdCompra()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $usuario = new Usuario();
                    $usuario->setIdUsuario($row['idusuario']);
                    $usuario->Buscar();
                    $this->setear($row['idcompra'],$row['cofecha'],$usuario);
                }
            }
        } else {
            $this->setmensajeoperacion("Compra->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    

	public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compra ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $usuario = new Usuario();
                    $usuario->setIdUsuario($row['idusuario']);
                    $usuario->Buscar();
                    $obj = new Compra();
                    $obj->setear($row['idcompra'],$row['cofecha'],$usuario);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setMensajeoperacion("Compra->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

	
	
	public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compra(idcompra,cofecha,idusuario) 
		 VALUES('".$this->getIdCompra()."','".$this->getCoFecha()."','".$this->getIdUsuario()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Compra->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Compra->insertar: ".$base->getError());
        }
        return $resp;
    }
    
   public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE compra SET cofecha='".$this->getCoFecha()
        ."' WHERE idcompra='".$this->getIdCompra()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Compra->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Compra->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compra WHERE idcompra='".$this->getIdCompra()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("Compra->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Compra->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "id compra: ".$this->getIdCompra()."\nid usuario: ".$this->getIdusuario()->getIdusuario()."\n<<>>\n";
			
	}
}