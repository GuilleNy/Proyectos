<?php

function ingresarRegistro(){
    $dni=obtenerDNI();
    $nombre=obtenerNombre();
    $apellido=obtenerApellido();
    $email=obtenerEmail();

    try{
        $GLOBALS["conn"]->beginTransaction();
        $stmt=$GLOBALS["conn"]->prepare("INSERT INTO apostante(DNI, NOMBRE, APELLIDO, EMAIL)
                            VALUES (:VstDni, :VstNombre, :VstApellido, :VstEmail)");
        $stmt->bindParam(':VstDni', $dni);
        $stmt->bindParam(':VstNombre', $nombre);
        $stmt->bindParam(':VstApellido', $apellido);
        $stmt->bindParam(':VstEmail', $email);
        $stmt->execute();
        $GLOBALS["conn"]->commit();
    }catch(PDOException $e)
    {
        if ($GLOBALS["conn"]->inTransaction()) {
            $GLOBALS["conn"]->rollBack(); 
        }
        echo "Error: " . $e->getMessage();
    }
    
}



?>