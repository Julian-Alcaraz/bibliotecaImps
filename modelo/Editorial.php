<?php
class Editorial{
    private $idEditorial;
    private $nombreEditorial;
    private $editorialDeshabilitado;
    private $mensajeOperacion;
    
    public function __construct(){
        $this->idEditorial = "";
        $this->nombreEditorial = "";
        $this->editorialDeshabilitado = null;
    }

    public function setear($id,$nombre,$estado){
        $this->setIdEditorial($id);
        $this->setNombreEditorial($nombre);
        $this->setEditorialDeshabilitado($estado);
    }

    // Seters
    public function setIdEditorial($id){$this->idEditorial= $id;}
    public function setNombreEditorial($nombre){ $this->nombreEditorial= $nombre; }
    public function setEditorialDeshabilitado($estado){ $this->editorialDeshabilitado= $estado;} 
    public function setMensajeoperacion($mens) {  $this->mensajeOperacion = $mens; } 

    // Getters
    public function getIdEditorial(){ return $this->idEditorial;}
    public function getNombreEditorial(){ return $this->nombreEditorial; }
    public function getEditorialDeshabilitado(){ return $this->editorialDeshabilitado;} 
    public function getMensajeoperacion() { return $this->mensajeOperacion ; } 

    // Metodos propios
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM editorial WHERE idEditorial = ".$this->getIdEditorial();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idEditorial'], $row['nombreEditorial'],$row['editorialDeshabilitado']); 
                }
            }
        } else {
            $this->setMensajeoperacion("editorial->cargar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO editorial( nombreEditorial , editorialDeshabilitado)  ";
        $sql.="VALUES('".$this->getNombreEditorial()."','".$this->getEditorialDeshabilitado()."',";
        if ($this->getEditorialDeshabilitado()!=null)
            $sql.= "'".$this->getEditorialDeshabilitado()."'";
        else 
            $sql.="null";
        $sql.= ");";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdEditorial($elid);
                $resp = true;
            } else {
                $this->setMensajeoperacion("editorial->insertar: ".$base->getError()[2]);
            }
        } else {
            $this->setMensajeoperacion("editorial->insertar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE editorial SET nombreEditorial='".$this->getNombreEditorial()."',";
        if ($this->getEditorialDeshabilitado()!=null)
            $sql.= "editorailDeshabilitado='".$this->getEditorialDeshabilitado()."'";
        else 
            $sql.="null";
        $sql.= " WHERE idEditorial = ".$this->getIdEditorial();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("editorial->modificar 1: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("editorial->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM editorial WHERE idEditorial =".$this->getIdEditorial();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("Editorial->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("Editorial->eliminar: ".$base->getError());
        }
        return $resp;
    }
    public function eliminarLogico(){
        $resp = false;
        $base = new BaseDatos();
        $sql = 
        "UPDATE editorial SET editorialDeshabilitado = NOW() WHERE idEditorial='" . $this->getIdEditorial() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Editorial->eliminarLogico: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Editorial->eliminarLogico: " . $base->getError());
        }
        return $resp;
    }
    public function activarEditorial (){
        $resp = false;
        $base = new BaseDatos();
        $sql = 
        "UPDATE editorial SET editorialDeshabilitado = null WHERE idEditorial='" . $this->getIdEditorial() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("Editorial->eliminarLogico: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("Editorial->eliminarLogico: " . $base->getError());
        }
        return $resp;
    }

    
    public static  function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM editorial ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){      
                    $obj= new Editorial;           
                    $obj->setear($row['idEditorial'], $row['nombreEditorial'],$row['editorialDeshabilitado']); 
                    array_push($arreglo, $obj);
                } 
            }
        } 
        return $arreglo;
    }

    public function __toString()
    {
        $frase = "Datos del objEditorial: Estado".$this -> getEditorialDeshabilitado()."<br>Nombre " . $this -> getNombreEditorial()."<br>id" .$this -> getIdEditorial();
        return $frase;
    }
}
?>