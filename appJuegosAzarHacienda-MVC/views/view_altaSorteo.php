<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alta Sorteo</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

    <form name="inicio" action="" method="POST" class="d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto" style="max-width: 30rem;">
                <div class="card-header text-center">
                    <h2><b>Alta de Sorteo</b></h2>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <label for="fecha" class="form-label"><b>Fecha de alta:</b></label>
                        <input type="date" name="fecha" class="form-control w-75 mx-auto">
                    </div>
                    <hr>
                    <div>
                        <input type="submit" value="Dar alta Sorteo" name="darAlta" class="btn btn-primary">
                        <a href="../views/view_inicio.php" class="btn btn-warning">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

   

</body>
</html>