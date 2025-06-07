<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");
    iniciarSession();

    alertaCompletarCampo();//borra las sessiones de las alertas de registro.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['registro'])){
            if(validarRegistro() ){// si validar es true realiza la recoleccion de datos, el metodo esta en controller_comunes.php
                
                require_once("../db/db.php");
                require_once ("../models/model_registro.php");
                
                list($nombre, $fechaNac, $sexo, $direccion, $ciudad ,$codPost, $pais, $email, $telefono)=recogerDatosRegistro();
                ingresarRegistro($nombre, $fechaNac, $sexo, $direccion, $ciudad ,$codPost, $pais, $email, $telefono);
               

            }else{//si validar es false entonces manda un mensaje de error.
                registroNoCompletado();//alerta que deben completarse todos los campos del registro
            }
        }
    }
    

    require_once ("../views/view_registro.php");

?>