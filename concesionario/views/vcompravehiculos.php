<?php
function listaVehiculosDisponibles(){
    $vehiculo = vehiculosDisponibles();

    // Opción por defecto
    echo "<option value='' selected disabled>-- SELECCIONA --</option>";

    // Usamos los datos obtenidos
    foreach ($vehiculo as $row) {
        echo "<option value='" . $row["num_bastidor"] . "'>" . $row["marca"] . " - " . $row["modelo"] . " - " . $row["kms"]. " - " . $row["precio_vehiculo"]. " - " . $row["descuento"]."</option>";
    }
}

// Función para mostrar los vuelos agregados al carrito
function mostrarVehiculosAgregados($vehiculosAgregados) {
    if (isset($vehiculosAgregados[$_SESSION['usuario']['idcliente']])) {
      $v = $vehiculosAgregados[$_SESSION['usuario']['idcliente']];
      crearTablaVuelos($v);
    } else
      echo 'Aún no has agregado ningún vuelo';
}

// Función para crear la tabla de los vuelos agregados al carrito
function crearTablaVuelos($v) {
    echo "<table border='1' style='border-collapse: collapse; width: 810px; text-align: left;'>";
      echo '<tr>';
        echo '<th>Num Bastidor</th>';
        echo '<th>Matricula</th>';
        echo '<th>Marca</th>';
        echo '<th>Modelo</th>';
        echo '<th>KMS</th>';
        echo '<th>Precio</th>';
        echo '<th>Descuento</th>';
      echo '</tr>';
    foreach ($v as $vehiculo) {
        $datos = detallesVuelo($vehiculo['num_bastidor']);
      echo '<tr>';
        echo '<td>' . $datos['num_bastidor'] . '</td>';
        echo '<td>' . $datos['matricula'] . '</td>';
        echo '<td>' . $datos['marca'] . '</td>';
        echo '<td>' . $datos['modelo'] . '</td>';
        echo '<td>' . $datos['kms'] . '</td>';
        echo '<td>' . $datos['precio_vehiculo'] . ' €</td>';
        echo '<td>' . $datos['descuento'] . '</td>';
      echo '</tr>';
    }
    echo '</table>';
}
?>