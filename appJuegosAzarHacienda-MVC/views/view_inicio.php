<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

    <form name="inicio" action="" method="POST" class="d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">
                    <h2><b>Elegir Acción</b></h2>
                </div>
                <div class="card-body text-center">
                    <div>
                        <a href="../controllers/controller_altaSorteo.php" class="btn btn-primary">ALTA DE SORTEO</a>
                    </div>
                    <hr>
                    <div>
                        <a href="../controllers/controller_realizarSorteo.php" class="btn btn-primary">REALIZAR SORTEO</a>
                    </div>
                    <hr>
                    <div>
                        <a href="../controllers/controller_consultarSorteo.php" class="btn btn-primary">CONSULTAR SORTEO</a>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div>
                        <a href="../controllers/controller_cerrarSesion.php" class="btn btn-warning">Cerrar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>