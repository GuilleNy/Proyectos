<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");
    require_once("../db/db.php");
    require_once("../models/model_inicio.php");

    iniciarSession();

    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }else if(isset($_POST['comprar'])){
        header("Location: ../controllers/controller_comprarproductos.php");
        exit();
    }else if(isset($_POST['pedidos'])){
        header("Location: ../controllers/.php");
        exit();
    }else if(isset($_POST['salir'])){
        require_once("controller_cerrarSesion.php");
    }

    $datosUsuario=obtenerNombreApellido();
    
    //eliminarSesionConsultarSorteo();//revisar esto
    //eliminarSsesionesConsultarApuesta();//revisar esto
    var_dump($_SESSION);
    
    require_once("../views/view_inicio.php");

?>