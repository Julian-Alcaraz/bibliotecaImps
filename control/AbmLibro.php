<?php
class AbmLibro
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
        if ((array_key_exists('idLibro',$param)  && array_key_exists('nombreLibro',$param) &&
            array_key_exists('cantidadPag',$param) && array_key_exists('idioma',$param) &&
            array_key_exists('anioPublicacion',$param)&& array_key_exists('idAutor',$param)&& array_key_exists('idEditorial',$param) ))
            // && array_key_exists('autorDeshabilitado',$param)
        {
            $obj=new Libro();
            $idLibro = $param ['idLibro'];
            $nombreLibro = $param ['nombreLibro'];
            $cantidadPag = $param ['cantidadPag'];
            $idioma = $param ['idioma'];
            $anioPublicacion = $param ['anioPublicacion'];
            $abmEditorial= new AbmEditorial();
            $abmAutor= new AbmAutor();
            $listaE= $abmEditorial->buscar($param);
            $listaA= $abmAutor->buscar($param);
            $objAutor=$listaA[0];
            $objEditorial=$listaE[0];
            // $libroDeshabilitado = $param ['libroDeshabilitado'];
            $obj -> setear ($idLibro, $nombreLibro, $cantidadPag,$idioma,$anioPublicacion,$objAutor,$objEditorial,null);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * @param array $param
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if (isset($param['idLibro'])) {
            $obj = new Libro();
            $obj -> setear($param['idLibro'],null, null, null, null, null,null,null);
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
        if (isset($param['idLibro']))
            $resp = true;
        return $resp;
    }
    
    /**
     * Carga un libro a la BD. Espera un array como parametro.
     * Retorna un booleano
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $objLibro = $this->cargarObjeto($param);
        if ($objLibro != null and $objLibro->insertar() ){
            $resp = true;
        }
        return $resp;
    }
    /**
     * Acticva logicamente el libro a la BD. Espera un array como parametro.
     * Retorna un booleano
     * @param array $param
     */
    public function altaLogica($param){
        $resp = false;
        $objLibro = $this->cargarObjetoConClave($param);
        if ($objLibro != null and $objLibro->activarLibro() ){
            $resp = true;
        }
        return $resp;
    }
    /**
     * Borra un libro de la BD. Espera un array como parametro.
     * Retorna un booleano.
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objLibro = $this->cargarObjetoConClave($param); 
            if ($objLibro!=null and $objLibro->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }
    /**
     * Borra Logicamente un libro de la BD. Espera un array como parametro.
     * Retorna un booleano.
     * @param array $param
     * @return boolean
     */
    public function bajaLogica($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objLibro = $this->cargarObjetoConClave($param);
            if($objLibro!=null and $objLibro->eliminarLogico()){
                $resp = true;
            }
        }
        return $resp;
    }
    /**
     * Modifica un libro. Espera un array como parametro.
     * Retorna un booleano.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objLibro = $this->cargarObjeto($param);
            if($objLibro!=null and $objLibro->modificar()){
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
            if  (isset($param['idLibro'])) {
                $where.=" and idLibro=".$param['idLibro'];
            }
            if  (isset($param['nombreLibro'])) {
                $where.=" and nombreLibro ='".$param['nombreLibro']."'";
            }
            if  (isset($param['cantidadPag'])) {
                $where.=" and cantidadPag=".$param['cantidadPag'];
            }
            if  (isset($param['idioma'])) {
                $where.=" and idioma=".$param['idioma'];
            }
            if  (isset($param['anioPublicacion'])) {
                $where.=" and anioPublicacion=".$param['anioPublicacion'];
            }
            if  (isset($param['idAutor'])) {
                $where.=" and idAutor=".$param['idAutor'];
            }
            if  (isset($param['idEditorial'])) {
                $where.=" and idEditorial=".$param['idEditorial'];
            }
            if  (isset($param['libroDeshabilitado'])) {
                $where.=" and libroDeshabilitado is null";
            }
        }
        $arreglo = Libro::listar($where);
        return $arreglo;  
    }
    
    public function listarPorNombre(){
        $where=true;
        $where.=" ORDER BY nombreLibro ASC"; // no hace falta poner asc seria el predeterminado
        $arreglo = Libro::listar($where);
        return $arreglo;  
    }
    public function listarSegunEditorial($param){
        $where = " true ";
        if  (isset($param['busquedaEditorial'])) {
            $where.=" and idEditorial=".$param['busquedaEditorial'];
        }
        $where.=" ORDER BY nombreLibro ASC";
        $arreglo = Libro::listar($where);
        return $arreglo; 
    }
}
?>