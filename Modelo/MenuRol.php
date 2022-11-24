<?php
class MenuRol extends BaseDatos{
    private $idmenu;
    private $idrol;
    
    public function __construct(){
        $this->idmenu = "";
        $this->idrol = "";
    } 

    public function setear($idm, $idr){
        $this->setIdMenu($idm);
        $this->setIdRol($idr);
    }

    public function setIdMenu($valor){
        $this->idmenu = $valor;
    }

    public function setIdRol($valor){
        $this->idrol = $valor;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function getIdMenu(){
        return $this->idmenu;
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
        $sql="SELECT * FROM menurol WHERE idmenu = '".$this->getIdMenu()->getIdMenu()."' AND idrol='".$this->getIdrol()->getIdrol()."'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $menu = new Menu();
                    $rol = new Rol();
                    $menu->setIdMenu($row['idmenu']);
                    $rol->setIdRol($row['idrol']);
                    $menu->Buscar();
                    $rol->Buscar();
                    $this->setear($menu, $rol);
                }
            }
        } else {
            $this->setmensajeoperacion("MenuRol->listar: ".$base->getError());
        }
        return $resp;
    
        
    }
    

	public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM menurol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj= new MenuRol();
                    $menu = new Menu();
                    $rol = new Rol();
                    $menu->setIdMenu($row['idmenu']);
                    $rol->setIdRol($row['idrol']);
                    $menu->Buscar();
                    $rol->Buscar();
                    $obj->setear($menu, $rol);
                    array_push($arreglo, $obj);
                }
               
            }
            
        } else {
            $this->setMensajeoperacion("MenuRol->listar: ".$base->getError());
        }
 
        return $arreglo;
    }

	
	 
	public function insertar(){
        //echo "insertar";
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO menurol(idmenu, idrol) 
		 VALUES('".$this->getIdMenu()."','".$this->getIdRol()."');";
        if ($base->Iniciar()) {
            
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("MenuRol->insertar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("MenuRol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
   public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        
        $sql="UPDATE menurol SET idmenu='".$this->getIdMenu()."', idrol='".$this->getIdRol()
        ."' WHERE idmenu='".$this->getIdMenu()."' AND idrol='".$this->getIdRol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("MenuRol->modificar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("MenuRol->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM menurol WHERE idmenu='".$this->getIdMenu()."' AND idrol='".$this->getIdrol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setMensajeoperacion("MenuRol->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("MenuRol->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "id menu: ".$this->getIdMenu()->getIdMenu()."\nid rol: ".$this->getIdRol()->getIdRol()."\n<<>>\n";
			
	}
}