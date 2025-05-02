<?php

function depurar($cadena){
    $cadena=trim($cadena);
    $cadena=stripslashes($cadena);
    $cadena=htmlspecialchars($cadena);
    return $cadena;
}

function customError($errno, $errstr) {
    echo "<b>Error:</b> [$errno] $errstr<br>";
    echo "Ending Script";
    die();
}

set_error_handler("customError",E_USER_WARNING);

function errores($errno, $errstr) {
    echo "<b>$errstr</b>";
}

set_error_handler("errores");

?>