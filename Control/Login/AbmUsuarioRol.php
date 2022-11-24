<?php
class AbmUsuarioRol{

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idusuario',$param) and array_key_exists('idrol',$param)){
            //echo "Crear Obj";
            $obj = new UsuarioRol();
            $obj->setear($param['idusuario'], $param['idrol']);
        }
        return $obj;
    }

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     *  que son claves
     * @param array $param
     * @return UsuarioRol
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        /* echo print_r($param); */
        if(isset($param['idusuario']) ){
            $obj = new Menu();
            $obj->Buscar($param['idusuario']);
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
        if (isset($param['idusuario']))
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
        echo " Modificacion()"; */
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
            if  (isset($param['idusuario']))
                $where.=" and idusuario ='".$param['idusuario']."'";
        }
        $arreglo = UsuarioRol::listar($where);  
        return $arreglo;
    }
} 

?>