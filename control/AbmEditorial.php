<?php
class AbmEditorial
{
    /**
     * Funcion ABM. Espera un array de parametro. Indicando la accion a realizar.
     * Retorna un array con un mensaje y un booleano segun su exito.
     * @param array $datos
     * @return boolean
     */
    public function abm($datos){
        $array = [];
        $array ["exito"] = false;  
        $array ["mensaje"] = "";      
        if (isset($datos['accion'])) 
        {
            if($datos['accion']=='editar')
            {
                if ($this->modificacion($datos)) {
                    $array ["exito"] = true;
                }
            }
            if($datos['accion']=='borrar') 
            {
                if ($this->baja($datos)) 
                {
                    $array ["exito"] = true;
                }
            }
            if($datos['accion']=='borrarLogico') 
            {
                if ($this->bajaLogica($datos)) 
                {
                    $array ["exito"] = true;
                }
            }
            if ($datos['accion'] == 'nuevo') {
                $id = $this->alta($datos);
                if ($id <> null) {
                    $array["exito"] = true;
                }
            }    
            if ($datos['accion'] == 'altaLogica') {
                $id = $this->altaLogica($datos);
                if ($id <> null) {
                    $array["exito"] = true;
                }
            }          
            if ($array ["exito"]) {
                $array ["mensaje"] = "<h3 class='text-success'>La accion " . $datos['accion'] . " se realizo correctamente.</h3>";
            } else {
                $array ["mensaje"] = "<h3 class='text-danger'>La accion " . $datos['accion'] . " no pudo concretarse.</h3>";
            } 
        }
        return $array;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto.
     * @param array $param
     */
    private function cargarObjeto ($param){
        $obj = null;
        if ((array_key_exists('idEditorial',$param)  && array_key_exists('nombreEditorial',$param) 
        ))
            // && array_key_exists('editorialDeshabilitado',$param)   
        {
            $obj=new Editorial();
            $idEditorial = $param ['idEditorial'];
            $nombreEditorial = $param ['nombreEditorial'];
            // $editorialDeshabilitado = $param ['editorialDeshabilitado'];
            $obj -> setear ($idEditorial, $nombreEditorial,null);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * @param array $param
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if (isset($param['idEditorial'])) {
            $obj = new Editorial();
            $obj -> setear($param['idEditorial'],null,null);
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
        if (isset($param['idEditorial']))
            $resp = true;
        return $resp;
    }
    
    /**
     * Carga una Editorial a la BD. Espera un array como parametro.
     * Retorna un booleano
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $objEditorial = $this->cargarObjeto($param);
        if ($objEditorial != null and $objEditorial->insertar() ){
            $resp = true;
        }
        return $resp;
    }
    /**
     * Activa logicamente el Editorial a la BD. Espera un array como parametro.
     * Retorna un booleano
     * @param array $param
     */
    public function altaLogica($param){
        $resp = false;
        $objEditorial = $this->cargarObjeto($param);
        if ($objEditorial != null and $objEditorial->activarEditorial() ){
            $resp = true;
        }
        return $resp;
    }
    /**
     * Borra un Editorial de la BD. Espera un array como parametro.
     * Retorna un booleano.
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objEditorial = $this->cargarObjetoConClave($param); 
            if ($objEditorial!=null and $objEditorial->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }
    /**
     * Borra Logicamente una Editorial de la BD. Espera un array como parametro.
     * Retorna un booleano.
     * @param array $param
     * @return boolean
     */
    public function bajaLogica($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objLibro = $this->cargarObjeto($param);
            if($objLibro!=null and $objLibro->eliminarLogico()){
                $resp = true;
            }
        }
        return $resp;
    }
    /**
     * Modifica un Editorial. Espera un array como parametro.
     * Retorna un booleano.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objEditorial = $this->cargarObjeto($param);
            if($objEditorial!=null and $objEditorial->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    /**
     * Busca en la BD con o sin parametros. Espera un array como parametro.
     * Retorna un array con lo encontrado.
     * @param array $param
     * @return array
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL)
        {
            if  (isset($param['idEditorial'])) {
                $where.=" and idEditorial=".$param['idEditorial'];
            }
            if  (isset($param['nombreEditorial'])) {
                $where.=" and nombreEditorial ='".$param['nombreEditorial']."'";
            }
            if  (isset($param['editorialDeshabilitado'])) {
                $where.=" and editorialDeshabilitado=".$param['editorialDeshabilitado'];
            }
        }
        $arreglo = Editorial::listar($where);
        return $arreglo;  
    }
}
?>