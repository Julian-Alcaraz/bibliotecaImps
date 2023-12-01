<?php
class Libro{
    private $idLibro;
    private $nombreLibro;
    private $cantidadPag;
    private $idioma;
    private $anioPublicacion;
    private $objAutor;
    private $objEditorial;
    private $libroDeshabilitado;
    private $mensajeOperacion;

    public function __construct(){
        $this->idLibro='';
        $this->nombreLibro='';
        $this->cantidadPag='';
        $this->idioma='';
        $this->anioPublicacion='';
        $this->objAutor= new Autor;
        $this->objEditorial= new Editorial;
        $this->libroDeshabilitado=null;
    }

    public function setear($id,$nombre,$pags,$idioma,$anio,$objAutor,$objEditorial,$estado){
        $this->setIdLibro($id);
        $this->setNombreLibro($nombre);
        $this->setCantidadPag($pags);
        $this->setIdioma($idioma);
        $this->setAnioPublicacion($anio);
        $this->setObjAutor($objAutor);
        $this->setObjEditorial($objEditorial);
        $this->setLibroDeshabilitado($estado);
    }
    // setters
    public function setIdLibro($id){ $this->idLibro=$id;}
    public function setNombreLibro($nombre){ $this->nombreLibro=$nombre;}
    public function setCantidadPag($pags){ $this->cantidadPag=$pags;}
    public function setIdioma($idioma){ $this->idioma=$idioma;}
    public function setAnioPublicacion($anio){ $this->anioPublicacion=$anio;}
    public function setObjAutor($objAutor){ $this->objAutor=$objAutor;}
    public function setObjEditorial($objEditorial){ $this->objEditorial=$objEditorial;}
    public function setLibroDeshabilitado($estado){ $this->libroDeshabilitado=$estado;}
    public function setMensajeoperacion($mens) {  $this->mensajeOperacion = $mens; } 

    // getters
    public function getIdLibro(){ return $this->idLibro;}
    public function getNombreLibro(){ return $this->nombreLibro;}
    public function getCantidadPag(){ return $this->cantidadPag;}
    public function getIdioma(){ return $this->idioma;}
    public function getAnioPublicacion(){ return $this->anioPublicacion;}
    public function getObjAutor(){ return $this->objAutor;}
    public function getObjEditorial(){ return $this->objEditorial;}
    public function getLibroDeshabilitado(){ return $this->libroDeshabilitado;}
    public function getMensajeoperacion() { return $this->mensajeOperacion ; } 

    // metedos
    public function cargar()
    {
        $respuesta = false;
        $base = new BaseDatos();
        $sql = 
        "SELECT * FROM compra WHERE idLibro = " . $this->getIdLibro();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro();
                    $idLibro = $row['idLibro'];
                    $nombre = $row['nombreLibro'];
                    $cantidadPag = $row['cantidadPag'];
                    $idioma = $row['idioma'];
                    $anioPublicacion = $row['anioPublicacion'];
                    $idioma = $row['idioma'];
                    $ambAutor = new AbmAutor();
                    $array = [];
                    $array ['idAutor'] = $row[''];
                    $listaAutores = $ambAutor -> buscar ($array);
                    $objAutor = $listaAutores[0];
                    $abmEditorial = new AbmEditorial();
                    $array = [];
                    $array ['idEditorial'] = $row['idEditorial'];
                    $listaEditoriales = $abmEditorial -> buscar ($array);
                    $objEditorial = $listaEditoriales[0];
                    $estado=$row['libroDeshabilitado'];
                    $this -> setear($idLibro, $nombre, $cantidadPag,$idioma,$anioPublicacion,$objAutor,$objEditorial,$estado);
                }
            }
        } else {
            $this->setMensajeOperacion("compra->listar: " . $base->getError());
        }
        return $respuesta;
    }

    public function insertar()
    {
        $respuesta = false;
        $ultimoId = null;
        $base = new BaseDatos();
        $objAutor = $this->getObjAutor();
        $objEditorial = $this->getObjEditorial();
        $sql = 
        "INSERT INTO libro (nombreLibro,cantidadPag,idioma,anioPublicacion,idAutor,idEditorial)
            VALUES ('" 
            .$this->getNombreLibro() . "', '" 
            .$this->getCantidadPag() . "', '" 
            .$this->getIdioma() . "', '"  
            .$this->getAnioPublicacion() . "', '"  
            .$objAutor->getIdAutor() . "', '".  
            $objEditorial->getIdEditorial() . "')";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $respuesta = true;
                $ultimoId = $base -> devolverUltimoId("idLibro");
            } else {
                $this->setMensajeOperacion("Libro->insertar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("libro->insertar: " . $base->getError());
        }
        return $ultimoId;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $objAutor = $this->getObjAutor();
        $objEditorial = $this->getObjEditorial();
        $sql = 
        "UPDATE libro SET 
            nombreLibro='" . $this->getNombreLibro() . "',
            cantidadPag='" . $this->getCantidadPag() . "',
            idioma='" . $this->getIdioma() . "',
            anioPublicacion='" . $this->getAnioPublicacion() . "',
            idAutor='" . $objAutor->getIdAutor() . "',
            idEditorial='" . $objEditorial->getIdEditorial() . "',
            WHERE idLibro='" . $this->getIdLibro() . "'";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("libro->modificar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion("libro->modificar: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $respuesta = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM libro WHERE idLibro = " . $this->getIdLibro();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $respuesta = true;
            } else {
                $this->setMensajeOperacion("libro->eliminar: " . $base->getError());
            }
        } else {
            $this->setMensajeOperacion("libro->eliminar: " . $base->getError());
        }
        return $respuesta;
    }

    public static function listar($parametro = "")
    {
        $arreglo = array();
        $base = new BaseDatos;
        $sql = "SELECT * FROM libro ";
        if ($parametro != "") {
            $sql .= "WHERE " . $parametro;
        }
        $res = $base->Ejecutar($sql);
        if ($res > -1) {
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $abmAutor = new AbmAutor();
                    $abmEditorial = new AbmEditorial();
                    $obj = new Libro();
                    $array = [];
                    $array ['idAutor'] = $row['idAutor'];
                    $listaAutores = $abmAutor -> buscar ($array);
                    $objAutores = $listaAutores[0];
                    $array ['idEditorial'] = $row['idEditorial'];
                    $listaEditoriales = $abmEditorial -> buscar ($array);
                    $objEditorial = $listaEditoriales[0];
                    $idLibro=$row['idLibro'];
                    $nombreLibro=$row['nombreLibro'];
                    $cantidadPag=$row['cantidadPaginas'];
                    $idioma=$row['idioma'];
                    $anio=$row['anioPublicacion'];
                    $estado = $row['libroDeshabilitado'];
                    $obj -> setear($idLibro,$nombreLibro,$cantidadPag,$idioma,$anio,$objAutores,$objEditorial,$estado);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            //$this->setMensajeoperacion("libro->listar: " . $base->getError());
        }
        return $arreglo;
    }

    public function __toString()
    {
        $frase ="
        <br> nombreLibro=" . $this->getNombreLibro() . "
        <br>cantidadPag=" . $this->getCantidadPag() . "
        <br>idioma=" . $this->getIdioma() . "
        <br> anioPublicacion=" . $this->getAnioPublicacion() . "
        <br>idAutor=" . $this->getObjAutor()->getIdAutor() . "
        <br> idEditorial=" . $this->getObjEditorial()->getIdEditorial() ;
        return $frase;
    }
}

?>