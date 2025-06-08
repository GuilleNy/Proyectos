<?php
function mostrarEmail(){
    $a = $_SESSION['usuario']['idcliente'];
    echo $a;
}

function mostrarNombre(){
    $a = datosCliente($_SESSION['usuario']['idcliente']);
    echo $a['nombre'] . ' ' . $a['apellidos'];
}


?>