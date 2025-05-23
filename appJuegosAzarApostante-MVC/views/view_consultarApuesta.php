
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consultar Apuesta</title>
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

    <form name="inicio" action="" method="POST" class="d-flex justify-content-center align-items-center vh-20 w-100 mx-auto">
        <div class="container-fluid">
            <!-- Aplicación -->
            <div class="card border-success mb-3 mx-auto">
                <div class="card-header text-center">
                    <h2><b>Consultar Apuestas</b></h2>
                </div>
                <div class="card-body ">
                    <div class="mb-3">
                        <div class="mb-3 text-center" >
                            <label for="sorteo" class="form-label"><b>SELECCIONA SORTEO:</b></label>
                            <select id="sorteo" name="sorteo" class="custom-select">
                                <option value="" disabled selected>-- Selecciona un sorteo --</option>
                                <?php
                                
                                foreach ($allActivos as $fila)
                                    {
                                        echo "<option value=\"" . $fila['NSORTEO'] . "\">" . $fila['NSORTEO'] . "</option>";
                                    }
                                    //var_dump($_SESSION["datosSorteo"]);
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 table-responsive" style="overflow-x: auto;">
                            <table class="table table-bordered table-hover table-sm text-nowrap">

                                <thead>
                                    <tr>
                                        <th>NAPUESTA</th>
                                        <th>DNI</th>
                                        <th>NSORTEO</th>
                                        <th>FECHA</th>
                                        <th>N1</th>
                                        <th>N2</th>
                                        <th>N3</th>
                                        <th>N4</th>
                                        <th>N5</th>
                                        <th>N6</th>
                                        <th>R</th>
                                        <th>IMPORTE_PREMIO</th>
                                        <th>CATEGORIA_PREMIO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($datos)): ?>
                                        <?php foreach ($datos as $fila): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($fila['NAPUESTA']) ?></td>
                                                <td><?= htmlspecialchars($fila['DNI']) ?></td>
                                                <td><?= htmlspecialchars($fila['NSORTEO']) ?></td>
                                                <td><?= htmlspecialchars($fila['FECHA']) ?></td>
                                                <td><?= htmlspecialchars($fila['N1']) ?></td>
                                                <td><?= htmlspecialchars($fila['N2']) ?></td>
                                                <td><?= htmlspecialchars($fila['N3']) ?></td>
                                                <td><?= htmlspecialchars($fila['N4']) ?></td>
                                                <td><?= htmlspecialchars($fila['N5']) ?></td>
                                                <td><?= htmlspecialchars($fila['N6']) ?></td>
                                                <td><?= htmlspecialchars($fila['R']) ?></td>
                                                <td><?= htmlspecialchars($fila['IMPORTE_PREMIO']) ?></td>
                                                <td><?= htmlspecialchars($fila['CATEGORIA_PREMIO']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="13" class="text-center">No hay apuestas para este sorteo.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        
                    </div>
                    <hr>
                    <div>
                        <input type="submit" value="Consultar Sorteo" name="consultarApuestas" class="btn btn-primary">
                        <a href="../controllers/controller_inicio.php" class="btn btn-warning">Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

   

</body>
</html>