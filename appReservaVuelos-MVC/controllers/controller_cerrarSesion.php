<?php
    require_once "controller_session.php";
    iniciarSession();
    eliminarSesionSinRedirigir();
    header("Location: ../index.php")
?>