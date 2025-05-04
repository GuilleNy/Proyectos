<?php

    require_once ("controller_session.php");
    require_once ("controller_comunes.php");

    iniciarSession();

    if(verificarSesion()){
        header("Location: controllers/controller_inicio.php");
        exit();
    }elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $usu = $_POST["usuario"];
        $contra = $_POST["contra"];
        require_once ("models/model_login.php");
        $resultado = verificarDatos($usu,$contra);
        if($resultado == null){
            header("Location: controllers/controller_registro.php");
            exit();
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