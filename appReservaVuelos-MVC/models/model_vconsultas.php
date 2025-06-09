<?php
function todasReservas(){
    require_once("model_inicio.php");
    $nombre= obtenerNombreUsuario();
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT booking_id 
                                        FROM booking b, passengerdetails p 
                                        WHERE b.passenger_id=p.passenger_id and p.name=:nombre");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numReservas=$stmt->fetchAll();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    return $numReservas;
}

function datosReservas($numReserva){
    try{
        $stmt=$GLOBALS["conn"]->prepare("SELECT p.name , v.flightno, salida.name salida, llegada.name llegada, v.departure , v.arrival, r.seat
                                        FROM passengerdetails p, booking r, flight v, airport salida, airport llegada
                                        WHERE p.passenger_id=r.passenger_id
                                        and r.flight_id=v.flight_id
                                        and v.from_a=salida.airport_id 
                                        and v.to_a=llegada.airport_id
                                        and r.booking_id= :numero");
        $stmt->bindParam(':numero', $numReserva);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $numSorteos=$stmt->fetchAll();
    }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }

    return $numSorteos;

}

?>