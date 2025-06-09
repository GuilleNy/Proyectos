<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");

    iniciarSession();

    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }else if(isset($_POST['reservar'])){
        header("Location: ../controllers/controller_vreservas.php");
        exit();
    }else if(isset($_POST['consultar'])){
        header("Location: ../controllers/controller_vconsultas.php");
        exit();
    }else if(isset($_POST['salir'])){
        require_once("controller_cerrarSesion.php");
    }

    
    //eliminarSesionConsultarSorteo();//revisar esto
    //eliminarSsesionesConsultarApuesta();//revisar esto
    var_dump($_SESSION);
    require_once("../db/db.php");
    require_once("../models/model_inicio.php");
    require_once("../views/view_vinicio.php");

?>