<?php
include_once('../../../config.php') ;
$datos= data_submitted();
$ambEditorial=new AbmEditorial();
$resp= $ambEditorial->abm($datos);
if($resp){
    echo json_encode(array("success" => true));
    echo "<script>console.log('anduvo')</script>";
}else{
    echo "<script>console.log('no anduvo')</script>";
}
?>