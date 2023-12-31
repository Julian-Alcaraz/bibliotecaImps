<?php
include_once('../../config.php');
$pagSeleccionada = "Nuevo Libro";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once($ESTRUCTURA . "/header.php");
    include_once($ESTRUCTURA . "/navBar.php");
    ?>
</head>

<body>
    <?php 
    // cargo las listas de autores y editoriales
    $ambAutor = new AbmAutor();
    $abmEditorial = new AbmEditorial();
    $listaAutores = $ambAutor->buscar(null);
    $listaEditoriales = $abmEditorial->buscar(null);
    ?>
    <div class="container-fluid">
        <div class="row justify-content-center text-center">
            <div class="col-10 p-4 border my-4 rounded-4 shadow-lg" style="background-color: #FFFEFD">
                <h4> Formulario para cargar Libro</h4>
                <form name="cargarLibroForm" id="cargarLibroForm" action="" method="post">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombreL" class="form-label">Nombre</label>
                            <input type="text" id="nombreL" name="nombreL" class="form-control" placeholder="Nombre del libro ">
                        </div>
                        <div class="col-md-6">
                            <label for="cantP" class="form-label">Cantidad de Paginas</label>
                            <input type="number" id="cantP" name="cantP" class="form-control" placeholder="Cantidad de Paginas">
                        </div>
                        <div class="col-md-6">
                            <label for="idioma" class="form-label">Idioma</label>
                            <input type="text" id="idioma" name="idioma" class="form-control" placeholder="Idioma">
                        </div>
                        <div class="col-md-6">
                            <label for="anio" class="form-label">A&ntilde;o Publicacion</label>
                            <input type="number" id="anio" name="anio" class="form-control" placeholder="Fecha Publicacion">
                        </div>
                        <input id="accion" name="accion" value="nuevo" type="hidden">
                        <div class="col-md-6" class="form-label">
                            <label for="idAutor">Autor</label>
                            <select name="idAutor" id="idAutor" class="form-select" placeholder="First name">
                                <?php
                                // listo todos los autores
                                foreach ($listaAutores as $autor) {
                                    echo '<option value="' . $autor->getIdAutor() . '" >' . $autor->getNombreAutor().' '.$autor->getApellidoAutor(). '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6" class="form-label">
                            <label for="idEditorial">Editorial</label>
                            <select name="idEditorial" id="idEditorial" class="form-select" placeholder="First name">
                                <?php
                                // listo todas las editoriales
                                foreach ($listaEditoriales as $editorial) {
                                    echo '<option value="' . $editorial->getIdEditorial() . '" >' . $editorial->getNombreEditorial() . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <input class="btn btn-success btn-cargar " type="submit" value="Cargar Libro">
                    </div>
                </form>
                <!-- botones para abrir los modales, funcionan con bootstrap -->
                <div class="row  justify-content-center ">
                    <div class="col-md-2 mt-2">
                        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#cargarAutor">Cargar Autor</button>
                    </div>
                    <div class="col-md-2 mt-2">
                        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#cargarEditorial">Cargar Editorial</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Nuevo Autor-->
    <div class="modal fade" id="cargarAutor" name="cargarAutor" tabindex="-1" aria-labelledby="cargarAutorLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form name="cargarAutorForm" id="cargarAutorForm" method="post">
                <div class="modal-content">
                    <div class="modal-header text-light" style="background-color:#623B1A ;">
                        <h1 class="modal-title fs-5" id="editarModalLabel">Nuevo Autor</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombreA" class="form-label">Nombre</label>
                                <input type="text" id="nombreA" name="nombreA" class="form-control" placeholder="Nombre del Autor ">
                            </div>
                            <div class="col-md-6">
                                <label for="apellidoA" class="form-label">Apellidoo</label>
                                <input type="text" id="apellidoA" name="apellidoA" class="form-control" placeholder="Apellido Autor">
                            </div>
                            <div class="col-md-6">
                                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                                <input type="text" id="nacionalidad" name="nacionalidad" class="form-control" placeholder="Nacionalidad">
                            </div>
                            <div class="col-md-6" class="form-label">
                                <label for="fecha">Fecha Nacimiento</label>
                                <input type="date" name="fecha" id="fecha" class="form-select" placeholder="First name">
                            </div>
                        </div>
                    </div>
                    <input id="accion" name="accion" value="nuevo" type="hidden">
                    <div class="modal-footer " style="background-color:#623B1A ;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input class="btn btn-success btn-cargarAutor " type="submit" value="Cargar Autor">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Nuevo  EDITORIAL -->
    <div class="modal fade" id="cargarEditorial" name="cargarEditorial" tabindex="-1" aria-labelledby="cargarEditorialLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form name="cargarEditorialForm" id="cargarEditorialForm" method="post">
                <div class="modal-content">
                    <div class="modal-header text-light" style="background-color:#623B1A ;">
                        <h1 class="modal-title fs-5" id="editarModalLabel">Editar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <input id="accion" name="accion" value="nuevo" type="hidden">
                            <div class="col-md-12">
                                <label for="nombreE" class="form-label">Nombre</label>
                                <input type="text" id="nombreE" name="nombreE" class="form-control" placeholder="Nombre del Editorial ">
                            </div>
                        </div>
                    </div>
                    <input id="accionEditar" name="accionEditar" value="editar" type="hidden">
                    <input id="rolDeshabilitadoEditar" name="rolDeshabilitadoEditar" type="hidden">
                    <div class="modal-footer " style="background-color:#623B1A ;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input class="btn btn-success btn-cargarEditorial " type="submit" value="Cargar Editorial">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/funciones.js"></script>
</body>

</html>