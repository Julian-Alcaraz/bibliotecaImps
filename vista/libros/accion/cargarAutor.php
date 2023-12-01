<?php
include_once('../../../config.php') ;
$datos= data_submitted();
$ambAutor=new AbmAutor();
$resp= $ambAutor->abm($datos);
if($resp){
    echo json_encode(array("success" => true));
    echo "<script>console.log('anduvo')</script>";
}else{
    echo json_encode(array("success" => false));
    echo "<script>console.log('no anduvo')</script>";
}
?>