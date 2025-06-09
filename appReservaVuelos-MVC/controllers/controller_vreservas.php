<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");
    require_once("../db/db.php");
    require_once("../models/model_vreservas.php");
    iniciarSession();
    alertaCampoVreserva();
    
    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }else if(isset($_POST['agregar'])){
        if(!empty(isset($_POST['vuelos'])) && !empty(isset($_POST['asiento'])) ){
            $reservaSelect = $_POST['vuelos'];
            $numAsiento = $_POST['asiento'];
            annadirCesta($reservaSelect,$numAsiento);//controller_session.php
            header("Refresh: 0");
            reservaAñadida();//controller_session.php

        }else{
            campoNoCompletado();//controller_session.php   
        }
    } else if(isset($_POST['reservar'])){
        //



    }else if(isset($_POST['vaciar'])){
        vaciarCesta();//controller_session.php
        header("Refresh: 0");
    }else if(isset($_POST['volver'])){
        header("Location: ../controllers/controller_vinicio.php ");
        exit();
    }
    $allVuelos=vuelosDisponibles();//model_vreservas.php

    print_r($_SESSION);
    $cesta = devolverCesta();//controller_session.php
    
    require_once("../models/model_inicio.php");
    require_once("../views/view_vreservas.php");
    
?>