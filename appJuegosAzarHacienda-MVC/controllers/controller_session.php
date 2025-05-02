<?php

function iniciarSession(){
    session_start();
}

function crearSesion($usuario, $contraseña){
    if(!(isset($_SESSION["VstUsuario"]) && isset($_SESSION["VstContraseña"]))){
        $_SESSION["VstUsuario"]=$usuario;
        $_SESSION["VstContraseña"]=$contraseña;
    }
}

function verificarSesion(){
    $sessionCreada=false;
    if(isset($_SESSION["VstUsuario"]) && isset($_SESSION["VstContraseña"])){
        $sessionCreada=true;
    }
    return $sessionCreada;
}

function eliminarVariablesSesion()
{
    session_destroy();
}

function eliminarSesionSinRedirigir(){
    session_destroy();
    session_unset();
    setcookie("PHPSESSID", "" , time() - (86400 * 30), "/",$_SERVER['HTTP_HOST']);
    
}
?>