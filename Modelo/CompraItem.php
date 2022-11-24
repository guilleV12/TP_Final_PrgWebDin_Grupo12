<?php
class CompraItem extends BaseDatos{
    private $idcompraitem;
    private $idproducto;
    private $idcompra;
    private $cicantidad;
 
    public function __construct(){
        $this->idcompraitem = "";
        $this->idproducto = "";
        $this->idcompra = "";
        $this->cicantidad = "";
    }

    public function setear($idci, $idp, $idc, $cic){
        $this->setIdCompraItem($idci);
        $this->setIdProducto($idp);
        $this->setIdCompra($idc);
        $this->setCiCantidad($cic);
    }

    public function setIdCompraItem($valor){
        $this->idcompraitem = $valor;
    }

    public function setIdProducto($valor){
        $this->idproducto = $valor;
    }

    public function setIdCompra($valor){
        $this->idcompra = $valor;
    }

    public function setCiCantidad($valor){
        $this->cicantidad = $valor;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function getIdCompraItem(){
        return $this->idcompraitem;
    }

    public function getIdProducto(){
        return $this->idproducto;
    }

    public function getIdCompra(){
        return $this->idcompra;
    }

    public function getCiCantidad(){
        return $this->cicantidad;
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
        $sql="SELECT * FROM compraitem WHERE idcompraitem = '".$this->getIdCompraItem()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $compra = new Compra();
                    $producto = new Producto();
                    $compra->setIdCompra($row['idcompra']);
                    $producto->setIdProducto($row['idproducto']);
                    $compra->Buscar();
                    $producto->Buscar();
                    $this->setear($row['idcompraitem'],$producto,$compra,$row['cicantidad']);
                }
            }
        } else {
            $this->setmensajeoperacion("CompraItem->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    

	public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM compraitem ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj = new CompraItem();
                    $compra = new Compra();
                    $producto = new Producto();
                    $compra->setIdCompra($row['idcompra']);
                    $producto->setIdProducto($row['idproducto']);
                    $compra->Buscar();
                    $producto->Buscar();
                    $obj->setear($row['idcompraitem'],$producto,$compra,$row['cicantidad']);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setMensajeoperacion("CompraItem->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

	
	
	public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO compraitem(idcompraitem,idproducto,idcompra,cicantidad) 
		 VALUES('".$this->getIdCompraItem()."','".$this->getIdProducto()."','"
         .$this->getIdCompra()."','".$this->getCiCantidad()."');";
         
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("CompraItem->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraItem->insertar: ".$base->getError());
        }
        return $resp;
    }
    
   public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE compraitem SET cicantidad='".$this->getCiCantidad()
        ."' WHERE idcompraitem='".$this->getIdCompraItem()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("CompraItem->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraItem->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM compraitem WHERE idcompraitem='".$this->getIdCompraItem()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("CompraItem->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("CompraItem->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "id compra item: ".$this->getIdCompraItem()."\n<<>>\n";
			
	}
}
?>