<?php
session_start();
include_once "func_login.php";


if (isset($_SESSION['mensajeLogin'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['mensajeLogin'] . "</div>";
    unset($_SESSION['mensajeLogin']); // Borra el mensaje después de mostrarlo
}

?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

    <form name="login" action="" method="POST" class="d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">
                    <h2><b>Login</b></h2>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <label for="usuario" class="form-label"><b>Usuario:</b></label>
                        <input type="text" name="usuario" class="form-control w-75 mx-auto">
                    </div>
                    
                    <div class="mb-3">
                        <label for="contra" class="form-label"><b>Contraseña:</b></label>
                        <input type="text" name="contra"  class="form-control w-75 mx-auto">
                    </div>

                    <div>
                        <input type="submit" value="Iniciar sesión" name="login" class="btn btn-warning">
                    </div>
                    <hr>
                    <div>
                        <input type="submit" value="Registrarse" name="registrarse" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
        if(isset($_POST['login'])){
            list($usuario, $contraseña)=recogerDatos();
            verificarDatos($usuario, $contraseña); //Las variables ($usuario, $contraseña) las tengo que poner tal cual en la funcion del fichero fun_login.php
        }else if(isset($_POST['registrarse']))
        {
            header("Location: ./registro.php");
        }
    ?>


    


</body>
</html>
