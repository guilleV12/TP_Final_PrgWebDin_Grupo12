<?php

class AbmMenu{

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Menu
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idmenu',$param) and array_key_exists('menombre',$param)){
            $obj = new Menu();
            $objmenu = null;
            if (isset($param['idpadre'])){
                $objmenu = new Menu();
                $objmenu->setIdMenu($param['idpadre']);
                $objmenu->Buscar();
                
            }
            
            $obj->setear($param['idmenu'], $param['menombre'],$param['medescripcion'],$objmenu,$param['medeshabilitado']); 
        }
        return $obj;
    }

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     *  que son claves
     * @param array $param
     * @return Menu
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        /* echo print_r($param); */
        if(isset($param['idmenu']) ){
            $obj = new Menu();
            $obj->Buscar($param['idmenu']);
        }
        return $obj;
    }


     /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idmenu']))
            $resp = true;
        return $resp;
    }


    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        //$param['NroDni'] =null;
        $unObjPersona = $this->cargarObjeto($param);
        if ($unObjPersona!=null and $unObjPersona->insertar()){
            $resp = true;
        }
        return $resp;
        
    }

    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        /* print_r($param);
        echo "baja"; */
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $unObjPersona = $this->cargarObjeto($param);
            if ($unObjPersona!=null and $unObjPersona->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /** 
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        /* print_r($param);
        echo " Modificacion()";*/ 
        if ($this->seteadosCamposClaves($param)){
            $unObjPersona = $this->cargarObjeto($param);
            //verEstructura($unObjPersona);
            if($unObjPersona!=null and $unObjPersona->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * permite buscar un objeto
     * @param array $param
     * @return boolean
     */
    public function buscar($param){
        $where = " true ";
        $arreglo = [];
        //print_r($param);
        if ($param<>NULL){
            if  (isset($param['idmenu']))
                $where.=" and idmenu ='".$param['idmenu']."'";
        }
        $arreglo = Menu::listar($where);  
        return $arreglo;
        
    }

    public function deshabilitar($param){
        $resp = false;
        
        if ($this->seteadosCamposClaves($param)){
            $objUsuario = $this->cargarObjeto($param);
            //verEstructura($objUsuario);
            if($objUsuario != null and $objUsuario->deshabilitar()){
                $resp = true;
            }
        }
        return $resp;
    }
}  

?>