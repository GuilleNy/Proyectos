<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");
    iniciarSession();

    alertaCompletarCampo();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['registro'])){
            if(validarRegistro() ){// si validar es true realiza la recoleccion de datos
                //datoRegistroDNI();
                
                require_once("../db/db.php");
                require_once ("../models/model_registro.php");
                list($dni, $nombre, $apellido, $email)=recogerDatosRegistro();
                datosRegistro($dni, $nombre, $apellido, $email);//con los datos ya recogidos los introduzco en sesiones para poder manejar esos datos luego.
                //registroCompletado();
                //datoRegistroDNI( $dni);
                header("Location: ../controllers/controller_registroYCargarSaldo.php");
                exit();

            }else{//si validar es false entonces manda un mensaje de error.
                registroNoCompletado();//alerta que deben completarse todos los campos del registro
            }
        }
    }
    

    require_once ("../views/view_registro.php");

?>