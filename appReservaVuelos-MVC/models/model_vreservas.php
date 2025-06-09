<?php


function vuelosDisponibles(){
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


?>