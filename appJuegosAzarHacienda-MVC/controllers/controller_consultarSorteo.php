<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");

    iniciarSession();

    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }
    var_dump($_SESSION);
    require_once("../db/db.php");
    require_once("../models/model_sorteosActivos.php");

    $allActivos=todosLosSorteos($conn);
    
    //var_dump($sortActivos);
    require_once ("../views/view_consultarSorteo.php");

?>