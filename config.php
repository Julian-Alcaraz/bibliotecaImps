<?php 
header('Content-Type: text/html; charset=utf-8');
header ("Cache-Control: no-cache, must-revalidate ");
// cambiar esta ruta con la de tu proyecto, es lo que sigue despues de /htdocs en xampp
$PROYECTO = 'ProyectosJuli/bibliotecaImps'; 
//variable que almacena el directorio del proyecto
$ROOT = $_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";
$GLOBALS['ROOT'] = $ROOT;

// Archivo funciones: 
include_once($GLOBALS['ROOT'].'utils/functions.php');

// variables
$ESTRUCTURA = $ROOT.'vista/estructura';
$VISTA = '/'.$PROYECTO.'/vista';
$UTILS = '/'.$PROYECTO.'/utils';
$CSS = '/'.$PROYECTO.'/vista/css';
$JS = '/'.$PROYECTO.'/vista/js';
?>