<?php
class AbmAutor
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
                if ($this->alta($datos)) 
                {
                    $array ["exito"] = true;
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
        if ((array_key_exists('idAutor',$param)  && array_key_exists('nombreAutor',$param) &&
            array_key_exists('apellidoAutor',$param) && array_key_exists('lugarNacimiento',$param) &&
            array_key_exists('fechaNacimiento',$param)  ))
            // && array_key_exists('autorDeshabilitado',$param)
        {
            $obj = new Autor();
            $idAutor = $param ['idAutor'];
            $nombreAutor = $param ['nombreAutor'];
            $apellidoAutor = $param ['apellidoAutor'];
            $lugarNacimiento = $param ['lugarNacimiento'];
            $fechaNacimiento = $param ['fechaNacimiento'];
            // $autorDeshabilitado = $param ['autorDeshabilitado'];
            $obj -> setear ($idAutor, $nombreAutor, $apellidoAutor,$lugarNacimiento,$fechaNacimiento,null);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * @param array $param
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if (isset($param['idAutor'])) {
            $obj = new Autor();
                $obj -> setear($param['idAutor'], null, null, null, null,  null);
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
        if (isset($param['idAutor']))
            $resp = true;
        return $resp;
    }
    
    /**
     * Carga un autor a la BD. Espera un array como parametro.
     * Retorna un booleano
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $objAutor = $this->cargarObjeto($param);
        if ($objAutor != null and $objAutor->insertar() ){
            $resp = true;
        }
        return $resp;
    }
    /**
     * Acticva logicamente el autor a la BD. Espera un array como parametro.
     * Retorna un booleano
     * @param array $param
     */
    public function altaLogica($param){
        $resp = false;
        $objAutor = $this->cargarObjetoConClave($param);
        if ($objAutor != null and $objAutor->activarAutor() ){
            $resp = true;
        }
        return $resp;
    }
    /**
     * Borra un Autor de la BD. Espera un array como parametro.
     * Retorna un booleano.
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objAutor = $this->cargarObjetoConClave($param); 
            if ($objAutor!=null and $objAutor->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }
    /**
     * Borra Logicamente un autor de la BD. Espera un array como parametro.
     * Retorna un booleano.
     * @param array $param
     * @return boolean
     */
    public function bajaLogica($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objAutor = $this->cargarObjetoConClave($param);
            if($objAutor!=null and $objAutor->eliminarLogico()){
                $resp = true;
            }
        }
        return $resp;
    }
    /**
     * Modifica un autor. Espera un array como parametro.
     * Retorna un booleano.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objAutor = $this->cargarObjeto($param);
            if($objAutor!=null and $objAutor->modificar()){
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
            if  (isset($param['idAutor'])) {
                $where.=" and idAutor=".$param['idAutor'];
            }
            if  (isset($param['nombreAutor'])) {
                $where.=" and nombreAutor ='".$param['nombreAutor']."'";
            }
            if  (isset($param['apellidoAutor'])) {
                $where.=" and apellidoAutor=".$param['apellidoAutor'];
            }
            if  (isset($param['lugarNacimiento'])) {
                $where.=" and lugarNacimiento=".$param['lugarNacimiento'];
            }
            if  (isset($param['fechaNacimiento'])) {
                $where.=" and fechaNacimiento=".$param['fechaNacimiento'];
            }
            if  (isset($param['autorDeshabilitado'])) {
                $where.=" and autorDeshabilitado is null";
            }
        }
        $arreglo = Autor::listar($where);
        return $arreglo;  
    }
}
?>