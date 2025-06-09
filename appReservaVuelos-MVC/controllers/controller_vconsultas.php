<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");
    require_once("../db/db.php");
    require_once("../models/model_vconsultas.php");
    iniciarSession();
    
    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }else if(isset($_POST['consultar'])){
        
        $reservaSelect = $_POST['reserva'];
        $datos = datosReservas($reservaSelect);//model_consultarApuesta.php

        
        //var_dump($datos);
    }else if(isset($_POST['volver'])){
        header("Location: ../controllers/controller_vinicio.php ");
        exit();
    }
    $allReservas=todasReservas();//model_consultarApuesta.php

    var_dump($_SESSION);

    
    require_once("../models/model_inicio.php");
    require_once("../views/view_vconsulta.php");
    
?>