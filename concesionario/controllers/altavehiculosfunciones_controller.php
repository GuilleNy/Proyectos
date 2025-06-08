<?php
function mostrarCodigo(){
    $a = $_SESSION['usuario']['idcliente'];
    echo $a;
}

function mostrarNombre(){
    $a = datosEmpleado($_SESSION['usuario']['idcliente']);
    echo $a['nombre'] . ' ' . $a['apellidos'];
}


?>