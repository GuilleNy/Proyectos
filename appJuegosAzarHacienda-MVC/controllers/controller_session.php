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


function alertalogin(){
    if (isset($_SESSION['mensajelogin'])) {
        echo "<div class='alert alert-warning'>" . $_SESSION['mensajelogin'] . "</div>";
        unset($_SESSION['mensajelogin']); // Borra el mensaje después de mostrarlo
    }
}
function noLogin(){
    $_SESSION['mensajelogin'] = "Usuario o contraseña no válido";
    header("Location: index.php");
    exit();
}

function alertaCompletarCampo(){
    if (isset($_SESSION['mensajeRegistro'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['mensajeRegistro'] . "</div>";
        unset($_SESSION['mensajeRegistro']); // Borra el mensaje después de mostrarlo
    }else if(isset($_SESSION['mensajeRegistroWarning'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['mensajeRegistroWarning'] . "</div>";
        unset($_SESSION['mensajeRegistroWarning']); 
    }
}

function registroCompletado(){
    $_SESSION['mensajeRegistro'] = "Registro completado";
    header("Location: ../controllers/controller_registro.php");
    exit();
}

function registroNoCompletado(){
    $_SESSION['mensajeRegistroWarning'] = "Completa Todos los campos.";
    header("Location: ../controllers/controller_registro.php");
    exit();
}

function alertaSorteo(){
    if (isset($_SESSION['mensajeAlta'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['mensajeAlta'] . "</div>";
        unset($_SESSION['mensajeAlta']); 
    }
}

function altaSorteoCorrecto(){
    $_SESSION['mensajeAlta']="Alta Completada";
    header("Location: ../controllers/controller_altaSorteo.php");
    exit();
}

function seleccionadoRealizarSorteo(){
    if (!empty($_POST['sorteo'])) {
        $_SESSION['sortSelec'] = $_POST['sorteo'];
    }
}

function unsetSeleccionadoRealizarSorteo(){
    unset($_SESSION["sortSelec"]);
}

function sorteoSelec($resultado){
    $_SESSION['sort'] = $resultado[0];
}
function eliminarSesionConsultarSorteo(){

    unset($_SESSION["sort"]);
}




function generarComb(){
    //$_SESSION["numGand"]=generarCombinacion();
    $_SESSION["numGand"]="30-39-5-24-36-43-8";
    
}

function alertaRealizarSorteo(){
    if (isset($_SESSION['mensajeSorteo'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['mensajeSorteo'] . "</div>";
        unset($_SESSION['mensajeSorteo']); // Borra el mensaje después de mostrarlo
    }else if(isset($_SESSION['mensajeSorteoFail'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['mensajeSorteoFail'] . "</div>";
        unset($_SESSION['mensajeSorteoFail']); 
    }
   
}

function alertaSorteoRealizado(){
    $_SESSION['mensajeSorteo']="Sorteo realizado correctamente.";
    header("Location: ../controllers/controller_realizarSorteo.php");
    exit();
}
function alertaSorteoNoRealizado(){
    $_SESSION['mensajeSorteoFail']="Debes generar una Combinacion Ganadora";
    header("Location: ../controllers/controller_realizarSorteo.php");
    exit();
}
function unsetRealizarSorteo(){
    unset($_SESSION["numGand"]);
    //unset($_SESSION['ganadores']);
}




?>