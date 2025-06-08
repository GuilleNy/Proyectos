<?php
// Iniciar sesión, error handler y funciones limpiar, redireccionar y logout
require_once('controllers/comun_controller.php');

comprobarSesion();

require_once ("controllers/altavehiculosfunciones_controller.php");
require_once ("models/altavehiculos_model.php");
require_once('views/altavehiculo.php');

// Verificar si el formulario fue enviado y qué botón se presionó
if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
    if (isset($_POST['alta'])) {
        $num_bastidor = $_POST['num_bastidor'];
        $matricula = $_POST['matricula'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $kms = $_POST['kms'];
        $precio = $_POST['precio'];
        $descuento = $_POST['descuento'];

        $cod_empleado = $_SESSION['usuario']['idcliente'];

        limpiar($num_bastidor);
        limpiar($matricula);
        limpiar($marca);
        limpiar($modelo);
        limpiar($kms);
        limpiar($precio);
        limpiar($descuento);

        comprobarVacio($num_bastidor);
        comprobarVacio($matricula);
        comprobarVacio($marca);
        comprobarVacio($modelo);
        comprobarVacio($kms);
        comprobarVacio($precio);
        comprobarVacio($descuento);
  
        $valido = darAltaVehiculo($num_bastidor, $matricula, $marca, $modelo, $kms, $precio, $descuento, $cod_empleado);

        if($valido){
            echo "Se ha dado de alta correctamente el nuevo vehiculo";
        }else{
            trigger_error("Ha ocurrido un problema. Inténtelo de nuevo", E_USER_WARNING);
        }
    }

    if (isset($_POST['volver'])){
        redireccionar('empleados.php');
    }
}

?>