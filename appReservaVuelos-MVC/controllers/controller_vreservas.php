<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");
    require_once("../db/db.php");
    require_once("../models/model_vreservas.php");
    iniciarSession();
    
    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }else if(isset($_POST['agregar'])){

        $reservaSelect = $_POST['vuelos'];
        $numAsiento = $_POST['asiento'];

        annadirCesta($reservaSelect,$numAsiento);//controller_session.php
        header("Refresh: 0");
    } else if(isset($_POST['comprar'])){
        //



    }else if(isset($_POST['vaciar'])){
        vaciarCesta();//controller_session.php
        header("Refresh: 0");
    }else if(isset($_POST['volver'])){
        header("Location: ../controllers/controller_vinicio.php ");
        exit();
    }
    $allVuelos=vuelosDisponibles();//model_vreservas.php

    var_dump($_SESSION);
    $cesta = devolverCesta();//controller_session.php
    
    require_once("../models/model_inicio.php");
    require_once("../views/view_vreservas.php");
    
?>