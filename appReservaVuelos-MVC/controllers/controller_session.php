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

function alertaCampoVreserva(){
    if (isset($_SESSION['vueloAñadido'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['vueloAñadido'] . "</div>";
        unset($_SESSION['vueloAñadido']); // Borra el mensaje después de mostrarlo
    }else if(isset($_SESSION['completarCampo'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['completarCampo'] . "</div>";
        unset($_SESSION['completarCampo']); 
    }
}

function reservaAñadida(){
    $_SESSION['vueloAñadido'] = "Vuelo añadido a la cesta.";
}

function campoNoCompletado(){
    $_SESSION['completarCampo'] = "Completa Todos los campos.";
    header("Location: ../controllers/controller_vreservas.php");
    exit();
}

function alertaChecking(){
    if (isset($_SESSION['checkingHecho'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['checkingHecho'] . "</div>";
        unset($_SESSION['checkingHecho']); // Borra el mensaje después de mostrarlo
    }
}

function checkingHecho(){
    $_SESSION['checkingHecho'] = "Checking Realizado con éxito.";
}













function annadirCesta($reservaSelect,$numAsiento){
    $precio=precioAsignado($reservaSelect);//
    $datos=$reservaSelect."|".$numAsiento."|".$precio;
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

function precioAsignado($reservaSelect){

    $detallesPedido=explode("|",$reservaSelect);
    $idVuelo=$detallesPedido[0];
    $capacidadVuelo= obtenerCapacidaPorId($idVuelo);
    $capacidadAvion=$capacidadVuelo['capacity'];
    //var_dump($capacidadAvion);
    /**El precio de la reserva se calcula en base a la capacidad del avión. Si la capacidad es inferior a 100,
    el precio será de 80€; entre 100 y 200 será de 120€ y si es superior a 100 el precio será de 300€ */
    if($capacidadAvion < 100){
        $precio=80 ;
    }else if($capacidadAvion >= 100 && $capacidadAvion <= 200){
        $precio=120;
    }else if($capacidadAvion > 200 ){
        $precio=300;
    }
    return $precio;
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

function obtenerImporteTotal(){
    $datos=devolverCesta();
    $importeTotal=0;

    foreach ($datos as $clave => $valor) {
        $importeTotal=$importeTotal+$valor[5];
    }


    return $importeTotal;
}

/**
 * $cesta = $_SESSION["reserva"]["vuelos"];
 * echo $cesta[0][0]; // 3          (posiblemente un ID)
 * echo $cesta[0][1]; // AE1518    (número de vuelo)
 * echo $cesta[0][2]; // COLONIA   (origen)
 * echo $cesta[0][3]; // MARSELLA  (destino)
 * echo $cesta[0][4]; // 12H       (duración o salida)
 * echo $cesta[0][5]; // 120       (precio o algo similar)
 */


?>