<?php

function ingresarRegistro($nombre, $fechaNac, $sexo, $direccion, $ciudad ,$codPost, $pais, $email, $telefono){

    $ultimoId=obtenerUltimoIdPasajero();
    try{
        $GLOBALS["conn"]->beginTransaction();
        $stmt=$GLOBALS["conn"]->prepare("INSERT INTO passengerdetails(passenger_id, `name`, birthdate, sex, street, city, zip, country, emailaddress, telephoneno)
                            VALUES (:VstIdPassenguer, :VstNombre, :VstFechaNac, :VstSexo, :VstDireccion, :VstCiudad, :VstCodPost, :VstPais, :VstEmail, :VstTelefono)");
        $stmt->bindParam(':VstIdPassenguer', $ultimoId);
        $stmt->bindParam(':VstNombre', $nombre);
        $stmt->bindParam(':VstFechaNac', $fechaNac);
        $stmt->bindParam(':VstSexo', $sexo);
        $stmt->bindParam(':VstDireccion', $direccion);
        $stmt->bindParam(':VstCiudad', $ciudad);
        $stmt->bindParam(':VstCodPost', $codPost);
        $stmt->bindParam(':VstPais', $pais);
        $stmt->bindParam(':VstEmail', $email);
        $stmt->bindParam(':VstTelefono', $telefono);
        if($stmt->execute()){
            $GLOBALS["conn"]->commit();
            registroCompletado();
        }

    }catch(PDOException $e)
    {
        if ($GLOBALS["conn"]->inTransaction()) {
            $GLOBALS["conn"]->rollBack(); 
        }
        echo "Error: " . $e->getMessage();
    }
}

function obtenerUltimoIdPasajero(){
     try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT passenger_id FROM passengerdetails ORDER BY passenger_id DESC LIMIT 1");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ultimoDigito=$stmt->fetch();

        if($ultimoDigito){
            $cod= intval($ultimoDigito['passenger_id']);//aqui intval convierte la cadena a entero en este caso de 001 a 1
		    $nuevoNum=$cod+1;
            
        }else{
            $nuevoNum=1; 
        }
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    return $nuevoNum;
}


?>