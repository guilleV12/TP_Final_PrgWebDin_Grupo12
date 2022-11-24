
<?php
class AbmProducto{

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Producto
     */
    private function cargarObjeto($param){
        //print_r($param);
        $obj = null;
        if( array_key_exists('idproducto',$param) and array_key_exists('pronombre',$param) and array_key_exists('prodetalle',$param)
         and array_key_exists('procantstock',$param)){
            //echo "Crear Obj";
            $obj = new Producto();
            $obj->setear($param['idproducto'], $param['pronombre'], $param['prodetalle'], $param['procantstock']);
        }
        return $obj;
    }

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     *  que son claves
     * @param array $param
     * @return Producto
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        /* echo print_r($param); */
        if(isset($param['idproducto']) ){
            $obj = new Producto();
            $obj->Buscar($param['idproducto']);
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
        if (isset($param['idproducto']))
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
            if  (isset($param['idproducto']))
                $where.=" and idproducto ='".$param['idproducto']."'";
        }
        $arreglo = Producto::listar($where);  
        return $arreglo;
    }
} 

?>