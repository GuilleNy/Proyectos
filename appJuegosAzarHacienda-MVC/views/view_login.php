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
                    <h2><b>LOGIN HACIENDA</b></h2>
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
                        <a href="/appJuegosAzarHacienda-MVC/controllers/controller_registro.php" class="btn btn-primary">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>
</html>