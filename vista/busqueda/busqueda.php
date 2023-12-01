<?php 
    include_once('../../config.php');
    $pagSeleccionada= "Buscar Libro";
    
    // include_once('../estructura/header.php');
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
  
    <div id="contenido-perfil-n">
        <div class="container text-center p-4 mt-3 cajaLista">
            <h2>Lista de Roles </h2>
            <div class="table-responsive">
                <table class="table m-auto">
                    <thead class="table-dark fw-bold">
                        <tr>
                            <td>ID Rol </td>
                            <td>Descripcion</td>
                            <td>Estado</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                   
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center m-3">
            <button type="button" class="btn btn-success btn-nuevo" data-bs-toggle="modal" data-bs-target="#nuevoModal"> Nuevo Rol</button>
        </div>
        <!-- Modal Nuevo -->
        <div class="modal fade" id="nuevoModal" name="nuevoModal" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
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
        <div class="modal fade" id="editarModal" name="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
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
    </div>
    <script src="./js/.js"></script>
</body>

</html>