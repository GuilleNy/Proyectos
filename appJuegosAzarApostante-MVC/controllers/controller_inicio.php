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
    require_once("../db/db.php");
    require_once ("../models/model_inicio.php");

    //esta funcion se encuentra en controller_session
    saldoApostante();

    
    //var_dump($_SESSION);
    require_once("../views/view_inicio.php");

?>