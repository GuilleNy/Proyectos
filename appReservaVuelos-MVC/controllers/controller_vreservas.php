<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");
    require_once("../db/db.php");
    require_once("../models/model_inicio.php");
    require_once("../models/model_vreservas.php");
    iniciarSession();
    alertaCampoVreserva();
    
    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }else if(isset($_POST['agregar'])){
        if(!empty($_POST['vuelos']) && !empty($_POST['asiento'])){
            $reservaSelect = $_POST['vuelos'];
            $numAsiento = $_POST['asiento'];
            annadirCesta($reservaSelect,$numAsiento);//controller_session.php
            header("Refresh: 0");
            reservaAñadida();//controller_session.php

        }else{
            campoNoCompletado();//controller_session.php   
        }
    } else if(isset($_POST['reservar'])){
        $importeTotal=obtenerImporteTotal();

        require_once "controller_redsys.php";
        list($params,$signature,$version) = redireccionarPago($importeTotal);

        //estan en controller_repuestaCompra
        //realizarReserva();//model_vreservas.php
        //vaciarCesta();//controller_session.php  


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
    
    
    require_once("../views/view_vreservas.php");
    
?>