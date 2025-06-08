<?php
// Iniciar sesión, error handler y funciones limpiar, redireccionar y logout
require_once('controllers/comun_controller.php');

comprobarSesion();

// Depuración
echo "Estado de la sesión: " . session_status() . "<br>";
echo "Session ID: " . session_id() . "<br>";
echo "Contenido de la sesión: ";
var_dump($_SESSION);
echo "<hr>";

require_once ("controllers/empleadosfunciones_controller.php");
require_once ("models/empleados_model.php");
require_once('views/empleados.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['alta'])) {
        redireccionar('altavehiculos.php');

    } else if (isset($_POST['salir'])) {
        logout();
        redireccionar('.');
    }

}

?>
