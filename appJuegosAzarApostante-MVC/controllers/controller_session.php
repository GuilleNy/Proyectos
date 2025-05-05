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

function sorteoSelec($resultado){
    $_SESSION['sort'] = $resultado[0];
}
function eliminarSesionConsultarSorteo(){

    unset($_SESSION["sort"]);
}

function eliminarSsesionesConsultarApuesta(){

    unset($_SESSION["datosApuestas"]);
}

function nameUsuario(){
    return $_SESSION["VstUsuario"];
}

function saldoApostante(){
    $_SESSION["saldo"]=saldoApostador();
}

function guardarDatosApuestas($datos) {
    $_SESSION['datosApuestas'] = $datos;
}

function apuestaRealizada(){

    $_SESSION['mensajeApuesta']="Apuesta realizada";
    header("Location: ../controllers/controller_realizarApuesta.php");
    exit();
}

function noHaySaldo(){
    $_SESSION['mensajeApuestaFail']="No tienes saldo en tu cuenta";
    header("Location: ../controllers/controller_realizarApuesta.php");
    exit();

}
function alertaSaldo(){
    if (isset($_SESSION['cantNoValida'])) {
        echo "<div class='alert alert-warning'>" . $_SESSION['cantNoValida'] . "</div>";
        unset($_SESSION['cantNoValida'] ); 
    }
}

function alertaCantNoValida(){
    $_SESSION['cantNoValida']="La cantidad debe ser numeros positivos";
    header("Location: ../controllers/controller_cargarSaldo.php");
    exit();
}

function rellenarAllCampos(){
    $_SESSION['mensajeLlenarCampo']="Tienes que rellenar todos los campos sin que esten repetidos entre ellos.";
    header("Location: ../controllers/controller_realizarApuesta.php");
    exit();
}

function alertaRealizarApuesta(){
    if (isset($_SESSION['mensajeApuesta'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['mensajeApuesta'] . "</div>";
        unset($_SESSION['mensajeApuesta'] ); 
    
    
    }else if(isset( $_SESSION['mensajeApuestaFail']) ){
        echo "<div class='alert alert-danger'>" . $_SESSION['mensajeApuestaFail'] . "</div>";
        unset($_SESSION['mensajeApuestaFail']); 
    }else if(isset( $_SESSION['mensajeLlenarCampo']) ){
        echo "<div class='alert alert-danger'>" . $_SESSION['mensajeLlenarCampo'] . "</div>";
        unset($_SESSION['mensajeLlenarCampo']); 
    }
    
}

/*
function alertaCargarSaldo(){
    if (isset($_SESSION['compraRealizada'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['compraRealizada'] . "</div>";
        unset($_SESSION['compraRealizada'] ); 
    
    
    }else if(isset( $_SESSION['compraNoRealizada']) ){
        echo "<div class='alert alert-danger'>" . $_SESSION['compraNoRealizada'] . "</div>";
        unset($_SESSION['compraNoRealizada']); 
    }
}

function alertaCargoRealizado(){
    $_SESSION['compraRealizada']="Compra Realizada Con Exito.";
    header("Location: ../controllers/controller_repuestaCompra.php");
    exit();
}

function alertaCargoNoRealizada(){
    $_SESSION['compraNoRealizada']="Compra en Espera. Pago no Realizado.";
    header("Location: ../controllers/controller_repuestaCompra.php");
    exit();
}
*/

?>