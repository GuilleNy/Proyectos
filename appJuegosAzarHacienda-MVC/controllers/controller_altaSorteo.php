<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");

    iniciarSession();

    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
    }

    var_dump($_SESSION);



    require_once("../views/view_altaSorteo.php");

?>