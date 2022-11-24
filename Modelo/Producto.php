<?php
class Producto extends BaseDatos{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
 
    public function __construct(){
        $this->idproducto = "";
        $this->pronombre = "";
        $this->prodetalle = "";
        $this->procantstock = "";
    }

    public function setear($idp, $pn, $pd, $pcs){
        $this->setIdProducto($idp);
        $this->setPronombre($pn);
        $this->setProdetalle($pd);
        $this->setProCantStock($pcs);
    }

    public function setIdProducto($valor){
        $this->idproducto = $valor;
    }

    public function setPronombre($valor){
        $this->pronombre = $valor;
    }

    public function setProdetalle($valor){
        $this->prodetalle = $valor;
    }

    public function setProCantStock($valor){
        $this->procantstock = $valor;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function getIdProducto(){
        return $this->idproducto;
    }

    public function getProNombre(){
        return $this->pronombre;
    }

    public function getProDetalle(){
        return $this->prodetalle;
    }

    public function getProCantStock(){
        return $this->procantstock;
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
        $sql="SELECT * FROM producto WHERE idproducto = '".$this->getIdProducto()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idproducto'],$row['pronombre'],$row['prodetalle'],$row['procantstock']);
                }
            }
        } else {
            $this->setmensajeoperacion("Producto->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    

	public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM producto ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj = new Producto();
                    $obj->setear($row['idproducto'],$row['pronombre'],$row['prodetalle'],$row['procantstock']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setMensajeoperacion("Producto->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

	
	
	public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO producto(idproducto,pronombre,prodetalle,procantstock) 
		 VALUES('".$this->getIdProducto()."','".$this->getProNombre()."','"
         .$this->getProDetalle()."','".$this->getProCantStock()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Producto->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Producto->insertar: ".$base->getError());
        }
        return $resp;
    }
    
   public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE producto SET pronombre='".$this->getProNombre()."',prodetalle='".$this->getProDetalle()."',procantstock='".
        $this->getProCantStock()
        ."' WHERE idproducto='".$this->getIdProducto()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Producto->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Producto->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM producto WHERE idproducto='".$this->getIdProducto()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("Producto->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Producto->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "id producto: ".$this->getIdProducto()." \npronombre: ".$this->getPronombre().
        " \nprod stock: ".$this->getProCantStock()."\n<<>>\n";
			
	}
}
?>