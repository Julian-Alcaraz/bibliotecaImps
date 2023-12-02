<?php
include_once('../../config.php');
$pagSeleccionada = "Buscar Libro";

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
<?php
$datos = data_submitted();
$abmLibro = new AbmLibro();
// print_r($datos);
if (isset($datos['busquedaEditorial'])) {
    $listaLibros = $abmLibro->listarSegunEditorial($datos);
} else {
    $listaLibros = $abmLibro->listarPorNombre();
}
// print_r($listaLibros);

// crear lista de Autores y editorial en formato Json para poder buscar los mismo en base a su id en js
$abmAutor = new AbmAutor();
$listaAutores = $abmAutor->buscar(null);
$arrayAutores = array();
foreach ($listaAutores as $autor) {
    $autorDismount = dismount($autor);
    array_push($arrayAutores, $autorDismount);
}
$arrayJsonAutores = json_encode($arrayAutores, JSON_PRETTY_PRINT);
// editoriales
$abmEditorial = new AbmEditorial();
$listaEditoriales = $abmEditorial->buscar(null);
$arrayEditoriales = array();
foreach ($listaEditoriales as $editorial) {
    $editorialDismount = dismount($editorial);
    array_push($arrayEditoriales, $editorialDismount);
}
$arrayJsonEditoriales = json_encode($arrayEditoriales, JSON_PRETTY_PRINT);

?>
<!-- ya tengo en js los arreglos  -->
<script>
    var arregloAutores = <?php echo $arrayJsonAutores; ?>;
    var arregloEditoriales = <?php echo $arrayJsonEditoriales; ?>;
    // console.log(arregloAutores);
    // console.log(arregloEditoriales);
</script>

<body>
    <div class="container text-center p-4 mt-3 ">
        <h2>Lista de Libros </h2>
        <div class="row justify-content-center border my-2">
            <div class="col-4 border ">
                <form action="" id="cambiarLista" method="GET">
                    <label for="busquedaEditorial">Buscar por Editorial</label>
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
            <table class="table m-auto">
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
                    foreach ($listaLibros as $libro) {
                        echo '<tr><td>' . $libro->getIdLibro() . '</td>' .
                            '<td>' . $libro->getNombreLibro() . '</td>' .
                            '<td>' . $libro->getCantidadPag() . '</td>' .
                            '<td>' . $libro->getIdioma() . '</td>' .
                            '<td>' . $libro->getAnioPublicacion() . '</td>' .
                            '<td><button class="btn btn-secondary"  onclick="abrirModalAutor(' . $libro->getObjAutor()->getIdAutor() . ')">Ver Datos</button></td>' . // tengo que pasar el id al modal o el obj
                            '<td><button class="btn btn-secondary"  onclick="abrirModalEditorial(' . $libro->getObjEditorial()->getIdEditorial() . ')">Ver Datos</button></td></tr>'; // tengo que pasar el id al modal o el obj
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
                <div class="modal-header bg-dark text-light">
                    <h1 class="modal-title fs-5" id="editarModalLabel">Autor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="contenidoModalAutor"></div>
                </div>
                <div class="modal-footer  bg-dark">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- Modal editar -->
    <div class="modal fade" id="modalEditorial" name="modalEditorial" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form name="editarForm" id="editarForm" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-light">
                        <h1 class="modal-title fs-5" id="ModalLabel">Editorial</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="contenidoModalEditorial"></div>
                    </div>
                    <div class="modal-footer  bg-dark">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/funciones.js"></script>
</body>

</html>