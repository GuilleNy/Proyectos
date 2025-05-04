<?php
   
    require_once ("controller_session.php");
    iniciarSession();
    require_once ("controller_comunes.php");

    
    //alertaRealizarSorteo(); no funciona las alertas
    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }
    var_dump($_SESSION);
    require_once("../db/db.php");
    require_once("../models/model_consultarApuesta.php");
    require_once("../models/model_sorteosActivos.php");

    $allActivos =todosLosSorteos();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['consultarApuestas'])){
            
            $sorteoSele = $_POST['sorteo'];
            $datos = sorteoSeleccionado($sorteoSele);
            $_SESSION['datosApuestas'] = $datos;
            //var_dump($datos);
        
           
        }
    }
    
    //var_dump($sortActivos);
    require_once ("../views/view_consultarApuesta.php");
    
?>