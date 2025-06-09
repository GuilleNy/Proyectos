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

function emailUsuario(){
    return $_SESSION["VstUsuario"];
}

function alertalogin(){
    if (isset($_SESSION['mensajelogin'])) {
        echo "<div class='alert alert-warning'>" . $_SESSION['mensajelogin'] . "</div>";
        unset($_SESSION['mensajelogin']); // Borra el mensaje después de mostrarlo
    }
}
function noLogin(){
    $_SESSION['mensajelogin'] = "Usuario o contraseña no válido";
    
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


function rellenarAllCampos(){
    $_SESSION['mensajeLlenarCampo']="Tienes que rellenar todos los campos sin que esten repetidos entre ellos.";
    header("Location: ../controllers/controller_realizarApuesta.php");
    exit();
}

function annadirCesta($reservaSelect,$numAsiento){
    $datos=$reservaSelect."|".$numAsiento;
    $detallesVuelo=explode("|", $datos);

    if (isset($_SESSION["reserva"]["vuelos"])) {
        $cestaVuelos = $_SESSION["reserva"]["vuelos"];
        $cestaVuelos[] = $detallesVuelo;
    } else {
        $cestaVuelos = array();
        $cestaVuelos[] = $detallesVuelo;
    }

    $_SESSION["reserva"]["vuelos"] = $cestaVuelos;
    

}

function devolverCesta()
{
    $cesta = null;
    if(isset($_SESSION["reserva"]["vuelos"]))
        $cesta = $_SESSION["reserva"]["vuelos"];
    return $cesta;
}

function vaciarCesta()
{
    unset($_SESSION["reserva"]["vuelos"]);
}

function calcularPrecioVuelo(){
    $cesta=devolverCesta();

    




}

?>