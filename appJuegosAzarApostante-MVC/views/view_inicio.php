<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <div class="text-center">
        <div class="d-inline-block bg-warning text-white px-4 py-2 rounded shadow-sm">
            <div class="d-flex gap-3">
            <div>
                <label>Usuario:</label>
                <input type="text" class="form-control" value="<?= $_SESSION["VstUsuario"] ?? ''; ?>" readonly>
            </div>
            <div>
                <label>Saldo:</label>
                <input type="text" class="form-control" value="<?= $_SESSION["saldo"]["SALDO"] ?? ''; ?>" readonly>
            </div>
            </div>
        </div>
    </div>


    <form name="inicio" action="" method="POST" class="d-flex justify-content-center align-items-center ">
        <div class="container">
            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">
                    <h2><b>Elegir Acción</b></h2>
                </div>
                <div class="card-body text-center">
                    <div>
                        <a href="../controllers/controller_realizarApuesta.php" class="btn btn-primary">REALIZAR APUESTA</a>
                    </div>
                    <hr>
                    <div>
                        <a href="../controllers/controller_cargarSaldo.php" class="btn btn-primary">CARGAR SALDO</a>
                    </div>
                    <hr>
                    <div>
                        <a href="../controllers/controller_consultarApuesta.php" class="btn btn-primary">CONSULTAR APUESTA</a>
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