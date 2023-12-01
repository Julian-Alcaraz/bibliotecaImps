<?php
class Autor{
    private $idAutor;
    private $nombreAutor;
    private $apellidoAutor;
    private $lugarNacimiento;
    private $fechaNacimiento;
    private $autorDeshabilitado;
    private $mensajeOperacion;
    
    public function __construct(){
        $this->idAutor = "";
        $this->nombreAutor = "";
        $this->apellidoAutor= "";
        $this->lugarNacimiento= "";
        $this->fechaNacimiento= "";
        $this->autorDeshabilitado = null;
    }
    
    public function setear($id,$nombre,$apellido,$lugar,$fecha,$estado){
        $this->setidAutor($id);
        $this->setNombreEditorial($nombre);
        $this->setApellidoAutor($apellido);
        $this->setLugarNacimiento($lugar);
        $this->setFechaNacimiento($fecha);
        $this->setAutorDeshabilitado($estado);
    }

    // Seters
    public function setIdAutor($id){$this->idAutor= $id;}
    public function setNombreEditorial($nombre){ $this->nombreAutor= $nombre; }
    public function setApellidoAutor($apellido){ $this->apellidoAutor= $apellido; }
    public function setLugarNacimiento($lugar) {  $this->lugarNacimiento  = $lugar; } 
    public function setFechaNacimiento($fecha) {  $this->fechaNacimiento = $fecha; } 
    public function setAutorDeshabilitado($estado){ $this->autorDeshabilitado= $estado;} 
    public function setMensajeoperacion($mens) {  $this->mensajeOperacion = $mens; } 
    
    // Getters
    public function getIdAutor(){ return $this->idAutor;}
    public function getNombreAutor(){ return $this->nombreAutor; }
    public function getApellidoAutor(){return $this->apellidoAutor; }
    public function getLugarNacimiento() { return $this->lugarNacimiento  ; } 
    public function getFechaNacimiento() { return $this->fechaNacimiento ; } 
    public function getAutorDeshabilitado(){ return $this->autorDeshabilitado;} 

    // Metodos propios
    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM autor WHERE idAutor = ".$this->getIdAutor();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idAutor'], $row['nombreAutor'],$row['apellidoAutor'],$row['lugarNacimiento'],$row['fechaNacimiento'],$row['autorDeshabilitado']); 
                }
            }
        } else {
            $this->setMensajeoperacion("autor->cargar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO autor ( nombreAutor ,apellidoAutor,lugarNacimiento,fechaNacimiento,autorDeshabilitado)  ";
        $sql.="VALUES('".$this->getNombreAutor()."','".$this->getApellidoAutor()."',".$this->getLugarNacimiento()."',".$this->getFechaNacimiento()."',";
        if ($this->getAutorDeshabilitado()!=null)
            $sql.= "'".$this->getAutorDeshabilitado()."'";
        else 
            $sql.="null";
        $sql.= ");";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setidAutor($elid);
                $resp = true;
            } else {
                $this->setMensajeoperacion("Autor->insertar: ".$base->getError()[2]);
            }
        } else {
            $this->setMensajeoperacion("autor->insertar: ".$base->getError()[2]);
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE autor SET nombreAutor='".$this->getNombreAutor()."',";
        if ($this->getAutorDeshabilitado()!=null)
            $sql.= "autorDeshabilitado='".$this->getAutorDeshabilitado()."'";
        else 
            $sql.="null";
        $sql.= " WHERE idAutor = ".$this->getIdAutor();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("autor->modificar 1: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("autor->modificar 2: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM autor WHERE idAutor =".$this->getIdAutor();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("autor->eliminar: ".$base->getError());
            }
        } else {
            $this->setMensajeoperacion("autor->eliminar: ".$base->getError());
        }
        return $resp;
    }
    public function eliminarLogico(){
        $resp = false;
        $base = new BaseDatos();
        $sql = 
        "UPDATE autor SET autorDeshabilitado = NOW() WHERE idAutor='" . $this->getIdAutor() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("autor->eliminarLogico: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("autor->eliminarLogico: " . $base->getError());
        }
        return $resp;
    }
    public function activarEditorial (){
        $resp = false;
        $base = new BaseDatos();
        $sql = 
        "UPDATE autor SET autorDeshabilitado = null WHERE idAutor='" . $this->getIdAutor() . "'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setmensajeoperacion("autor->activarLogico: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("autor->activarLogico: " . $base->getError());
        }
        return $resp;
    }

    public static  function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM autor ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){      
                    $obj= new Autor;           
                    $obj->setear($row['idAutor'], $row['nombreAutor'],$row['apellidoAutor'],$row['lugarNacimiento'],$row['fechaNacimiento'],$row['autorDeshabilitado']); 
                    array_push($arreglo, $obj);
                } 
            }
        } 
        return $arreglo;
    }

    public function __toString()
    {
        $frase = "Datos del objAutor: Estado".$this -> getAutorDeshabilitado()."<br>Nombre " . $this -> getNombreAutor()."<br>id" .$this -> getIdAutor().
        "<br>Apellido" .$this -> getApellidoAutor()."<br> Lugar Nacimiento" .$this -> getLugarNacimiento()."<br>Fecha Nacimiento" .$this -> getFechaNacimiento();
        return $frase;
    }
}
?>