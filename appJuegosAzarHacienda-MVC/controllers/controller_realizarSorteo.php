<?php
   
    require_once ("controller_session.php");
    iniciarSession();
    require_once ("controller_comunes.php");

    
    alertaRealizarSorteo();
    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }
    var_dump($_SESSION);
    require_once("../db/db.php");
    require_once("../models/model_sorteosActivos.php");

    $sortActivos=sorteosActivos($conn);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        seleccionadoRealizarSorteo();

        if(isset($_POST['generar'])){
            generarComb();
            
        }else if(isset($_POST['realizarSorteo'])){
            if(!empty( $_POST['combGanadora'])){
                require_once("../models/model_realizarSorteo.php");
                insertarCombinacionGand($conn);
                
                repartirPremio( $conn);
                var_dump($_SESSION['ganadores']);
                alertaSorteoRealizado();
               
        
            }else{
                alertaSorteoNoRealizado();
            } 
        }
    
    
    }
    
    //var_dump($sortActivos);
    require_once ("../views/view_realizarSorteo.php");
    
?>