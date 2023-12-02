<?php
include_once('../../../config.php') ;
$datos= data_submitted();
$ambAutor=new AbmAutor();
$resp= $ambAutor->abm($datos);
if($resp){
    echo json_encode(array("success" => true));
}
?>