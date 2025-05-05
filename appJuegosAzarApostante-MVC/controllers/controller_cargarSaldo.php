<?php
   
    require_once ("controller_session.php");
    iniciarSession();
    require_once ("controller_comunes.php");

    
    alertaSaldo();
    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }
    var_dump($_SESSION);
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $importeTotal = $_POST["cantidad"];
        if ( $importeTotal > 0) {
            require_once "controller_redsys.php";
            list($params, $signature, $version) = redireccionarPago($importeTotal);
        } else {
            alertaCantNoValida();
        }
    }
    
    //var_dump($sortActivos);
    require_once ("../views/view_cargarSaldo.php");
    
?>