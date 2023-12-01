<?php
include_once('../../config.php');
$navBar=array();
array_push($navBar,['nombre'=>'Nuevo Libro', 'ubicacion'=>'/libros/index.php']);
array_push($navBar,['nombre'=>'Buscar Libro', 'ubicacion'=>'/busqueda/busqueda.php']);
// array_push($navBar,'Administracion');
?>
<!-- -->
<nav class="navbar navbar-expand-lg bg-dark  sticky-top   " data-bs-theme="dark">
    <div class="container-fluid  ">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
            <div class="navbar-nav ">
            <?php 
                foreach( $navBar as $elem){
                    $seleccionado = ($pagSeleccionada == $elem['nombre']) ? "link-underline-light link-underline-opacity-100" : "";
                    echo'
                    <h2 class="m-3 text-center">
                        <a class="link-light link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover '.  $seleccionado . '" href="'.$VISTA.$elem['ubicacion'].'">'.$elem['nombre'].'</a>
                    </h2>
                    ';
                }
            ?>
            </div>
        </div>
    </div>
</nav>
