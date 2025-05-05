<?php

function ingresarRegistro($dni, $nombre, $apellido, $email){


    $stmt=$GLOBALS["conn"]->prepare("INSERT INTO apostante(DNI, NOMBRE, APELLIDO, EMAIL)
                        VALUES (:VstDni, :VstNombre, :VstApellido, :VstEmail)");
    $stmt->bindParam(':VstDni', $dni);
    $stmt->bindParam(':VstNombre', $nombre);
    $stmt->bindParam(':VstApellido', $apellido);
    $stmt->bindParam(':VstEmail', $email);
    $stmt->execute();
        
    
}



?>