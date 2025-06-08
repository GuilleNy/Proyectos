<?php
function mostrarEmail(){
    $a = $_SESSION['usuario']['idcliente'];
    echo $a;
}

function mostrarNombre(){
    $a = datosCliente($_SESSION['usuario']['idcliente']);
    echo $a['nombre'] . ' ' . $a['apellidos'];
}

function crearCookieCesta(&$vehiculosAgregados, $id_vehiculo){
    // Si existe la cookie de los vuelos la pasamos a array, sino creamos un array vacío
    $vehiculosAgregados = isset($_COOKIE['vehiculosAgregados']) ? unserialize($_COOKIE['vehiculosAgregados']) : array();

    // Creamos el array de vuelos del usuario si es que no existe
    if (!isset($vehiculosAgregados[$_SESSION['usuario']['idcliente']])){
      $vehiculosAgregados[$_SESSION['usuario']['idcliente']] = array();
    }

    $vehiculoEncontrado = false;

    // Si se elige un vuelo que ya estaba agregado se suman los asientos
    foreach ($vehiculosAgregados[$_SESSION['usuario']['idcliente']] as $vehiculo) {
        if ($vehiculo['num_bastidor'] === $id_vehiculo) {
            echo "Ya existe en la cesta el vehiculo con Num. Bastidor: $id_vehiculo";
            $vehiculoEncontrado = true;
            break;
        }
    }

    // Sino se añade al array
    if (!$vehiculoEncontrado) {
        $vehiculosAgregados[$_SESSION['usuario']['idcliente']][] = array(
            'num_bastidor' => $id_vehiculo,
        );
        echo "Vehículo añadido correctamente.";
    }

    // Pasar el array de los vuelos a cookie
    setcookie('vehiculosAgregados', serialize($vehiculosAgregados), time() + (10 * 365 * 24 * 60 * 60), '/');

}

function vaciarCesta() {
    $vehiculosAgregados = isset($_COOKIE['vehiculosAgregados']) ? unserialize($_COOKIE['vehiculosAgregados']) : array();

    if (isset($vehiculosAgregados[$_SESSION['usuario']['idcliente']])) {
        unset($vehiculosAgregados[$_SESSION['usuario']['idcliente']]);
        if (!empty($vuelosAgregados))
          setcookie('vehiculosAgregados', serialize($vehiculosAgregados), time() + (10 * 365 * 24 * 60 * 60), '/');
        else
          setcookie('vehiculosAgregados', '', time() - 3600, '/');
    }
}

//------------------------------------------------------

// Función para comprobar si hay asientos disponibles
function comprobarVehiculosDisponibles() {
    $vehiculosAgregados = isset($_COOKIE['vehiculosAgregados']) ? unserialize($_COOKIE['vehiculosAgregados']) : array();
    
    if (!isset($vehiculosAgregados[$_SESSION['usuario']['idcliente']]))
      trigger_error('Aún no has hecho ninguna reserva', E_USER_WARNING);

    foreach ($vehiculosAgregados[$_SESSION['usuario']['idcliente']] as $vehiculoAgregado) {
        $datos = detallesVuelo($vehiculoAgregado['num_bastidor']);
        if ($datos['fecha_venta'] != NULL)
            trigger_error('El vehiculo ya no está disponible', E_USER_WARNING);
    }
}

// Función para hacer la reserva
function hacerPedido() {
    $vehiculosAgregados = isset($_COOKIE['vehiculosAgregados']) ? unserialize($_COOKIE['vehiculosAgregados']) : array();
    $vehiculosAgregados = $vehiculosAgregados[$_SESSION['usuario']['idcliente']];

    $dni = buscarDni($_SESSION['usuario']['idcliente']);

    $idPedido = obtenerUltIdPedido();
    $idPedido = generarIdPedido($idPedido);
    
    $idFinal = $idPedido;

    $precioTotal = 0;

    foreach ($vehiculosAgregados as $vehiculoAgregado) {
        $datosVuelo = detallesVuelo($vehiculoAgregado['num_bastidor']);
        $precio = $datosVuelo['precio_vehiculo'];
        $num_linea = 1;

        anadirLineaPedido($idFinal, $num_linea, $datosVuelo['num_bastidor'], $precio);
        
        $num_linea +=1;

        $precioTotal += $precio;
    }
    
    anadirPedido($idPedido, $dni, $precioTotal);

    return $precioTotal;
}

  // Función para generar el id de la reserva
function generarIdPedido($idPedido) {
    if (!empty($idPedido))
      $idPedido += 1;
    else
      $idPedido = 1;

    return $idPedido;
}

?>