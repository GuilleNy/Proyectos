<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");

    iniciarSession();//

    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }
    
    eliminarSesionConsultarSorteo();
    eliminarSsesionesConsultarApuesta();
   
    var_dump($_SESSION);
    require_once("../views/view_inicio.php");

?>