<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");
    require_once("../db/db.php");
    require_once("../models/model_vreservas.php");
    require_once("../models/model_inicio.php");
    require_once("../models/model_vchecking.php");

    iniciarSession();
    alertaChecking();

    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }else if(isset($_POST['hacerChecking'])){
        
        $datos=$_POST['vuelos'];

        annadirAsiento($datos);
        header("Refresh: 0");
        checkingHecho();
        
    }else if(isset($_POST['volver'])){
        header("Location: ../controllers/controller_vinicio.php ");
        exit();
    }else if(isset($_POST['salir'])){
        require_once("controller_cerrarSesion.php");
    }

   
    $allReservas=obtenerReservas();//model_vreservas.php
  
   
    var_dump($_SESSION);
   
    require_once("../views/view_vchecking.php");

?>