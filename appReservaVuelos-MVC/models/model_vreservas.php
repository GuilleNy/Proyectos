<?php


function vuelosDisponibles(){
    /**
     * permite mostrar la información de cualquiera de las reservas 
     * realizadas por un pasajero. Las reservas se seleccionarán desde un desplegable y se mostrará toda la 
     * información referente a la misma: nombre del pasajero, número de vuelo, origen, destino, fecha salida, etc …
     */
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT f.flight_id , f.flightno , salida.name salida, llegada.name llegada
                                        FROM flight f, airplane a, airport salida, airport llegada
                                        WHERE f.airplane_id=a.airplane_id
                                        and f.from_a=salida.airport_id 
                                        and f.to_a=llegada.airport_id
                                        AND (SELECT count(*) 
                                            FROM booking b 
                                            WHERE b.flight_id=f.flight_id) < a.capacity");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $vuelos=$stmt->fetchAll();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    return $vuelos;

}

function obtenerCapacidaPorId($idvuelo){
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT a.capacity
                                        FROM flight f, airplane a
                                        WHERE f.airplane_id=a.airplane_id
                                        AND f.flight_id=:idvuelo");
        $stmt->bindParam(':idvuelo', $idvuelo);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $capacidad=$stmt->fetch();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    return $capacidad;
}

function obtenerIdPasajero($nombre){
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT passenger_id
                                        FROM passengerdetails
                                        WHERE `name`= :nombre");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $idPasajero=$stmt->fetch();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    return $idPasajero;
}
function obtenerUltimoId(){
     try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT booking_id FROM booking ORDER BY booking_id DESC LIMIT 1");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ultimoID=$stmt->fetch();

    
        if($ultimoID){
            $cod= intval($ultimoID['booking_id']);//aqui intval convierte la cadena a entero en este caso de 001 a 1
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

function realizarReserva(){
    $idreserva=obtenerUltimoId();
    $nombreUsuario= obtenerNombreUsuario();
    $idUsuario=obtenerIdPasajero($nombreUsuario);
    $datosReserva=devolverCesta();
    $seat=null;

    foreach($datosReserva as $vuelo => $reserva){
        $idreserva=obtenerUltimoId();
        try{
        $GLOBALS["conn"]->beginTransaction();
        $stmt = $GLOBALS["conn"]->prepare("INSERT INTO booking (booking_id, flight_id, seat, passenger_id, price) 
                                    VALUES (:idreserva, :idVuelo, :asiento, :idPasajero, :precio)"); 
        $stmt->bindParam(':idreserva', $idreserva);
        $stmt->bindParam(':idVuelo', $reserva[0]);
        $stmt->bindParam(':asiento', $seat);
        $stmt->bindParam(':idPasajero', $idUsuario['passenger_id']);
        $stmt->bindParam(':precio', $reserva[5]);
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

    

}

/**
 * $cesta = $_SESSION["reserva"]["vuelos"];
 * echo $cesta[0][0]; // 3          (posiblemente un ID)
 * echo $cesta[0][1]; // AE1518    (número de vuelo)
 * echo $cesta[0][2]; // COLONIA   (origen)
 * echo $cesta[0][3]; // MARSELLA  (destino)
 * echo $cesta[0][4]; // 12H       (duración o salida)
 * echo $cesta[0][5]; // 120       (precio o algo similar)
 */


?>