<?php
include_once('../../../config.php') ;
$datos= data_submitted();
$ambLibro=new AbmLibro();
$resp= $ambLibro->abm($datos);
if($resp){
    echo json_encode(array("success" => true));
}
?>