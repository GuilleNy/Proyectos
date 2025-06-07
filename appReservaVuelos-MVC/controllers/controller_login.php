<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");

    iniciarSession();
    alertalogin();
    if(verificarSesion()){
        header("Location: controllers/controller_inicio.php");//hacer esto
        exit();
    }else if(isset($_POST['login']))
    {
        $usu = $_POST["email"];
        $contra = $_POST["contra"];
        require_once ("models/model_login.php");
        $resultado = verificarDatos($usu,$contra);
        if($resultado == null){
            noLogin();//alerta de usuario no valido;
            header("Location: index.php");
            exit();
        }else{
            $usuarioLogin = $resultado["emailaddress"];
            $contraLogin= $resultado["birthdate"];
            crearSesion($usuarioLogin, $contraLogin);
            header("Location: controllers/controller_inicio.php");
            exit();
        }

    }


    require_once ("views/view_login.php");

?>