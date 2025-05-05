<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");

    iniciarSession();//

    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }
    
    //agrego esta funcion para eliminar la sesion realizada en consultar Sorteo
    //par que cuando de el boton de atras este cargue este controlador y pueda borrar
    //esa sesion. $_SESSION["sort"]
    eliminarSesionConsultarSorteo();
    unsetRealizarSorteo();
    unsetSeleccionadoRealizarSorteo();
    var_dump($_SESSION);
    require_once("../views/view_inicio.php");

?>