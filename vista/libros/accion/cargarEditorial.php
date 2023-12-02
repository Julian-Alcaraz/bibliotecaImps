<?php
include_once('../../../config.php') ;
$datos= data_submitted();
$ambEditorial=new AbmEditorial();
$resp= $ambEditorial->abm($datos);
if($resp){
    echo json_encode(array("success" => true));
}
?>