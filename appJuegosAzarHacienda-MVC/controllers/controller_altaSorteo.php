<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");

    iniciarSession();
    alertaSorteo();
    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['darAlta'])){
            require_once("../db/db.php");
            require_once ("../models/model_altaSorteo.php");
            darAlta($conn);
            altaSorteoCorrecto();
        }
    }
    var_dump($_SESSION);
    require_once("../views/view_altaSorteo.php");

?>