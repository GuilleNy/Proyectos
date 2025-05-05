<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cargar Saldo</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <form method="post" class="w-50 mx-auto border p-4 rounded shadow-sm bg-light">
            <div class="mb-3">
                <label for="cargarSaldo" class="form-label">Importe (€):</label>
                <input type="number" name="cantidad" id="cargarSaldo" class="form-control" required>
            </div>
            <button type="submit" name="cargarSaldo" class="btn btn-primary w-100">Cargar saldo</button>
        </form>

        <div class="text-center mt-3">
            <a href="../controllers/controller_inicio.php" class="btn btn-warning">Volver al inicio</a>
        </div>
    </div>

    <?php
        if (isset($params) && isset($signature) && $params != null && $signature != null) {
            echo "
            <form style='display:none;' id='formularioPago' action='https://sis-t.redsys.es:25443/sis/realizarPago' method='POST'>
                <input type='hidden' name='Ds_SignatureVersion' value='" . $version . "'/>
                <input type='hidden' name='Ds_MerchantParameters' value='" . $params . "'/>
                <input type='hidden' name='Ds_Signature' value='" . $signature . "'/>	
            </form>
            <script>document.getElementById('formularioPago').submit();</script>";
        }
    ?>
    
   
</body>
</html>