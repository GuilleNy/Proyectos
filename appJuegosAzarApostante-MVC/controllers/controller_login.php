<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");

    iniciarSession();
    alertalogin();
    if(verificarSesion()){
        header("Location: controllers/controller_inicio.php");
        exit();
    }else if(isset($_POST['login']))
    {
        $usu = $_POST["usuario"];
        $contra = $_POST["contra"];
        require_once ("models/model_login.php");
        $resultado = verificarDatos($usu,$contra,$conn);
        if($resultado == null){
            noLogin();
        }else
        {
            $usuarioLogin = $resultado["DNI"];
            $contraLogin= $resultado["APELLIDO"];
            crearSesion($usuarioLogin, $contraLogin);
            header("Location: controllers/controller_inicio.php");
            exit();
        }

    }


    require_once ("views/view_login.php");

?>