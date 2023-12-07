<?php
include_once('../../../config.php') ;
$datos= data_submitted();
$abmLibros=new AbmLibro();
$resp= $abmLibros->abm($datos);
if($resp){
    echo json_encode(array("success" => true));
}
?>