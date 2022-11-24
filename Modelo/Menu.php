<?php
class Menu extends BaseDatos{
    private $idmenu;
    private $menombre;
    private $medescripcion;
    private $idpadre;
    private $medeshabilitado;
    
    public function __construct(){
        $this->idmenu = "";
        $this->menombre = "";
        $this->medescripcion = "";
        $this->idpadre = null;
        $this->medeshabilitado = "";
    }

    public function setear($idm, $men, $med, $idp, $medh){
        $this->setIdMenu($idm);
        $this->setMeNombre($men);
        $this->setMeDescripcion($med);
        $this->setIdPadre($idp);
        $this->setMeDeshabilitado($medh);
    }

    public function setIdMenu($valor){
        $this->idmenu = $valor;
    }

    public function setMeNombre($valor){
        $this->menombre = $valor;
    }

    public function setMeDescripcion($valor){
        $this->medescripcion = $valor;
    }

    public function setIdPadre($valor){
        $this->idpadre = $valor;
    }

    public function setMeDeshabilitado($valor){
        $this->medeshabilitado = $valor;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    public function getIdMenu(){
        return $this->idmenu;
    }

    public function getMeNombre(){
        return $this->menombre;
    }

    public function getMeDescripcion(){
        return $this->medescripcion;
    }

    public function getIdPadre(){
        return $this->idpadre;
    }

    public function getMeDeshabilitado(){
        return $this->medeshabilitado;
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
        $sql="SELECT * FROM menu WHERE idmenu = '".$this->getIdMenu()."'";
      //  echo $sql;
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $objMenuPadre =null;
                    if ($row['idpadre']!=null or $row['idpadre']!='' ){
                        $objMenuPadre = new Menu();
                        $objMenuPadre->setIdMenu($row['idpadre']);
                        $objMenuPadre->Buscar();
                    }
                    $this->setear($row['idmenu'], $row['menombre'],$row['medescripcion'],$objMenuPadre,$row['medeshabilitado']); 
                    
                }
            }
        } else {
            $this->setMensajeoperacion("Menu->Buscar: ".$base->getError());
        }
        return $resp;
        
        
    }
    

    public static  function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM menu ";
     //   echo $sql;
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                
                while ($row = $base->Registro()){
                    $obj = new Menu();
                    $objMenuPadre =null;
                    if ($row['idpadre']!=null){
                        $objMenuPadre = new Menu();
                        $objMenuPadre->setIdMenu($row['idpadre']);
                        $objMenuPadre->Buscar();
                    }
                    $obj->setear($row['idmenu'], $row['menombre'],$row['medescripcion'],$objMenuPadre,$row['medeshabilitado']); 
                    array_push($arreglo, $obj);
                }   
            } 
        }else{
            $this->setMensajeoperacion("Menu->listar: ".$base->getError());
        }
        return $arreglo;
    } 

	
	
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO menu( idmenu,menombre,medescripcion,idpadre,medeshabilitado) VALUES('".$this->getIdMenu()."','".$this->getMeNombre()."','".$this->getMeDescripcion()."',";
        if ($this->getIdPadre()!= null)
            $sql.=$this->getIdPadre()->getIdMenu().",";
        else
            $sql.="null,";
        if ($this->getMeDeshabilitado()!=null)
            $sql.= "'".$this->getMeDeshabilitado()."'";
        else 
            $sql.="null";
        $sql.= ");";
     // echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Menu->insertar: ".$base->getError()[2]);
            }
        } else {
            $this->setMensajeoperacion("Menu->insertar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE menu SET menombre='".$this->getMeNombre()."',medescripcion='".$this->getMeDescripcion()."'";
        if ($this->getIdPadre()!= null) 
            $sql.=",idpadre= ".$this->getIdPadre()->getIdMenu();
         else
            $sql.=",idpadre= null";
        if ($this->getMeDeshabilitado()!= null)
            $sql.=",medeshabilitado= '".$this->getMeDeshabilitado();
         else
            $sql.=",medeshabilitado= null";
        $sql.= "' WHERE idmenu='".$this->getIdMenu()."'";
         
        //echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
                
            } else {
                $this->setMensajeoperacion("Menu->modificar 1: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Menu->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM menu WHERE idmenu =".$this->getIdMenu();
       // echo $sql;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Menu->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Menu->eliminar: ".$base->getError());
        }
        return $resp;
    }

	public function __toString(){
	    return "id menu: ".$this->getIdMenu()."\nNombre: ".$this->getMeNombre()."\n<<>>\n";
			
	}

    public function deshabilitar(){
        $unaFecha = date("Y-m-d h:i:sa");
        echo $unaFecha;
        $this->setMeDeshabilitado($unaFecha);
        $resp=$this->modificar();

        return $resp;
    }
}


?>