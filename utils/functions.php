<?php

/**
 * Retorna un array con los datos enviados 
 * @return array
 */

function data_submitted()
{
    $_AAux = array();
    if (!empty($_REQUEST)) {
        foreach ($_REQUEST as $indice => $valor) {
            $_AAux[$indice] = ($valor === "") ? null : $valor;
        }
    }
    return $_AAux;
}

/**
 * Convierte un OBJ a array
 */
function dismount($object)
{
    $reflectionClass = new ReflectionClass(get_class($object));
    $array = array();
    foreach ($reflectionClass->getProperties() as $property) {
        $property->setAccessible(true);
        $array[$property->getName()] = $property->getValue($object);
        $property->setAccessible(false);
    }
    return $array;
}
/**
* Convierteun array de OBJ en un array de arrays (matriz) 
*/
function convert_array($param)
{
    $_AAux = array();
    if (!empty($param)) {
        if (count($param)) {
            foreach ($param as $obj) {
                array_push($_AAux, dismount($obj));
            }
        }
    }
    return $_AAux;
}

/**
 * Carga automaticamente una clase
 */
spl_autoload_register(function ($class_name) {
    $directorys = array(
        $GLOBALS['ROOT'] . 'modelo/',
        $GLOBALS['ROOT'] . 'modelo/conector/',
        $GLOBALS['ROOT'] . 'control/',
    );
    foreach ($directorys as $directory) {
        if (file_exists($directory . "" . $class_name . '.php')) {
            require_once($directory . "" . $class_name . '.php');
            return;
        }
    }
});
