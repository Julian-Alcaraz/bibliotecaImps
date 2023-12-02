<?php
include_once('../../config.php');
$pagSeleccionada = "Buscar Libro";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    include_once($ESTRUCTURA . "/header.php");
    include_once($ESTRUCTURA . "/navBar.php");
    ?>
</head>
<?php
$datos = data_submitted();
// si existe un id de editorial carga solo los libros de esa editorial, sino carga todos, ordenados de manera asc
$abmLibro = new AbmLibro();
if (isset($datos['busquedaEditorial'])) {
    $listaLibros = $abmLibro->listarSegunEditorial($datos);
} else {
    $listaLibros = $abmLibro->listarPorNombre();
}

// crear lista de Autores y editorial en formato Json para poder buscar los mismos en base a su id en js
$abmAutor = new AbmAutor();
$listaAutores = $abmAutor->buscar(null);
$arrayAutores= convert_array($listaAutores);
$arrayJsonAutores = json_encode($arrayAutores, JSON_PRETTY_PRINT);

// editoriales, lo mismo que con autores
$abmEditorial = new AbmEditorial();
$listaEditoriales = $abmEditorial->buscar(null);
$arrayEditoriales= convert_array($listaEditoriales);
$arrayJsonEditoriales = json_encode($arrayEditoriales, JSON_PRETTY_PRINT);
?>
<!-- Cargp a js los arreglos  -->
<script>
    var arregloAutores = <?php echo $arrayJsonAutores; ?>;
    var arregloEditoriales = <?php echo $arrayJsonEditoriales; ?>;
</script>

<body>
    <div class="container text-center p-4 mt-3 rounded-4 shadow-lg" style="background-color: #FFFEFD">
        <h2>Lista de Libros </h2>
        <div class="row justify-content-center  my-2">
            <div class="col-4 border p-3 rounded-3 " style="  background-color: #F7E7CE;">
                <!-- formulario que envia el id de la editorial deseada para filtrar se envia a la misma pagina -->
                <form action="" id="cambiarLista" method="GET">
                    <label for="busquedaEditorial" class="form-label"><h6>Buscar por Editorial</h6></label>
                    <select name="busquedaEditorial" id="busquedaEditorial" class="form-select" onchange="submitForm(this.value)">
                        <?php
                        echo '<option  value="" > Muestra todos los libros </option>';
                        foreach ($listaEditoriales as $editorial) {
                            if (isset($datos['busquedaEditorial']) && ($datos['busquedaEditorial'] == $editorial->getIdEditorial())) {
                                echo '<option selected value="' . $editorial->getIdEditorial() . '" >' . $editorial->getNombreEditorial() . '</option>';
                            } else {
                                echo '<option value="' . $editorial->getIdEditorial() . '" >' . $editorial->getNombreEditorial() . '</option>';
                            }
                        }
                        ?>
                    </select>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table m-auto table-bordered">
                <thead class="table-dark fw-bold">
                    <tr>
                        <th>Id</th>
                        <th>Nombre </th>
                        <th>Cantidad Paginas</th>
                        <th>Idioma</th>
                        <th>A&ntilde;o Publicaci&otilde;n</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // listo los libros
                    foreach ($listaLibros as $libro) {
                        echo '<tr><td>' . $libro->getIdLibro() . '</td>' .
                            '<td>' . $libro->getNombreLibro() . '</td>' .
                            '<td>' . $libro->getCantidadPag() . '</td>' .
                            '<td>' . $libro->getIdioma() . '</td>' .
                            '<td>' . $libro->getAnioPublicacion() . '</td>' .
                            '<td><button class="btn btn-info"  onclick="abrirModalAutor(' . $libro->getObjAutor()->getIdAutor() . ')">Ver Datos</button></td>' . // paso el id del autor a la funcion js
                            '<td><button class="btn btn-info"  onclick="abrirModalEditorial(' . $libro->getObjEditorial()->getIdEditorial() . ')">Ver Datos</button></td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Autor -->
    <div class="modal fade" id="modalAutor" name="modalAutor" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-light" style="background-color:#623B1A ;">
                    <h1 class="modal-title fs-5" id="editarModalLabel">Autor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="contenidoModalAutor" class="text-center"></div>
                </div>
                <div class="modal-footer " style="background-color:#623B1A ;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- Modal Editorial -->
    <div class="modal fade" id="modalEditorial" name="modalEditorial" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-light" style="background-color:#623B1A ;">
                    <h1 class="modal-title fs-5" id="ModalLabel">Editorial</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="contenidoModalEditorial"class="text-center"></div>
                </div>
                <div class="modal-footer " style="background-color:#623B1A ;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/funciones.js"></script>
</body>

</html>