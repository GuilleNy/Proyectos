<?php
function ingresarRegistro($dni, $nombre, $apellido, $email, $conn){

    try{
        $stmt=$conn->prepare("INSERT INTO empleado (DNI, NOMBRE, APELLIDO, EMAIL)
                            VALUES (:VstDni, :VstNombre, :VstApellido, :VstEmail)");
        $stmt->bindParam(':VstDni', $dni);
        $stmt->bindParam(':VstNombre', $nombre);
        $stmt->bindParam(':VstApellido', $apellido);
        $stmt->bindParam(':VstEmail', $email);

        
        if($stmt->execute()){
            //$_SESSION['mensajeRegistro'] = "Registro completado";
            //header("Location: registro.php");
            //exit();
            registroCompletado();
        }
    }catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }


}   

?>