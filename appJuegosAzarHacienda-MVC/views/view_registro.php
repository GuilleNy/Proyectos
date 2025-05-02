<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

    <form name="registro" action="" method="POST" class="d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">
                    <h2><b>Registrarse</b></h2>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <label for="dni" class="form-label"><b>DNI:</b></label>
                        <input type="text" name="dni" class="form-control w-75 mx-auto">
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label"><b>Nombre:</b></label>
                        <input type="text" name="nombre"  class="form-control w-75 mx-auto">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label"><b>Apellido:</b></label>
                        <input type="text" name="apellido"  class="form-control w-75 mx-auto">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><b>Email:</b></label>
                        <input type="text" name="email" class="form-control w-75 mx-auto">
                    </div>
                    
                    <div>
                        <input type="submit" value="Registrarse" name="registro" class="btn btn-primary">
                    </div>
                    <hr>
                    <div>
                        <a href="../index.php" class="btn btn-warning">Volver al Login</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>
</html>
