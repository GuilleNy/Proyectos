<?php
   
    require_once ("controller_session.php");
    iniciarSession();
    require_once ("controller_comunes.php");

    
    alertaRealizarApuesta();
    if(!verificarSesion()){
        eliminarSesionSinRedirigir();
        header("Location: ../index.php");
        exit();
    }
    var_dump($_SESSION);
    require_once("../db/db.php");
    require_once("../models/model_sorteosActivos.php");
    require_once("../models/model_realizarApuesta.php");

    $allActivos =sorteosActivos();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['realizarApuesta'])){

            //var_dump(count(recogerNuneros()));
            if(validar() && count(recogerNuneros())== 6){
        
                if(verificarSaldo()){
                    //var_dump(ultimoNAPUESTA());
                    //var_dump(recogerNuneros());
                    ingresarNumerosApost();
                    actualizarRecaudacionTotal();
                    apuestaRealizada();//mensaje de session
                    
                }else{
                    noHaySaldo();//mensaje de session
                }
            }else{
                rellenarAllCampos();//mensaje de session
            }
                
            
        }
    }
    require_once("../db/db.php");
    require_once ("../models/model_inicio.php");
    saldoApostante();
    
    //var_dump($sortActivos);
    require_once ("../views/view_realizarApuesta.php");
    
?>