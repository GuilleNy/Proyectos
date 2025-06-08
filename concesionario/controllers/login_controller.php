<?php
// Iniciar sesión, error handler y funciones limpiar, redireccionar y logout
require_once('controllers/comun_controller.php');

// Depuración
echo "Estado de la sesión: " . session_status() . "<br>";
echo "Session ID: " . session_id() . "<br>";
echo "Contenido de la sesión: ";
var_dump($_SESSION);
echo "<hr>";

// En caso de que ya tenga la sesión iniciada redirigir al menu
if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
  if($_SESSION['usuario']['tipo'] != 'empleados'){
    redireccionar("clientes.php");
  }else{
    redireccionar("empleados.php");
  }
} else {
  // Cargar formulario
  require_once('views/login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['usuario'];
    $password = $_POST['password'];
    $tipoCliente = $_POST['tipoAcceso'];

    limpiar($user);
    limpiar($password);
    limpiar($tipoCliente);

    require_once ("models/login_model.php");
    require_once ("controllers/loginfunciones_controller.php");

    comprobarVacio($user);
    comprobarVacio($password);
    comprobarVacio($tipoCliente);

    var_dump($tipoCliente);

    $valido = login($user, $password, $tipoCliente);

    if($valido){
        if($tipoCliente === 'clientes'){
            redireccionar("clientes.php");
        }else{
            redireccionar("empleados.php");
        }
      
    }else{
      trigger_error("Usuario o contraseña incorrectos", E_USER_WARNING);
    } 
}

?>
