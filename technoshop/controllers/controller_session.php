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

function rellenarAllCampos(){
    $_SESSION['mensajeLlenarCampo']="Tienes que rellenar todos los campos sin que esten repetidos entre ellos.";
    header("Location: ../controllers/controller_realizarApuesta.php");
    exit();
}

function alertaCampoVreserva(){
    if (isset($_SESSION['vueloAñadido'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['vueloAñadido'] . "</div>";
        unset($_SESSION['vueloAñadido']); // Borra el mensaje después de mostrarlo
    }else if(isset($_SESSION['completarCampo'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['completarCampo'] . "</div>";
        unset($_SESSION['completarCampo']); 
    }
}

function annadirCesta($reservaSelect){
    
    $detallesVuelo=explode("|", $reservaSelect);

    if (isset($_SESSION["compra"]["producto"])) {
        $cestaProducto = $_SESSION["compra"]["producto"];
        $cestaProducto[] = $detallesVuelo;
    } else {
        $cestaProducto = array();
        $cestaProducto[] = $detallesVuelo;
    }

    $_SESSION["compra"]["producto"] = $cestaProducto;
    

}

function devolverCesta()
{
    $cesta = null;
    if(isset($_SESSION["compra"]["producto"]))
        $cesta = $_SESSION["compra"]["producto"];
    return $cesta;
}

function vaciarCesta()
{
    unset($_SESSION["compra"]["producto"]);
}

function obtenerImporteTotal(){
    $datos=devolverCesta();
    $importeTotal=0;

    foreach ($datos as $clave => $valor) {

        if($valor[3] != 0){
            $precioConDescuento=($valor[2]*$valor[3])/100;
            $importeTotal=$importeTotal+$precioConDescuento;
        }else{
            $importeTotal=$importeTotal+$valor[2];
        }
    }
    return $importeTotal;
}



?>