<?php
session_start();
include_once "conexionBaseDeDatos.php";
include_once "otrasFunciones.php";


function recogerDatosRegistro(){
    $VstDni=depurar($_POST['dni']);
    $VstNombre=depurar($_POST['nombre']);
    $VstApellido=depurar($_POST['apellido']);
    $VstEmail=depurar($_POST['email']);
    return [$VstDni, $VstNombre, $VstApellido, $VstEmail];
}

function ingresarRegistro($dni, $nombre, $apellido, $email){
    $conn=conexionBBDD();

    $stmt=$conn->prepare("INSERT INTO empleado (DNI, NOMBRE, APELLIDO, EMAIL)
                        VALUES (:VstDni, :VstNombre, :VstApellido, :VstEmail)");
    $stmt->bindParam(':VstDni', $dni);
    $stmt->bindParam(':VstNombre', $nombre);
    $stmt->bindParam(':VstApellido', $apellido);
    $stmt->bindParam(':VstEmail', $email);

    
    if($stmt->execute()){
        $_SESSION['mensajeRegistro'] = "Registro completado";
        header("Location: registro.php");
        exit();
        
    }
}

?>