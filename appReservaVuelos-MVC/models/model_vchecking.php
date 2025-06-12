<?php
function obtenerReservas(){
    
    $nombre=obtenerNombreUsuario();
    $idUsuario=obtenerIdPasajero($nombre);

    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT f.flight_id,  f.flightno , salida.name salida, llegada.name llegada 
                                        FROM flight f, booking b , airport salida, airport llegada
                                        WHERE f.flight_id=b.flight_id
                                        AND f.from_a=salida.airport_id
                                        AND f.to_a=llegada.airport_id
                                        AND b.passenger_id=:idPasajero 
                                        AND seat is null");
        $stmt->bindParam(':idPasajero', $idUsuario["passenger_id"]);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos=$stmt->fetchAll();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    return $datos;
}

function annadirAsiento($datos){
    $detallesVuelo=explode("|", $datos);
    $idVuelo=$detallesVuelo[0];

    $nombre=obtenerNombreUsuario();
    $idUsuario=obtenerIdPasajero($nombre);
    $asiento=asientoAleatorio();
   

    $asientos=asientoDisponible($idVuelo);

    // Comprobar si ya está ocupado
    $asientoOcupado = false;
    foreach ($asientos as $fila) {
        if ($fila['seat'] == $asiento && !$asientoOcupado) {
            $asientoOcupado = true;
            $asiento=asientoAleatorio();
        }
    }
    //var_dump($asiento);

    if(!$asientoOcupado){
         try
        {
            $GLOBALS["conn"]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $GLOBALS["conn"]->beginTransaction();
            $stmt = $GLOBALS["conn"]->prepare("UPDATE booking SET seat = :asiento 
                                                WHERE flight_id = :idVuelo
                                                AND passenger_id = :idPasajero");
            $stmt->bindParam(':asiento', $asiento);
            $stmt->bindParam(':idVuelo', $idVuelo);
            $stmt->bindParam(':idPasajero', $idUsuario["passenger_id"]);
        
            $stmt -> execute();
            $GLOBALS["conn"] -> commit();
        }
        catch(PDOException $e)
        {
            $GLOBALS["conn"] -> rollBack();
            echo "Error: " . $e->getMessage();
        }
    }
   
}

function asientoDisponible($idVuelo){
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT f.flight_id , b.seat 
                                        FROM flight f, booking b 
                                        WHERE f.flight_id=b.flight_id 
                                        AND f.flight_id=:idVuelo
                                        AND seat is not null");
        $stmt->bindParam(':idVuelo', $idVuelo);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos=$stmt->fetchAll();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    return $datos;
}

function asientoAleatorio(){

    $numRandom=rand(1,50);
    $letra = chr(rand(65, 90));
    $asiento=$numRandom.$letra;
    return $asiento;
}





?>