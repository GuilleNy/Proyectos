<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");
    iniciarSession();

    alertaCompletarCampo();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['registro'])){
            if(validarRegistro() ){// si validar es true realiza la recoleccion de datos
                require_once("../db/db.php");
                require_once ("../models/model_registro.php");
                list($dni, $nombre, $apellido, $email)=recogerDatosRegistro();
                ingresarRegistro($dni, $nombre, $apellido, $email);
                registroCompletado();
            }else{//si validar es false entonces manda un mensaje de error.
                registroNoCompletado();
            }
        }
    }
    

    require_once ("../views/view_registro.php");

?>