<?php
define('FUNCIONES_URL', __DIR__ . 'funciones.php');

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}