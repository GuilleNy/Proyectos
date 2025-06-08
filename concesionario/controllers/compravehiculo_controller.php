<?php
// Iniciar sesión, error handler y funciones limpiar, redireccionar y logout
require_once('controllers/comun_controller.php');

comprobarSesion();

require_once ("controllers/compravehiculofunciones_controller.php");
require_once ("models/compravehiculo_model.php");
require_once('views/compravehiculos.php');

// Verificar si el formulario fue enviado y qué botón se presionó
if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
    if (isset($_POST['agregar'])) {
        $vehiculos = $_POST['vehiculos'] ?? '';

        limpiar($vehiculos);

        comprobarVacio($vehiculos);

        $vehiculosAgregados = array();
  
        crearCookieCesta($vehiculosAgregados, $vehiculos);
        mostrarVehiculosAgregados($vehiculosAgregados);
    }

    if (isset($_POST['vaciar'])) {
        // Vaciar el carrito
        vaciarCesta();
        echo 'Se han eliminado los vehiculos agregados';
    }

    if (isset($_POST['pedido'])) {
        comprobarVehiculosDisponibles();
        $precioTotal = hacerPedido();
        vaciarCesta();
        echo 'Se han comprado todos los vehiculos. Precio total: ' . $precioTotal . '€';
    }

    if (isset($_POST['volver'])){
        redireccionar('clientes.php');
    }
}

?>