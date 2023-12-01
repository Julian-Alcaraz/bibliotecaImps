<?php
include_once('../../config.php');
$pagSeleccionada = "Nuevo Libro";
// include_once('../estructura/header.php');
// include_once('../estructura/navBar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once($ESTRUCTURA . "/header.php"); ?>
    <?php
    include_once($ESTRUCTURA . "/navBar.php");
    // include_once('../estructura/navBar.php');
    // include_once($ESTRUCTURA . "/cabeceraBD.php");
    ?>
</head>

<body>
    <?php
        $ambAutor = new AbmAutor();
        $abmEditorial = new AbmEditorial();
        $listaAutores= $ambAutor->buscar(null);
        $listaEditoriales= $abmEditorial->buscar(null);
    ?>
    <div class="container text-center py-4 mt-3 border ">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="container border">
                  <h4> Formulario para cargar Libro</h4>
                  <form action="">
                    <div>
                        <label for="">Nombre</label>
                        <input type="text">
                    </div>  
                    <div>
                        <label for="">Cantidad de Paginas</label>
                        <input type="number">
                    </div>  
                    <div>
                        <label for="">Idioma</label>
                        <input type="text">
                    </div>  
                    <div>
                        <label for="">Fecha Publicacion</label>
                        <input type="text">
                    </div>  
                    <div>
                        <label for="">Autor</label>
                        <select name="" id="">
                            <?php 
                                echo '<option> Seleccion un autor</option>';
                                foreach ($listaAutores as $autor){
                                    echo '<option value="'.$autor->getIdAutor().'" >'.$autor->getNombreAutor().'</option>';
                                }
                            ?>
                        </select>
                    </div>  
                    <div>
                        <label for="">Autor</label>
                        <select name="" id="">
                            <?php 
                                echo '<option> Seleccion un Editorial</option>';
                                foreach ($listaEditoriales as $editorial){
                                    echo '<option value="'.$editorial->getIdEditorial().'" >'.$editorial->getNombreEditorial().'</option>';
                                }
                            ?>
                        </select>
                    </div> 
                  </form>
                </div>
            </div>
            <div class="col-3 mt-3">
                <div class="container border">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cargarAutor">Cargar Autor</button>
                </div>
            </div>
            <div class="col-3 mt-3">
                <div class="container border">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cargarEditorial">Cargar Editorial</button>
                </div>
            </div>
        </div>

        <div class="text-center mt-3">
            <button class="btn btn-success btn-nuevo" data-bs-toggle="modal" data-bs-target="#nuevoModal"> Nuevo Rol</button>
        </div>
    </div>
    <!-- Modal Nuevo -->
    <div class="modal fade" id="cargarAutor" name="cargarAutor" tabindex="-1" aria-labelledby="cargarAutorLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form name="nuevoform" id="nuevoform" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h1 class="modal-title fs-5" id="editarModalLabel">Nuevo Rol</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="rolDescripcion" class="form-label">Descripcion</label>
                            <input type="text" class="form-control" id="rolDescripcion" name="rolDescripcion">
                        </div>
                    </div>
                    <input id="accion" name="accion" value="nuevo" type="hidden">
                    <div class="modal-footer  bg-dark">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success" onclick="guardarCambiosNuevo()">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal editar -->
    <div class="modal fade" id="cargarEditorial" name="cargarEditorial" tabindex="-1" aria-labelledby="cargarEditorialLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form name="editarForm" id="editarForm" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h1 class="modal-title fs-5" id="editarModalLabel">Editar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id='idRolEditar' name="idRolEditar">
                        <div class="mb-3">
                            <label for="rolDescripcionEditar" class="form-label">Descripcion</label>
                            <input type="text" class="form-control" id="rolDescripcionEditar" name="rolDescripcionEditar">
                        </div>
                    </div>
                    <input id="accionEditar" name="accionEditar" value="editar" type="hidden">
                    <input id="rolDeshabilitadoEditar" name="rolDeshabilitadoEditar" type="hidden">
                    <div class="modal-footer  bg-dark">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success" onclick="guardarCambiosEditar()">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/.js"></script>
</body>

</html>